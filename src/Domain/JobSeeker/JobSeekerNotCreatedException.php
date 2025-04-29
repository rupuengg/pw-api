<?php

declare(strict_types=1);

namespace App\Domain\JobSeeker;

use App\Domain\DomainException\DomainRecordNotFoundException;

class JobSeekerNotCreatedException extends DomainRecordNotFoundException
{
    public $message = 'The job seeker you want to c reated issue.';
}
