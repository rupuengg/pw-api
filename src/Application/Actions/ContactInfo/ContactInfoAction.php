<?php

declare(strict_types=1);

namespace App\Application\Actions\ContactInfo;

use App\Application\Actions\Action;
use App\Domain\ContactInfo\ContactInfoRepository;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

abstract class ContactInfoAction extends Action
{
    protected ContactInfoRepository $contactInfoRepository;

    public function __construct(
        LoggerInterface $logger,
        ContainerInterface $container,
        ContactInfoRepository $contactInfoRepository
    ) {
        parent::__construct($logger, $container);
        $this->contactInfoRepository = $contactInfoRepository;
    }
}
