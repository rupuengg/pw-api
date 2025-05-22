<?php

declare(strict_types=1);

namespace App\Domain\Blog;

use App\Domain\DomainException\DomainRecordNotFoundException;

class BlogNotCreatedException extends DomainRecordNotFoundException
{
    public $message = 'The blog you want to created issue.';
}
