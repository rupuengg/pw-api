<?php

declare(strict_types=1);

namespace App\Domain\Address;

use App\Domain\DomainException\DomainRecordNotFoundException;

class AddressNotCreatedException extends DomainRecordNotFoundException
{
    public $message = 'The address you want to created issue.';
}
