<?php

namespace App\Infrastructure\Persistence\Menu;

use DomainException;
use Selective\Database\Connection;
use App\Domain\Menu\Menu;
use App\Domain\Menu\MenuRepository;

final class MenuReaderRepository implements MenuRepository
{
    private Connection $connection;
    private $tableName = "menus";
    private $columns = ['id', 'title', 'link', 'type', 'subMenuId', 'entrypoint'];

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $query = $this->connection->select()->from($this->tableName);

        $query->columns($this->columns);

        $rows = $query->execute()->fetchAll() ?: [];

        if (!is_array($rows)) {
            throw new DomainException(sprintf('Menu not found'));
        }

        $contactInfos = [];

        for ($iCounter = 0; $iCounter < count($rows); $iCounter++) {
            $row = $rows[$iCounter];
            $contactInfos[] = $this->convertData($row);
        }

        return $contactInfos;
    }

    public function findById(int $id): Menu
    {
        $query = $this->connection->select()->from($this->tableName);

        $query->columns($this->columns);
        $query->where('id', '=', $id);

        $row = $query->execute()->fetch() ?: [];

        if (!$row) {
            throw new DomainException(sprintf('Menu not found: %s', $id));
        }

        return $this->convertData($row);
    }

    public function create($data): Menu
    {
        $data['id'] = null;
        $query = $this->connection->insert()->into($this->tableName)->set($data);

        $query->execute();

        return $this->findById($query->lastInsertId());
    }



    public function update($data): Menu
    {
        $id = $data['id'];
        $query = $this->connection->update()->table($this->tableName)->set($data)->where("id", "=", $data['id']);

        $row = $query->execute();

        if (!$row) {
            throw new DomainException(sprintf('Menu not found: %s', $id));
        }

        return $this->findById($id);
    }

    public function deleteById(int $id)
    {
        $query = $this->connection->delete()->from($this->tableName)->where("id", "=", $id);

        $row = $query->execute();

        if (!$row) {
            throw new DomainException(sprintf('Contact Info not found: %s', $id));
        }

        return 'OK';
    }

    private function convertData($row): Menu
    {
        return new Menu($row['id'], $row['title'], $row['link'], $row['type'], $row['subMenus'], $row['entrypoint']);
    }
}
