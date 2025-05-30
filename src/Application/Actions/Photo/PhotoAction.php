<?php

declare(strict_types=1);

namespace App\Application\Actions\Photo;

use App\Application\Actions\Action;
use App\Domain\Photo\PhotoRepository;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

abstract class PhotoAction extends Action
{
    protected PhotoRepository $photoRepository;

    public function __construct(
        LoggerInterface $logger,
        ContainerInterface $container,
        PhotoRepository $photoRepository
    ) {
        parent::__construct($logger, $container);
        $this->photoRepository = $photoRepository;
    }
}
