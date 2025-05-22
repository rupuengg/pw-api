<?php

declare(strict_types=1);

namespace App\Application\Actions\MenuGroup;

use Psr\Http\Message\ResponseInterface as Response;

class UpdateMenuGroupAction extends MenuGroupAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();

        $menuGroup = $this->menuGroupRepository->update($data);

        $this->logger->info("Menu updated");

        return $this->respondWithData($menuGroup);
    }
}
