<?php

declare(strict_types=1);

namespace App\Application\Actions\MenuGroup;

use Psr\Http\Message\ResponseInterface as Response;

class CreateMenuGroupAction extends MenuGroupAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();

        $menuGroup = $this->menuGroupRepository->create($data);

        $this->logger->info("Menu created");

        return $this->respondWithData($menuGroup);
    }
}
