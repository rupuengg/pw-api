<?php

declare(strict_types=1);

namespace App\Application\Actions\Menu;

use Psr\Http\Message\ResponseInterface as Response;

class DeleteMenuAction extends MenuAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $siteConfigId = (int) $this->resolveArg('id');
        $menu = $this->menuRepository->deleteById($siteConfigId);

        $this->logger->info("Menu was deleted.");

        return $this->respondWithData($menu);
    }
}
