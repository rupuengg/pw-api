<?php

declare(strict_types=1);

namespace App\Application\Actions\Blog;

use App\Application\Actions\Action;
use App\Domain\Blog\BlogRepository;
use Psr\Log\LoggerInterface;

abstract class BlogAction extends Action
{
    protected BlogRepository $blogRepository;

    public function __construct(LoggerInterface $logger, BlogRepository $blogRepository)
    {
        parent::__construct($logger);
        $this->blogRepository = $blogRepository;
    }
}
