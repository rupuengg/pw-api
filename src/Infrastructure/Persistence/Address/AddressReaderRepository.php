<?php

namespace App\Infrastructure\Persistence\Address;

use App\Domain\Address\Address;
use App\Domain\Address\AddressNotFoundException;
use App\Domain\Address\AddressRepository;
use DomainException;
use Selective\Database\Connection;

final class AddressReaderRepository implements AddressRepository
{
    private Connection $connection;
    private $tableName = "address";
    private $columns = [
        'id',
        'addressOne',
        'addressTwo',
        'city',
        'state',
        'zipCode',
        'country',
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
            throw new DomainException(sprintf('Address not found'));
        }

        $alls = [];

        for ($iCounter = 0; $iCounter < count($rows); $iCounter++) {
            array_push($alls, $this->makeData($rows[$iCounter]));
        }

        return $alls;
    }

    public function findById($id): Address
    {
        $query = $this->connection->select()->from($this->tableName);
        $query->columns($this->columns);
        $query->where('id', '=', $id);

        $row = $query->execute()->fetch() ?: [];

        if (!$row) {
            throw new DomainException(sprintf('Address not found: %s', $id));
        }

        return $this->makeData($row);
    }

    /**
     * @throws AddressNotFoundException
     */
    public function create($d): Address
    {
        $query = $this->connection->insert()->into($this->tableName)->set($d);
        $row = $query->execute();

        if (!$row) {
            throw new DomainException(sprintf('Address not found'));
        }

        return $this->findById($query->lastInsertId());
    }

    /**
     * @throws AddressNotFoundException
     */
    public function update($d): Address
    {
        $id = $d['id'];
        $query = $this->connection->update()->table($this->tableName)->set($d)->where("id", "=", $d['id']);
        $row = $query->execute();

        if (!$row) {
            throw new DomainException(sprintf('Address not found: %s', $id));
        }

        return $this->findById($id);
    }

    public function deleteById(int $id)
    {
        $query = $this->connection->delete()->from($this->tableName)->where("id", "=", $id);
        $row = $query->execute();

        if (!$row) {
            throw new DomainException(sprintf('Address not found: %s', $id));
        }

        return 'OK';
    }

    private function makeData($row): Address
    {
        return new Address($row['id'], $row['addressOne'], $row['addressTwo'], $row['city'], $row['state'], $row['zipCode'], $row['country']);
    }
}
