<?php

declare(strict_types=1);

namespace App\Application\Actions\Project;

use Psr\Http\Message\ResponseInterface as Response;

class DeleteProjectAction extends ProjectAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $id = (int) $this->resolveArg('id');
        $data = $this->projectRepository->deleteById($id);
        $this->logger->info("Project deleted");

        return $this->respondWithData($data);
    }
}
