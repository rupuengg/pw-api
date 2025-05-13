<?php

declare(strict_types=1);

namespace App\Domain\Photo;

interface PhotoRepository
{
    /**
     * @return Photo[]
     */
    public function findAllPhotos(): array;

    /**
     * @return Photo[]
     */
    public function findAllGalleries(): array;

    /**
     * @return Photo
     */
    public function findGallery(string $galleryId): Photo;

    /**
     * @return Photo[]
     */
    public function findGalleryPhotos(string $imageKitFolder, $isDone): array;
}
