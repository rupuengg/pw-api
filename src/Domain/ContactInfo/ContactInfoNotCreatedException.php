<?php

declare(strict_types=1);

namespace App\Domain\ContactInfo;

use App\Domain\DomainException\DomainRecordNotFoundException;

class ContactInfoNotCreatedException extends DomainRecordNotFoundException
{
    public $message = 'The site config you want to c reated issue.';
}
