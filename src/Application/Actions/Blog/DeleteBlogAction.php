<?php

declare(strict_types=1);

namespace App\Application\Actions\Blog;

use Psr\Http\Message\ResponseInterface as Response;

class DeleteBlogAction extends BlogAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $blogId = (int) $this->resolveArg('id');
        $seoAll = $this->blogRepository->deleteById($blogId);

        $this->logger->info("SEO all list was viewed.");

        return $this->respondWithData($seoAll);
    }
}
