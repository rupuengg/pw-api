<?php

namespace App\Infrastructure\Persistence\JobSeeker;

use App\Domain\JobSeeker\JobSeeker;
use App\Domain\JobSeeker\JobSeekerRepository;
use DomainException;
use Selective\Database\Connection;

final class JobSeekerReaderRepository implements JobSeekerRepository
{
    private Connection $connection;
	
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $query = $this->connection->select()->from('job-seeker');

        $query->columns(['id', 'firstName', 'lastName', 'email', 'phone']);

        $rows = $query->execute()->fetchAll() ?: [];
		
		if(!is_array($rows)) {
            throw new DomainException(sprintf('Contact Info not found'));
        }
		
		$contactInfos = array();
		
		for ($iCounter = 0; $iCounter < count($rows); $iCounter++) {
            $row = $rows[$iCounter];
			array_push($contactInfos, new JobSeeker($row['id'], $row['firstName'], $row['lastName'], $row['email'], $row['phone']));
		}

        return $contactInfos;
    }

    public function create($d): JobSeeker
    {
        $d['id'] = null;
        $query = $this->connection->insert()->into('job-seeker')->set($d);

        $row = $query->execute();

		return $this->findContactInfoOfId($query->lastInsertId());
    }

    private function findContactInfoOfId(int $id): JobSeeker
    {
        $query = $this->connection->select()->from('job-seeker');

        $query->columns(['id', 'firstName', 'lastName', 'email', 'phone']);
        $query->where('id', '=', $id);

        $row = $query->execute()->fetch() ?: [];

        if(!$row) {
            throw new DomainException(sprintf('Job Seeker not found: %s', $id));
        }
		
		return new JobSeeker($row['id'], $row['firstName'], $row['lastName'], $row['email'], $row['phone']);
    }

    public function deleteOfId(int $id)
    {
        $query = $this->connection->delete()->from('job-seeker')->where("id", "=", $id);

        $row = $query->execute();

        if(!$row) {
            throw new DomainException(sprintf('Job Seeker not found: %s', $id));
        }
		
		return 'OK';
    }
}