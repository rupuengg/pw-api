<?php

declare(strict_types=1);

namespace App\Application\Actions\BasicConfig;

use Psr\Http\Message\ResponseInterface as Response;

class ViewBasicConfigAction extends BasicConfigAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $basicConfigId = $this->resolveArg('id');
        $basicConfig = $this->basicConfigRepository->findById($basicConfigId);
        $this->logger->info("Basic Config view was viewed.");

        return $this->respondWithData($basicConfig);
    }
}
