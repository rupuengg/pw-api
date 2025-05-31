<?php

declare(strict_types=1);

namespace App\Application\Actions\BasicConfig;

use Psr\Http\Message\ResponseInterface as Response;

class DeleteBasicConfigAction extends BasicConfigAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $basicConfigId = (int) $this->resolveArg('id');
        $seoAll = $this->basicConfigRepository->deleteById($basicConfigId);
        $this->logger->info("Basic Config is deleted.");

        return $this->respondWithData($seoAll);
    }
}
