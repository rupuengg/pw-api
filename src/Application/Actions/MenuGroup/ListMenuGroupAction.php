<?php

declare(strict_types=1);

namespace App\Application\Actions\MenuGroup;

use Psr\Http\Message\ResponseInterface as Response;

class ListMenuGroupAction extends MenuGroupAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $menus = $this->menuGroupRepository->findAll();

        $this->logger->info("MenuGroup all list was viewed.");

        return $this->respondWithData($menus);
    }
}
