<?php

declare(strict_types=1);

namespace App\Domain\Project;

interface ProjectRepository
{
    /**
     * @return Project[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Project
     * @throws ProjectNotFoundException
     */
    public function findById($id): Project;

    /**
     * @return Project
     * @throws ProjectNotCreatedException
     */
    public function create($data): Project;

    /**
     * @return Project
     * @throws ProjectNotFoundException
     */
    public function update($data): Project;

    /**
     * @param int $id
     * @throws ProjectNotFoundException
     */
    public function deleteById(int $id);
}
