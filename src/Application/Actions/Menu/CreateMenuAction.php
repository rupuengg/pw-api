<?php

declare(strict_types=1);

namespace App\Application\Actions\Menu;

use Psr\Http\Message\ResponseInterface as Response;

class CreateMenuAction extends MenuAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();
        
        $menu = $this->menuRepository->create($data);

        $this->logger->info("Menu created");

        return $this->respondWithData($menu);
    }
}
