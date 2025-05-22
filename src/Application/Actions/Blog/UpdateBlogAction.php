<?php

declare(strict_types=1);

namespace App\Application\Actions\Blog;

use Psr\Http\Message\ResponseInterface as Response;

class UpdateBlogAction extends BlogAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();
        
        $siteConfig = $this->blogRepository->update($data);

        $this->logger->info("Blog updated");

        return $this->respondWithData($siteConfig);
    }
}
