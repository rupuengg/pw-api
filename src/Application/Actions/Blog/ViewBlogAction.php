<?php

declare(strict_types=1);

namespace App\Application\Actions\Blog;

use Psr\Http\Message\ResponseInterface as Response;

class ViewBlogAction extends BlogAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $blogId = $this->resolveArg('id');
        $seoAll = $this->blogRepository->findById($blogId);

        $this->logger->info("Blog view was viewed.");

        return $this->respondWithData($seoAll);
    }
}
