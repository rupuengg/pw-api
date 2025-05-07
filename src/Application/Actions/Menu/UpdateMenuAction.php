<?php

declare(strict_types=1);

namespace App\Application\Actions\Menu;

use Psr\Http\Message\ResponseInterface as Response;

class UpdateMenuAction extends MenuAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();

        $menu = $this->menuRepository->update($data);

        $this->logger->info("Menu updated");

        return $this->respondWithData($menu);
    }
}
