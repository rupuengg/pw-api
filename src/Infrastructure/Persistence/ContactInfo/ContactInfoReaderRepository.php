<?php

namespace App\Infrastructure\Persistence\ContactInfo;

use DomainException;
use Selective\Database\Connection;
use App\Domain\ContactInfo\ContactInfo;
use App\Domain\ContactInfo\ContactInfoRepository;

final class ContactInfoReaderRepository implements ContactInfoRepository
{
    private Connection $connection;
	
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $query = $this->connection->select()->from('contact_info');

        $query->columns(['id', 'isRead', 'name', 'email', 'phone', 'query']);

        $rows = $query->execute()->fetchAll() ?: [];
		
		if(!is_array($rows)) {
            throw new DomainException(sprintf('Contact Info not found'));
        }
		
		$contactInfos = array();
		
		for ($iCounter = 0; $iCounter < count($rows); $iCounter++) {
            $row = $rows[$iCounter];
			array_push($contactInfos, new ContactInfo($row['id'], $row['isRead'], $row['name'], $row['email'], $row['phone'], $row['query']));
		}

        return $contactInfos;
    }

    public function create($d): ContactInfo
    {
        $d['id'] = null;
        $query = $this->connection->insert()->into('contact_info')->set($d);

        $row = $query->execute();

		return $this->findContactInfoOfId($query->lastInsertId());
    }

    private function findContactInfoOfId(int $id): ContactInfo
    {
        $query = $this->connection->select()->from('contact_info');

        $query->columns(['id', 'isRead', 'name', 'email', 'phone', 'query']);
        $query->where('id', '=', $id);

        $row = $query->execute()->fetch() ?: [];

        if(!$row) {
            throw new DomainException(sprintf('Contact Info not found: %s', $id));
        }
		
		return new ContactInfo($row['id'], $row['isRead'], $row['name'], $row['email'], $row['phone'], $row['query']);
    }
}