<?php

namespace App\Infrastructure\Persistence\Project;

use App\Domain\Address\Address;
use App\Domain\Project\Project;
use App\Domain\Project\ProjectNotFoundException;
use App\Domain\Project\ProjectRepository;
use DomainException;
use Selective\Database\Connection;
use Selective\Database\SelectQuery;
use ImageKit\ImageKit;

final class ProjectReaderRepository implements ProjectRepository
{
    private Connection $connection;
    private ImageKit $imageKit;
    private $tableName = "projects";
    private $columns = [
        'id',
        'title',
        'addressId',
        'startDate',
        'endDate',
        'imageKitGalleryName',
    ];

    public function __construct(Connection $connection, ImageKit $imageKit)
    {
        $this->connection = $connection;
        $this->imageKit = $imageKit;
    }

    private function makeSingleQuery(): SelectQuery
    {
        $selectQuery = $this->connection->select();
        $selectQuery->from('projects');
        $selectQuery->leftJoin("address", "projects.addressId", "=", "address.id");
        $selectQuery->columns([
            'projects.id',
            'projects.title',
            'projects.addressId',
            'projects.startDate',
            'projects.endDate',
            'projects.imageKitGalleryName',
            'address.addressOne',
            'address.addressTwo',
            'address.city',
            'address.state',
            'address.zipCode',
            'address.country'
        ]);

        return $selectQuery;
    }

    public function findAll(): array
    {
        $query = $this->makeSingleQuery();
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
        $query = $this->makeSingleQuery()->where('projects.id', '=', $id);
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
        $query = $this->connection->insert()->into($this->tableName)->set($d);
        $row = $query->execute();

        $this->imageKit->createFolder([
            'folderName' => 'firstProject',
            'parentFolderPath' => 'projects'
        ]);

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

        $this->imageKit->createFolder([
            'folderName' => "firstProject",
            'parentFolderPath' => "/projects/"
        ]);

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
        $address = NULL;
        if(!empty($row['addressId'])) $address = new Address($row['addressId'], $row['addressOne'], $row['addressTwo'], $row['city'], $row['state'], $row['zipCode'], $row['country']);

        return new Project(
            $row['id'], 
            $row['title'], 
            $row['addressId'], 
            $row['startDate'], 
            $row['endDate'], 
            $row['imageKitGalleryName'],
            $address
        );
    }
}
