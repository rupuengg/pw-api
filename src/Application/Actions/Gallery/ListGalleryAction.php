<?php

declare(strict_types=1);

namespace App\Application\Actions\Gallery;

use Psr\Http\Message\ResponseInterface as Response;

class ListGalleryAction extends GalleryAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $galleries = $this->galleryRepository->findAll();

        $this->logger->info("Galleries list was viewed.");

        return $this->respondWithData($galleries);
    }
}
