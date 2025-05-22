<?php

declare(strict_types=1);

namespace App\Application\Actions\Blog;

use Psr\Http\Message\ResponseInterface as Response;

class ListBlogAction extends BlogAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $seoAll = $this->blogRepository->findAll();

        $this->logger->info("Blogs all list was viewed.");

        return $this->respondWithData($seoAll);
    }
}
