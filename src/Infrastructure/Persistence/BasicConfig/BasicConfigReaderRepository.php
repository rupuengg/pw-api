<?php

namespace App\Infrastructure\Persistence\BasicConfig;

use App\Domain\BasicConfig\BasicConfig;
use App\Domain\BasicConfig\BasicConfigNotFoundException;
use App\Domain\BasicConfig\BasicConfigNotCreatedException;
use App\Domain\BasicConfig\BasicConfigRepository;
use DomainException;
use Selective\Database\Connection;

final class BasicConfigReaderRepository implements BasicConfigRepository
{
    private Connection $connection;
    private $tableName = "basic_config";
    private $columns = [
        'id',
        'key',
        'socialMediaLink',
    ];

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
            throw new DomainException(sprintf('Basic config not found'));
        }

        $basicConfigs = [];

        for ($iCounter = 0; $iCounter < count($rows); $iCounter++) {
            array_push($basicConfigs, $this->makeData($rows[$iCounter]));
        }

        return $basicConfigs;
    }

    public function findById($id): BasicConfig
    {
        $query = $this->connection->select()->from($this->tableName);
        $query->columns($this->columns);
        $query->where('id', '=', $id);

        $row = $query->execute()->fetch() ?: [];

        if (!$row) {
            throw new DomainException(sprintf('Basic config not found: %s', $id));
        }

        return $this->makeData($row);
    }

    public function findByKey($key): BasicConfig
    {
        $query = $this->connection->select()->from($this->tableName);
        $query->columns($this->columns);
        $query->where('key', '=', $key);

        $row = $query->execute()->fetch() ?: [];

        if (!$row) {
            throw new DomainException(sprintf('Basic config not found: %s', $id));
        }

        return $this->makeData($row);
    }

    /**
     * @throws BasicConfigNotCreatedException
     */
    public function create($d): BasicConfig
    {
        $query = $this->connection->insert()->into($this->tableName)->set($d);
        $row = $query->execute();

        if (!$row) {
            throw new DomainException(sprintf('Basic config not found'));
        }

        return $this->findById($query->lastInsertId());
    }

    /**
     * @throws BasicConfigNotFoundException
     */
    public function update($d): BasicConfig
    {
        $id = $d['id'];
        $query = $this->connection->update()->table($this->tableName)->set($d)->where("id", "=", $d['id']);
        $row = $query->execute();

        if (!$row) {
            throw new DomainException(sprintf('Basic config not found: %s', $id));
        }

        return $this->findById($id);
    }

    /**
     * @throws BasicConfigNotFoundException
     */
    public function deleteById(int $id)
    {
        $query = $this->connection->delete()->from($this->tableName)->where("id", "=", $id);
        $row = $query->execute();

        if (!$row) {
            throw new DomainException(sprintf('Basic config not found: %s', $id));
        }

        return 'OK';
    }

    private function makeData($row): BasicConfig
    {
        return new BasicConfig($row['id'], $row['key'], $row['socialMediaLink']);
    }
}
