<?php

declare(strict_types=1);

namespace App\Application\Actions\Menu;

use Psr\Http\Message\ResponseInterface as Response;

class ListMainMenuAction extends MenuAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $isShow = (int) $this->resolveArg('isShow');
        $menus = $this->menuRepository->findAllByMenuType('main', $isShow);

        $this->logger->info("Menu all list was viewed.");

        return $this->respondWithData($menus);
    }
}
