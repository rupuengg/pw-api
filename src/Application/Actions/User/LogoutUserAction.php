<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use Psr\Http\Message\ResponseInterface as Response;

class LogoutUserAction extends UserAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $menu = $this->userRepository->logout();
        $this->logger->info("User logged out");

        return $this->respondWithData($menu);
    }
}
