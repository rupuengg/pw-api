<?php

declare(strict_types=1);

namespace App\Application\Actions\MenuGroup;

use Psr\Http\Message\ResponseInterface as Response;

class ViewMenuGroupAction extends MenuGroupAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $menuGroupId = (int) $this->resolveArg('id');
        $menuGroup = $this->menuGroupRepository->findById($menuGroupId);

        $this->logger->info("Menu Group with menus list was viewed.");

        return $this->respondWithData($menuGroup);
    }
}
