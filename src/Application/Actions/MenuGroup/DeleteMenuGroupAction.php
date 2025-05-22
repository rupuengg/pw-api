<?php

declare(strict_types=1);

namespace App\Application\Actions\MenuGroup;

use Psr\Http\Message\ResponseInterface as Response;

class DeleteMenuGroupAction extends MenuGroupAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $menuGroupId = (int) $this->resolveArg('id');
        $menu = $this->menuGroupRepository->deleteById($menuGroupId);

        $this->logger->info("MenuGroup was deleted.");

        return $this->respondWithData($menu);
    }
}
