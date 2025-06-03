<?php

declare(strict_types=1);

namespace App\Domain\Project;

use App\Domain\DomainException\DomainRecordNotFoundException;

class ProjectNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The project you requested does not exist.';
}
