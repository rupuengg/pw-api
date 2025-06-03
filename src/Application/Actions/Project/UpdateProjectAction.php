<?php

declare(strict_types=1);

namespace App\Application\Actions\Project;

use Psr\Http\Message\ResponseInterface as Response;

class UpdateProjectAction extends ProjectAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $requestData = $this->request->getParsedBody();
        $data = $this->projectRepository->update($requestData);
        $this->logger->info("Project updated");

        return $this->respondWithData($data);
    }
}
