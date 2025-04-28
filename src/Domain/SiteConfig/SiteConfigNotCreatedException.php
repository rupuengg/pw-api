<?php

declare(strict_types=1);

namespace App\Domain\SiteConfig;

use App\Domain\DomainException\DomainRecordNotFoundException;

class SiteConfigNotCreatedException extends DomainRecordNotFoundException
{
    public $message = 'The site config you want to c reated issue.';
}
