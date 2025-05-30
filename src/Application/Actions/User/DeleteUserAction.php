<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use Psr\Http\Message\ResponseInterface as Response;

class DeleteUserAction extends UserAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $blogId = (int) $this->resolveArg('id');
        $seoAll = $this->userRepository->deleteById($blogId);

        $this->logger->info("User deleted.");

        return $this->respondWithData($seoAll);
    }
}
