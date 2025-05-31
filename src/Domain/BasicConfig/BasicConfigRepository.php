<?php

declare(strict_types=1);

namespace App\Domain\BasicConfig;

interface BasicConfigRepository
{
    /**
     * @return BasicConfig[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return BasicConfig
     * @throws BasicConfigNotFoundException
     */
    public function findById($id): BasicConfig;

    /**
     * @param int $key
     * @return BasicConfig
     * @throws BasicConfigNotFoundException
     */
    public function findByKey($key): BasicConfig;

    /**
     * @return BasicConfig
     * @throws BasicConfigNotCreatedException
     */
    public function create($data): BasicConfig;

    /**
     * @return BasicConfig
     * @throws BasicConfigNotFoundException
     */
    public function update($data): BasicConfig;

    /**
     * @param int $id
     * @throws BasicConfigNotFoundException
     */
    public function deleteById(int $id);
}
