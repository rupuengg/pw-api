<?php

declare(strict_types=1);

namespace App\Domain\BasicConfig;

use App\Domain\DomainException\DomainRecordNotFoundException;

class BasicConfigNotCreatedException extends DomainRecordNotFoundException
{
    public $message = 'The basic config you want to created issue.';
}
