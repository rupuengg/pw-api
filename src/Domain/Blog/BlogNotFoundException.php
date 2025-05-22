<?php

declare(strict_types=1);

namespace App\Domain\Blog;

use App\Domain\DomainException\DomainRecordNotFoundException;

class BlogNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The blog you requested does not exist.';
}
