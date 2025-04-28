<?php

declare(strict_types=1);

namespace App\Domain\ContactInfo;

interface ContactInfoRepository
{
    /**
     * @return ContactInfo[]
     */
    public function findAll(): array;

    /**
     * @return ContactInfo
     * @throws ContactInfoNotCreatedException
     */
    public function create($data): ContactInfo;
}
