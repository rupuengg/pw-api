<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use Psr\Http\Message\ResponseInterface as Response;

class LoginUserAction extends UserAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();
        $token = $this->userRepository->login($data);
        $this->container->set('token', $token['token']);

        $this->logger->info("User logged in");

        return $this->respondWithData($token);
    }
}
