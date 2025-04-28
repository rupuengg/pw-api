<?php

declare(strict_types=1);

namespace App\Application\Actions\SiteConfig;

use App\Application\Actions\Action;
use App\Domain\SiteConfig\SiteConfigRepository;
use Psr\Log\LoggerInterface;

abstract class SiteConfigAction extends Action
{
    protected SiteConfigRepository $siteConfigRepository;

    public function __construct(LoggerInterface $logger, SiteConfigRepository $siteConfigRepository)
    {
        parent::__construct($logger);
        $this->siteConfigRepository = $siteConfigRepository;
    }
}
