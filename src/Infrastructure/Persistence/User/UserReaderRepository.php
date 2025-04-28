<?php

namespace App\Infrastructure\Persistence\User;

use DomainException;
use Selective\Database\Connection;
use App\Domain\User\User;
use App\Domain\User\UserRepository;

final class UserReaderRepository implements UserRepository
{
    private Connection $connection;
	
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $query = $this->connection->select()->from('users');

        $query->columns(['id', 'email', 'username', 'firstName', 'lastName']);

        $rows = $query->execute()->fetchAll() ?: [];
		
		if(!$rows) {
            throw new DomainException(sprintf('User not found: %s', $id));
        }
		
		$users = array();
		
		for($iCounter = 0; $iCounter < count($rows); $iCounter++){
			array_push($users, new User($rows[$iCounter]['id'], $rows[$iCounter]['email'], $rows[$iCounter]['username'], $rows[$iCounter]['firstName'], $rows[$iCounter]['lastName']));
		}

        return $users;
    }

    public function findUserOfId(int $id): User
    {
        $query = $this->connection->select()->from('users');

        $query->columns(['id', 'email', 'username', 'firstName', 'lastName']);
        $query->where('id', '=', $id);

        $row = $query->execute()->fetch() ?: [];

        if(!$row) {
            throw new DomainException(sprintf('User not found: %s', $id));
        }
		
		$user = new User($row['id'], $row['email'], $row['username'], $row['firstName'], $row['lastName']);

        return $user;
    }

}