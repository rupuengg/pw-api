<?php

declare(strict_types=1);

namespace App\Domain\SiteConfig;

use App\Domain\DomainException\DomainRecordNotFoundException;

class SiteConfigNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The site config you requested does not exist.';
}
