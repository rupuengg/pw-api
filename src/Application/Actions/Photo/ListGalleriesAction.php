<?php

declare(strict_types=1);

namespace App\Application\Actions\Photo;

use Psr\Http\Message\ResponseInterface as Response;

class ListGalleriesAction extends PhotoAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $galleries = $this->photoRepository->findAllGalleries();

        $this->logger->info("Galleries list was viewed.");

        return $this->respondWithData($galleries);
    }
}
