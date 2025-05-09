<?php

declare(strict_types=1);

namespace App\Domain\Menu;

interface MenuRepository
{
    /**
     * @return Menu[]
     */
    public function findAll(): array;

    /**
     * @return Menu[]
     */
    public function findAllByMenuType($menuType, $isShow): array;

    /**
     * @param int $id
     * @return Menu
     * @throws MenuNotCreatedException
     */
    public function findById(int $id): Menu;

    /**
     * @return Menu
     * @throws MenuNotCreatedException
     */
    public function create($data): Menu;

    /**
     * @return Menu
     * @throws MenuNotCreatedException
     */
    public function update($data): Menu;

    /**
     * @param int $id
     * @throws MenuNotCreatedException
     */
    public function deleteById(int $id);
}
