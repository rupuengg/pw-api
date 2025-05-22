<?php

declare(strict_types=1);

namespace App\Domain\Menu;

use App\Domain\DomainException\DomainRecordNotFoundException;

class MenuGroupNotCreatedException extends DomainRecordNotFoundException
{
    public $message = 'The menu group you want to created issue.';
}
