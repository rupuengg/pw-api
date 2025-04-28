<?php

declare(strict_types=1);

namespace App\Application\Actions\Photo;

use Psr\Http\Message\ResponseInterface as Response;

class ViewGalleryAction extends PhotoAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $galleryId = $this->resolveArg('id');
        
        $galleries = $this->photoRepository->findGallery($galleryId);

        $this->logger->info("Galleries list was viewed.");

        return $this->respondWithData($galleries);
    }
}
