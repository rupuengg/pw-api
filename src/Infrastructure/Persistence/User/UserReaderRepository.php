<?php

namespace App\Infrastructure\Persistence\User;

use App\Domain\Menu\Menu;
use DomainException;
use Firebase\JWT\JWT;
use Selective\Database\Connection;
use App\Domain\User\User;
use App\Domain\User\UserRepository;
use Selective\Database\SelectQuery;

final class UserReaderRepository implements UserRepository
{
    private Connection $connection;

    private $tableName = 'users';

    private $columns = ['id', 'email', 'username', 'firstName', 'lastName'];

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $rows = $this->makeSelect()->execute()->fetchAll() ?: [];

        if (!$rows) {
            throw new DomainException(sprintf('Users not found'));
        }

        $users = [];
        for ($iCounter = 0; $iCounter < count($rows); $iCounter++) {
            $users[] = $this->convertData($rows[$iCounter]);
        }

        return $users;
    }

    public function findUserOfId(int $id): User
    {
        $query = $this->makeSelect()->where('id', '=', $id);
        $row = $query->execute()->fetch() ?: [];

        if (!$row) {
            throw new DomainException(sprintf('User not found: %s', $id));
        }

        return $this->convertData($row);
    }

    public function profile($user): User
    {
        $query = $this->makeSelect()->where('id', '=', $user->id);
        $row = $query->execute()->fetch() ?: [];

        if (!$row) {
            throw new DomainException(sprintf('User not found: %s', $user->id));
        }

        return $this->convertData($row);
    }

    public function login($data)
    {
        $query = $this->makeSelect();
        $query->where('username', '=', $data['username']);
        $query->where('password', '=', $data['password']);
        $row = $query->execute()->fetch() ?: [];

        if (!$row) {
            return ['error' => 'Wrong username or password'];
        }

        $token = $this->generateToken($row, 'Admin');

        return ['token' => $token, 'user' => $this->convertData($row)];
    }

    public function logout()
    {
        $this->deleteToken([], 'Admin');
//        $query = $this->connection->delete()->from($this->tableName)->where("id", "=", $id);
//
//        $row = $query->execute();
//
//        if (!$row) {
//            throw new DomainException(sprintf('Contact Info not found: %s', $id));
//        }

        return 'OK';
    }

    private function convertData($row): User
    {
        return new User(
            $row['id'],
            $row['email'],
            $row['username'],
            $row['firstName'],
            $row['lastName']
        );
    }

    private function generateToken($user, $role): string
    {
        $payload = [
            "user" => $user,
            "role" => $role,
            "iat" => time(), // Issue at time
            "exp" => time() + 3600 // Expires in 1 hour
        ];
        $secret_key = "your_secret_key"; // Keep secret!
        return JWT::encode($payload, $secret_key, 'HS256');
    }

    private function deleteToken($user, $role): string
    {
        $payload = [
            "user" => $user,
            "role" => $role,
            "iat" => -time(), // Issue at time
            "exp" => -time() + 3600 // Expires in 1 hour
        ];
        $secret_key = "your_secret_key"; // Keep secret!
        return JWT::encode($payload, $secret_key, 'HS256');
    }

    private function makeSelect(): SelectQuery
    {
        return $this->connection->select()->from($this->tableName)->columns($this->columns);
    }
}
