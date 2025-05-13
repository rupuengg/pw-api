<?php

declare(strict_types=1);

namespace App\Domain\Gallery;

use App\Domain\Photo\Photo;
use App\Domain\Photo\PhotoCustomMetadata;
use App\Domain\Photo\PhotoEmbeddedMetadata;
use App\Domain\Photo\PhotoVersionInfo;
use JsonSerializable;

class Gallery implements JsonSerializable
{
    private string $type;

    private string $name;

    private string $createdAt;

    private string $updatedAt;

    private string $folderId;

    private string $folderPath;

    private string $galleryId;

    private $galleryCover;

    public function __construct($type, $name, $createdAt, $updatedAt, $folderId, $folderPath, $galleryCover)
    {
        $this->type = $type;
        $this->name = $name;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->folderId = $folderId;
        $this->folderPath = $folderPath;
        $galleryId = str_replace(" - ", " ", $name);
        $galleryId = str_replace(" ", "_", $galleryId);
        $this->galleryId = strtolower($galleryId);
        $this->galleryCover = $galleryCover;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getFolderId(): string
    {
        return $this->folderId;
    }

    public function getFolderPath(): string
    {
        return $this->folderPath;
    }

    public function getGalleryId(): string
    {
        return $this->galleryId;
    }

    public function getGalleryCover(): Photo
    {
        return $this->galleryCover;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'type' => $this->type,
            'name' => $this->name,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'folderId' => $this->folderId,
            'folderPath' => $this->folderPath,
            'galleryId' => $this->galleryId,
            'galleryCover' => $this->galleryCover,
        ];
    }
}