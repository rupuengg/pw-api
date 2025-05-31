<?php

declare(strict_types=1);

namespace App\Application\Actions\BasicConfig;

use Psr\Http\Message\ResponseInterface as Response;

class ListBasicConfigAction extends BasicConfigAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $basicConfigs = $this->basicConfigRepository->findAll();
        $this->logger->info("Basic configs all list was viewed.");

        return $this->respondWithData($basicConfigs);
    }
}
