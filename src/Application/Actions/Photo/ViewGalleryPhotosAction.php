<?php

declare(strict_types=1);

namespace App\Application\Actions\Photo;

use Psr\Http\Message\ResponseInterface as Response;

class ViewGalleryPhotosAction extends PhotoAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $galleryId = $this->resolveArg('id');
        $isDone = $this->resolveArg('isDone');
        
        $galleries = $this->photoRepository->findGalleryPhotos($galleryId, $isDone);

        $this->logger->info("Galleries list was viewed.");

        return $this->respondWithData($galleries);
    }
}
