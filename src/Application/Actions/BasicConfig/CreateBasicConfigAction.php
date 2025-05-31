<?php

declare(strict_types=1);

namespace App\Application\Actions\BasicConfig;

use Psr\Http\Message\ResponseInterface as Response;

class CreateBasicConfigAction extends BasicConfigAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();
        $basicConfig = $this->basicConfigRepository->create($data);
        $this->logger->info("Basic Config created");

        return $this->respondWithData($basicConfig);
    }
}
