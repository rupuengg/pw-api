<?php

namespace App\Infrastructure\Persistence\Gallery;

use App\Domain\Gallery\Gallery;
use App\Domain\Gallery\GalleryRepository;
use App\Domain\Photo\Photo;
use App\Domain\Photo\PhotoCustomMetadata;
use App\Domain\Photo\PhotoEmbeddedMetadata;
use App\Domain\Photo\PhotoVersionInfo;
use DomainException;
use ImageKit\ImageKit;

final class GalleryReaderRepository implements GalleryRepository
{
    private ImageKit $imageKit;

    public function __construct(ImageKit $imageKit)
    {
        $this->imageKit = $imageKit;
    }

    public function findAll(): array
    {
        $rows = $this->imageKit->listFiles([
            "type" => 'folder',
            "fileType" => 'all'
        ]);

        return $this->convert($rows->result);
    }

    public function findAllPhotos(string $imageKitFolder): array
    {
        $rows = $this->imageKit->listFiles([
            "searchQuery" => '(path = "/' . $imageKitFolder . '/")',
            "type" => 'file',
        ]);

        return $this->photoConvert($rows->result);
    }

    public function findPhotosOnlyDone(string $imageKitFolder): array
    {
        $rows = $this->imageKit->listFiles([
            "searchQuery" => '(path = "/' . $imageKitFolder . '/" and "customMetadata.isDone" = true)',
            "type" => 'file',
        ]);

        return $this->photoConvert($rows->result);
    }

    public function findPhotosOnlyUnderConstruction(string $imageKitFolder): array
    {
        $rows = $this->imageKit->listFiles([
            "searchQuery" => '(path = "/' . $imageKitFolder . '/" and "customMetadata.isDone" = false)',
            "type" => 'file',
        ]);

        return $this->photoConvert($rows->result);
    }

    private function convert($result): array
    {
        $galleries = [];

        for ($iCounter = 0; $iCounter < count($result); $iCounter++) {
            $row = $result[$iCounter];

            $cover = $this->getCustomMetadata($row->name);

            $galleries[] = new Gallery(
                $row->type,
                $row->name,
                $row->createdAt,
                $row->updatedAt,
                $row->folderId,
                $row->folderPath,
                $cover,
            );
        }

        return $galleries;
    }

    private function photoConvert($result): array
    {
        $photos = [];

        for ($iCounter = 0; $iCounter < count($result); $iCounter++) {
            $row = $result[$iCounter];

            $photos[] = new Photo(
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
            );
        }

        return $photos;
    }

    private function getCustomMetadata(string $imageKitFolder): Photo
    {
        $rows = $this->imageKit->listFiles([
            "searchQuery" => '(path = "/' . $imageKitFolder . '/" and "customMetadata.cover" = true)',
            "type" => 'file',
        ]);

        if (count($rows->result) == 0) {
            throw new DomainException(sprintf('Cover photo not found'));
        }

        return $this->photoConvert($rows->result)[0];
    }
}
