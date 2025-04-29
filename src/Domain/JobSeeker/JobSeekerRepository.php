<?php

declare(strict_types=1);

namespace App\Domain\JobSeeker;

interface JobSeekerRepository
{
    /**
     * @return JobSeeker[]
     */
    public function findAll(): array;

    /**
     * @return JobSeeker
     * @throws JobSeekerNotCreatedException
     */
    public function create($data): JobSeeker;

    /**
     * @param int $id
     * @throws JobSeekerNotCreatedException
     */
    public function deleteOfId(int $id);
}
