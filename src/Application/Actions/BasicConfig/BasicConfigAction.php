<?php

declare(strict_types=1);

namespace App\Application\Actions\BasicConfig;

use App\Application\Actions\Action;
use App\Domain\BasicConfig\BasicConfigRepository;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

abstract class BasicConfigAction extends Action
{
    protected BasicConfigRepository $basicConfigRepository;

    public function __construct(LoggerInterface $logger, ContainerInterface $container, BasicConfigRepository $basicConfigRepository)
    {
        parent::__construct($logger, $container);
        $this->basicConfigRepository = $basicConfigRepository;
    }
}
