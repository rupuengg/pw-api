<?php

namespace App\Infrastructure\Persistence\ContactInfo;

use App\Domain\ContactInfo\ContactInfo;
use App\Domain\ContactInfo\ContactInfoRepository;
use DomainException;
use Selective\Database\Connection;

final class ContactInfoReaderRepository implements ContactInfoRepository
{
    private Connection $connection;
    private $tableName = "contact_info";
    private $columns = ['id', 'isRead', 'name', 'email', 'phone', 'query'];
    private string $orderBy = "id desc";

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $query = $this->connection->select()->from($this->tableName)->orderBy($this->orderBy);

        $query->columns($this->columns);

        $rows = $query->execute()->fetchAll() ?: [];

        if (!is_array($rows)) {
            throw new DomainException(sprintf('Contact Info not found'));
        }

        $contactInfos = [];

        for ($iCounter = 0; $iCounter < count($rows); $iCounter++) {
            $row = $rows[$iCounter];
            array_push($contactInfos, $this->convertData($row));
        }

        return $contactInfos;
    }

    public function create($d): ContactInfo
    {
        $d['id'] = null;
        $query = $this->connection->insert()->into($this->tableName)->set($d);

        $row = $query->execute();

        return $this->findContactInfoById($query->lastInsertId());
    }

    private function findContactInfoById(int $id): ContactInfo
    {
        $query = $this->connection->select()->from($this->tableName);

        $query->columns($this->columns);
        $query->where('id', '=', $id);

        $row = $query->execute()->fetch() ?: [];

        if (!$row) {
            throw new DomainException(sprintf('Contact Info not found: %s', $id));
        }

        return $this->convertData($row);
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



    private function convertData($row): ContactInfo
    {
        return new ContactInfo($row['id'], $row['isRead'], $row['name'], $row['email'], $row['phone'], $row['query']);
    }
}
