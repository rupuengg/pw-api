<?php

declare(strict_types=1);

namespace App\Application\Actions\Project;

use Psr\Http\Message\ResponseInterface as Response;

class ViewProjectAction extends ProjectAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $id = $this->resolveArg('id');
        $data = $this->projectRepository->findById($id);
        $this->logger->info("Project viewed.");

        return $this->respondWithData($data);
    }
}
