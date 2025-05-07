<?php

declare(strict_types=1);

namespace App\Application\Actions\Menu;

use Psr\Http\Message\ResponseInterface as Response;

class ViewMenuAction extends MenuAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $menuId = (int) $this->resolveArg('id');
        $menu = $this->menuRepository->findById($menuId);

        $this->logger->info("Menu was viewed.");

        return $this->respondWithData($menu);
    }
}
