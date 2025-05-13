<?php

declare(strict_types=1);

namespace App\Domain\Gallery;

use App\Domain\Photo\Photo;

interface GalleryRepository
{
    /**
     * @return Gallery[]
     */
    public function findAll(): array;

    /**
     * @return Photo[]
     */
    public function findAllPhotos(string $imageKitFolder): array;

    /**
     * @return Photo[]
     */
    public function findPhotosOnlyDone(string $imageKitFolder): array;

    /**
     * @return Photo[]
     */
    public function findPhotosOnlyUnderConstruction(string $imageKitFolder): array;
}
