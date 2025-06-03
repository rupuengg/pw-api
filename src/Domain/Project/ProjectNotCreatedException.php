<?php

declare(strict_types=1);

namespace App\Domain\Project;

use App\Domain\DomainException\DomainRecordNotFoundException;

class ProjectNotCreatedException extends DomainRecordNotFoundException
{
    public $message = 'The project you want to created issue.';
}
