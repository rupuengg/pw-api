<?php

declare(strict_types=1);

namespace App\Domain\Photo;

use JsonSerializable;

class PhotoCustomMetadata implements JsonSerializable
{
    private $cover;

    private $featured;

    private $galleryId;

    private $galleryName;

    public function __construct($cover, $featured, $galleryId, $galleryName)
    {
        $this->cover = $cover;
        $this->featured = $featured;
        $this->galleryId = $galleryId;
        $this->galleryName = $galleryName;
    }

    public function getCover()
    {
        return $this->cover;
    }

    public function getFeatured()
    {
        return $this->featured;
    }

    public function getGalleryId()
    {
        return $this->galleryId;
    }

    public function getGalleryName()
    {
        return $this->galleryName;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'cover' => $this->cover,
            'featured' => $this->featured,
            'galleryId' => $this->galleryId,
            'galleryName' => $this->galleryName,
        ];
    }
}