<?php

declare(strict_types=1);

namespace App\Domain\Menu;

use App\Domain\DomainException\DomainRecordNotFoundException;

class MenuNotCreatedException extends DomainRecordNotFoundException
{
    public $message = 'The menu you want to created issue.';
}
