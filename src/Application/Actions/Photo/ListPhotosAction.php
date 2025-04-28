<?php

declare(strict_types=1);

namespace App\Application\Actions\Photo;

use Psr\Http\Message\ResponseInterface as Response;

class ListPhotosAction extends PhotoAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $photos = $this->photoRepository->findAllPhotos();

        $this->logger->info("Photos list was viewed.");

        return $this->respondWithData($photos);
    }
}
