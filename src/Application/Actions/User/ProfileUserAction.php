<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface as Response;

class ProfileUserAction extends UserAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        try {
            $jwt = $this->container->get('jwt');
        } catch (ContainerExceptionInterface $e) {
            return $this->response->withStatus(401);
        }

        $menu = $this->userRepository->profile($jwt->user);
        $this->logger->info("User profile");

        return $this->respondWithData($menu);
    }
}
