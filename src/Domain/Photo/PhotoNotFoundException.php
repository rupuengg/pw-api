<?php

declare(strict_types=1);

namespace App\Domain\Photo;

use App\Domain\DomainException\DomainRecordNotFoundException;

class PhotoNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The photo you requested does not exist.';
}
