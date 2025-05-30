<?php

declare(strict_types=1);

namespace App\Domain\User;

interface UserRepository
{
    /**
     * @return User[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function findUserOfId(int $id): User;

    /**
     * @return User
     * @throws UserNotFoundException
     */
    public function profile($user): User;

    /**
     * @return User
     * @throws UserNotFoundException
     */
    public function login($data);

    /**
     * @throws UserNotFoundException
     */
    public function logout();
}
