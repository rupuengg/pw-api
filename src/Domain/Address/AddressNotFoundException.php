<?php

declare(strict_types=1);

namespace App\Domain\Address;

use App\Domain\DomainException\DomainRecordNotFoundException;

class AddressNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The address you requested does not exist.';
}
