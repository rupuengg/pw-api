<?php

namespace App\Infrastructure\Persistence\Project;

use App\Domain\Project\Project;
use App\Domain\Project\ProjectNotFoundException;
use App\Domain\Project\ProjectRepository;
use DomainException;
use Selective\Database\Connection;

final class ProjectReaderRepository implements ProjectRepository
{
    private Connection $connection;
    private $tableName = "projects";
    private $columns = [
        'id',
        'title',
        'addressId',
        'startDate',
        'endDate',
        'imageKitGalleryName',
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
            throw new DomainException(sprintf('Project not found'));
        }

        $alls = [];

        for ($iCounter = 0; $iCounter < count($rows); $iCounter++) {
            array_push($alls, $this->makeData($rows[$iCounter]));
        }

        return $alls;
    }

    public function findById($id): Project
    {
        $query = $this->connection->select()->from($this->tableName);
        $query->columns($this->columns);
        $query->where('route', '=', $id);

        $row = $query->execute()->fetch() ?: [];

        if (!$row) {
            throw new DomainException(sprintf('Project not found: %s', $id));
        }

        return $this->makeData($row);
    }

    /**
     * @throws ProjectNotFoundException
     */
    public function create($d): Project
    {
        $d['id'] = null;
        $query = $this->connection->insert()->into($this->tableName)->set($d);
        $row = $query->execute();

        if (!$row) {
            throw new DomainException(sprintf('Project not found'));
        }

        return $this->findById($query->lastInsertId());
    }

    /**
     * @throws ProjectNotFoundException
     */
    public function update($d): Project
    {
        $id = $d['id'];
        $query = $this->connection->update()->table($this->tableName)->set($d)->where("id", "=", $d['id']);
        $row = $query->execute();

        if (!$row) {
            throw new DomainException(sprintf('Project not found: %s', $id));
        }

        return $this->findById($id);
    }

    public function deleteById(int $id)
    {
        $query = $this->connection->delete()->from($this->tableName)->where("id", "=", $id);
        $row = $query->execute();

        if (!$row) {
            throw new DomainException(sprintf('Project not found: %s', $id));
        }

        return 'OK';
    }

    private function makeData($row): Project
    {
        return new Project($row['id'], $row['title'], $row['addressId'], $row['startDate'], $row['endDate'], $row['imageKitGalleryName']);
    }
}
