<?php

namespace App\Infrastructure\Persistence\Photo;

use DomainException;
use Selective\Database\Connection;
use App\Domain\Photo\Photo;
use App\Domain\Photo\PhotoVersionInfo;
use App\Domain\Photo\PhotoEmbeddedMetadata;
use App\Domain\Photo\PhotoCustomMetadata;
use App\Domain\Photo\PhotoRepository;
use ImageKit\ImageKit;
use ImageKit\Utils\Response;

final class PhotoReaderRepository implements PhotoRepository
{
    private ImageKit $imageKit;
	
    public function __construct(ImageKit $imageKit)
    {
        $this->imageKit = $imageKit;
    }

    public function findAllPhotos(): array
    {
        $rows = $this->imageKit->listFiles();

		if(!$rows->result) {
            throw new DomainException(sprintf('Photos not found'));
        }

		return $this->convert($rows->result);
    }

    public function findAllGalleries(): array
    {
        $photos = $this->findAllPhotos();

        $galleries = array_filter($photos, function($photo) {
            return $photo->getCustomMetadata()->getCover() === true;
        });

        return array_values($galleries);
    }

    public function findGallery(string $galleryId): Photo
    {
        $photos = $this->findAllPhotos();

		$result = array_filter($photos, function($photo) use($galleryId) {
            return $photo->getCustomMetadata()->getGalleryId() === $galleryId;
        });

        $galleries = array_values($result);

        if(count($galleries) === 0) {
            throw new DomainException(sprintf('Gallery not found: %s', $galleryId));
        }

        return $galleries[0];
    }

    private function convert($result): array 
    {
        $photos = array();
		
		for($iCounter = 0; $iCounter < count($result); $iCounter++){
            $row = $result[$iCounter];

			array_push($photos, new Photo(
                $row->type,
                $row->name,
                $row->createdAt,
                $row->updatedAt,
                $row->fileId,
                $row->tags,
                $row->AITags,
                new PhotoVersionInfo($row->versionInfo->id, $row->versionInfo->name),
                new PhotoEmbeddedMetadata(
                    isset($row->embeddedMetadata->YResolution) ? $row->embeddedMetadata->YResolution : 0,
                    isset($row->embeddedMetadata->XResolution) ? $row->embeddedMetadata->XResolution : 0,
                    isset($row->embeddedMetadata->DateCreated) ? $row->embeddedMetadata->DateCreated : '',
                    isset($row->embeddedMetadata->DateTimeCreated) ? $row->embeddedMetadata->DateTimeCreated : ''
                ),
                $row->isPublished,
                $row->customCoordinates,
                new PhotoCustomMetadata(
                    isset($row->customMetadata->cover) ? $row->customMetadata->cover : '0',
                    isset($row->customMetadata->featured) ? $row->customMetadata->featured : '0',
                    isset($row->customMetadata->galleryId) ? $row->customMetadata->galleryId : '',
                    isset($row->customMetadata->galleryName) ? $row->customMetadata->galleryName : '',
                ),
                $row->isPrivateFile,
                $row->url,
                $row->thumbnail,
                $row->fileType,
                $row->filePath,
                $row->height,
                $row->width,
                $row->size,
                isset($row->hasAlpha) ? $row->hasAlpha : '',
                $row->mime,
            ));
		}

        return $photos;
    }
}