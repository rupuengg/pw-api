<?php

namespace App\Infrastructure\Persistence\Menu;

use App\Domain\Menu\Menu;
use App\Domain\Menu\MenuGroup;
use App\Domain\Menu\MenuGroupRepository;
use DomainException;
use Selective\Database\Connection;
use Selective\Database\SelectQuery;

final class MenuGroupReaderRepository implements MenuGroupRepository
{
    private Connection $connection;
    private $tableName = "menu_groups";
    private string $orderBy = "id asc";

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    private function makeSingleQuery(): SelectQuery
    {
        $query = $this->connection->select();
        $query->from($this->tableName);
        $query->leftJoin(
            "menu_group_mappers",
            "menu_groups.menuGroupId",
            "=",
            "menu_group_mappers.menuGroupId",
        );
        $query->leftJoin(
            "menus",
            "menu_group_mappers.menuId",
            "=",
            "menus.id"
        );
        $query->columns([
            'menu_groups.menuGroupId',
            'menu_groups.menuGroupTitle',
            'menu_groups.menuGroupType',
            "menus.*"
        ]);

        return $query;
    }

    public function findAll(): array
    {
        $query = $this->makeSingleQuery();
        $rows = $query->execute()->fetchAll() ?: [];

        if (!is_array($rows)) {
            throw new DomainException(sprintf('Menu Group not found'));
        }

        return array_values((array)$this->convertDataWithMenu($rows));
    }

    public function findById($id): MenuGroup
    {
        $query = $this->makeSingleQuery()->where("menu_groups.menuGroupId", "=", $id);
        $row = $query->execute()->fetchAll() ?: [];

        if (!$row) {
            throw new DomainException(sprintf('Menu group not found: %s', $id));
        }

        $ar = array_values((array)$this->convertDataWithMenu($row));

        return $ar[0];
    }

    public function findByType($menuGroupType): MenuGroup
    {
        $query = $this->makeSingleQuery()->where("menu_groups.menuGroupType", "=", $menuGroupType);
        $row = $query->execute()->fetchAll() ?: [];

        if (!$row) {
            throw new DomainException(sprintf('Menu group not found: %s', $menuGroupType));
        }

        $ar = array_values((array)$this->convertDataWithMenu($row));

        return $ar[0];
    }

    public function create($data): MenuGroup
    {
        $data['id'] = null;
        $menus = $data['menus'];
        $query = $this->connection->insert()->into($this->tableName);
        $query->set(['menuGroupTitle' => $data['menuGroupTitle'], 'menuGroupType' => $data['menuGroupType']]);
        $query->execute();

        $menuGroupId = $query->lastInsertId();
        foreach ($menus as $menu) {
            $query = $this->connection->insert()->into('menu_group_mappers');
            $query->set(['menuGroupId' => $menuGroupId, 'menuId' => $menu])->execute();
        }

        return $this->findById($menuGroupId);
    }

    public function update($data): MenuGroup
    {
        $id = $data['id'];
        $menus = $data['menus'];
        $query = $this->connection->update()->table($this->tableName);
        $query->set(['menuGroupTitle' => $data['menuGroupTitle'], 'menuGroupType' => $data['menuGroupType']]);
        $query->where("menuGroupId", "=", $data['id']);
        $query->execute();

        $query = $this->connection->delete()->from('menu_group_mappers');
        $query->where("menuGroupId", "=", $id);
        $query->execute();

        foreach ($menus as $menu) {
            $menuId = !empty($menu['id']) ? $menu['id'] : $menu;
            $query = $this->connection->insert()->into('menu_group_mappers');
            $query->set(['menuGroupId' => $id, 'menuId' => $menuId])->execute();
        }

        return $this->findById($id);
    }

    public function deleteById(int $id)
    {
        $query = $this->connection->delete()->from($this->tableName);
        $query->where("menuGroupId", "=", $id);
        $query->execute();

        $query = $this->connection->delete()->from('menu_group_mappers');
        $query->where("menuGroupId", "=", $id);
        $query->execute();

        return 'OK';
    }

    private function convertData($row): MenuGroup
    {
        return new MenuGroup($row['menuGroupId'], $row['menuGroupTitle'], $row['menuGroupType'], []);
    }

    private function convertDataWithMenu($rows): array
    {
        $menuGroups = [];

        for ($iCounter = 0; $iCounter < count($rows); $iCounter++) {
            $menuGroup = $this->convertData($rows[$iCounter]);

            if (!isset($menuGroups[$menuGroup->getId()])) {
                $menuGroups[$menuGroup->getId()] = $menuGroup;
            }

            $menus = $menuGroups[$menuGroup->getId()]->getMenus();
            if ($rows[$iCounter]['id']) {
                $menu = $this->convertMenu($rows[$iCounter]);
                $menus[] = $menu;
            }
            $menuGroups[$menuGroup->getId()]->updateMenu($menus);
        }

        return $menuGroups;
    }

    private function convertMenu($row): Menu
    {
        return new Menu(
            $row['id'],
            $row['title'],
            $row['route'],
            $row['page'],
            $row['menuType'],
            $row['type'],
            $row['isParent'],
            $row['items'],
            $row['subMenuId'],
            $row['entrypoint']
        );
    }
}
