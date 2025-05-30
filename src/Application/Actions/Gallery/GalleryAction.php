<?php

declare(strict_types=1);

namespace App\Application\Actions\Gallery;

use App\Application\Actions\Action;
use App\Domain\Gallery\GalleryRepository;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

abstract class GalleryAction extends Action
{
    protected GalleryRepository $galleryRepository;

    public function __construct(
        LoggerInterface $logger,
        ContainerInterface $container,
        GalleryRepository $galleryRepository
    ) {
        parent::__construct($logger, $container);
        $this->galleryRepository = $galleryRepository;
    }
}
