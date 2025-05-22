<?php

namespace App\Infrastructure\Persistence\Blog;

use App\Domain\Blog\Blog;
use App\Domain\Blog\BlogNotFoundException;
use App\Domain\Blog\BlogRepository;
use DomainException;
use Selective\Database\Connection;

final class BlogReaderRepository implements BlogRepository
{
    private Connection $connection;
    private $tableName = "blogs";
    private $columns = [
        'id',
        'title',
        'route',
        'description',
        'isShow',
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
            throw new DomainException(sprintf('Blog not found'));
        }

        $blogs = [];

        for ($iCounter = 0; $iCounter < count($rows); $iCounter++) {
            array_push($blogs, $this->makeBlogData($rows[$iCounter]));
        }

        return $blogs;
    }

    public function findById($id): Blog
    {
        $query = $this->connection->select()->from($this->tableName);
        $query->columns($this->columns);
        $query->where('route', '=', $id);

        $row = $query->execute()->fetch() ?: [];

        if (!$row) {
            throw new DomainException(sprintf('Blog not found: %s', $id));
        }

        return $this->makeBlogData($row);
    }

    /**
     * @throws BlogNotFoundException
     */
    public function create($d): Blog
    {
        $d['id'] = null;
        $query = $this->connection->insert()->into($this->tableName)->set($d);
        $row = $query->execute();

        if (!$row) {
            throw new DomainException(sprintf('Blog not found'));
        }

        return $this->findById($query->lastInsertId());
    }

    /**
     * @throws BlogNotFoundException
     */
    public function update($d): Blog
    {
        $id = $d['id'];
        $query = $this->connection->update()->table($this->tableName)->set($d)->where("id", "=", $d['id']);
        $row = $query->execute();

        if (!$row) {
            throw new DomainException(sprintf('Blog not found: %s', $id));
        }

        return $this->findById($id);
    }

    public function deleteById(int $id)
    {
        $query = $this->connection->delete()->from($this->tableName)->where("id", "=", $id);
        $row = $query->execute();

        if (!$row) {
            throw new DomainException(sprintf('Blog not found: %s', $id));
        }

        return 'OK';
    }

    private function makeBlogData($row): Blog
    {
        return new Blog($row['id'], $row['title'], $row['route'], $row['description'], $row['isShow']);
    }
}
