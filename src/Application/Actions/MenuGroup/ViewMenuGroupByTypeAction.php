<?php

declare(strict_types=1);

namespace App\Application\Actions\MenuGroup;

use Psr\Http\Message\ResponseInterface as Response;

class ViewMenuGroupByTypeAction extends MenuGroupAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $menuGroupType = $this->resolveArg('type');
        $menuGroup = $this->menuGroupRepository->findByType($menuGroupType);

        $this->logger->info("Menu Group with menus list was viewed.");

        return $this->respondWithData($menuGroup);
    }
}
