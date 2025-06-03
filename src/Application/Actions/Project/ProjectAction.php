<?php

declare(strict_types=1);

namespace App\Application\Actions\Project;

use App\Application\Actions\Action;
use App\Domain\Address\AddressRepository;
use App\Domain\Project\ProjectRepository;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

abstract class ProjectAction extends Action
{
    protected ProjectRepository $projectRepository;
    protected AddressRepository $addressRepository;

    public function __construct(LoggerInterface $logger, ContainerInterface $container, ProjectRepository $projectRepository, AddressRepository $addressRepository)
    {
        parent::__construct($logger, $container);
        $this->projectRepository = $projectRepository;
        $this->addressRepository = $addressRepository;
    }
}
