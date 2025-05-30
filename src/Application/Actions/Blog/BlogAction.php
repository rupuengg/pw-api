<?php

declare(strict_types=1);

namespace App\Application\Actions\Blog;

use App\Application\Actions\Action;
use App\Domain\Blog\BlogRepository;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

abstract class BlogAction extends Action
{
    protected BlogRepository $blogRepository;

    public function __construct(LoggerInterface $logger, ContainerInterface $container, BlogRepository $blogRepository)
    {
        parent::__construct($logger, $container);
        $this->blogRepository = $blogRepository;
    }
}
