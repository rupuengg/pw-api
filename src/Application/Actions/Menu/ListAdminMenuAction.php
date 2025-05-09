<?php

declare(strict_types=1);

namespace App\Application\Actions\Menu;

use Psr\Http\Message\ResponseInterface as Response;

class ListAdminMenuAction extends MenuAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $menus = $this->menuRepository->findAllByMenuType('admin');

        $this->logger->info("Menu all list was viewed.");

        return $this->respondWithData($menus);
    }
}
