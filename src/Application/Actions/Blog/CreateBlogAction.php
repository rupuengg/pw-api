<?php

declare(strict_types=1);

namespace App\Application\Actions\Blog;

use Psr\Http\Message\ResponseInterface as Response;

class CreateBlogAction extends BlogAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();
        
        $siteConfig = $this->blogRepository->create($data);

        $this->logger->info("Blog created");

        return $this->respondWithData($siteConfig);
    }
}
