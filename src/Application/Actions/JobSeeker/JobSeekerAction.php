<?php

declare(strict_types=1);

namespace App\Application\Actions\JobSeeker;

use App\Application\Actions\Action;
use App\Domain\JobSeeker\JobSeekerRepository;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

abstract class JobSeekerAction extends Action
{
    protected JobSeekerRepository $jobSeekerRepository;

    public function __construct(
        LoggerInterface $logger,
        ContainerInterface $container,
        JobSeekerRepository $jobSeekerRepository
    ) {
        parent::__construct($logger, $container);
        $this->jobSeekerRepository = $jobSeekerRepository;
    }
}
