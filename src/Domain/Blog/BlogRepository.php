<?php

declare(strict_types=1);

namespace App\Domain\Blog;

interface BlogRepository
{
    /**
     * @return Blog[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Blog
     * @throws BlogNotFoundException
     */
    public function findById($id): Blog;

    /**
     * @return Blog
     * @throws BlogNotCreatedException
     */
    public function create($data): Blog;

    /**
     * @return Blog
     * @throws BlogNotCreatedException
     */
    public function update($data): Blog;

    /**
     * @param int $id
     * @throws BlogNotFoundException
     */
    public function deleteById(int $id);
}
