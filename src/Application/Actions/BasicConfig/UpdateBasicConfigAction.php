<?php

declare(strict_types=1);

namespace App\Application\Actions\BasicConfig;

use Psr\Http\Message\ResponseInterface as Response;

class UpdateBasicConfigAction extends BasicConfigAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();
        $basicConfig = $this->basicConfigRepository->update($data);
        $this->logger->info("Basic Config updated");

        return $this->respondWithData($basicConfig);
    }
}
