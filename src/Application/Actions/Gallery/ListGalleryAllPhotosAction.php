<?php

declare(strict_types=1);

namespace App\Application\Actions\Gallery;

use Psr\Http\Message\ResponseInterface as Response;

class ListGalleryAllPhotosAction extends GalleryAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $imageKitFolder = $this->resolveArg('imageKitFolder');
        $galleries = $this->galleryRepository->findAllPhotos($imageKitFolder);

        $this->logger->info("Galleries list was viewed.");

        return $this->respondWithData($galleries);
    }
}
