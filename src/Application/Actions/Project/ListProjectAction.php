<?php

declare(strict_types=1);

namespace App\Application\Actions\Project;

use Psr\Http\Message\ResponseInterface as Response;

class ListProjectAction extends ProjectAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $alls = $this->projectRepository->findAll();
        $this->logger->info("Project list");

        return $this->respondWithData($alls);
    }
}
