<?php

declare(strict_types=1);

namespace App\Domain\Menu;

interface MenuGroupRepository
{
    /**
     * @return Menu[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return MenuGroup
     * @throws MenuGroupNotCreatedException
     */
    public function findById(int $id): MenuGroup;

    /**
     * @param $menuGroupType
     * @return MenuGroup
     * @throws MenuGroupNotCreatedException
     */
    public function findByType($menuGroupType): MenuGroup;

    /**
     * @return MenuGroup
     * @throws MenuGroupNotCreatedException
     */
    public function create($data): MenuGroup;

    /**
     * @return MenuGroup
     * @throws MenuGroupNotCreatedException
     */
    public function update($data): MenuGroup;

    /**
     * @param int $id
     * @throws MenuGroupNotCreatedException
     */
    public function deleteById(int $id);
}
