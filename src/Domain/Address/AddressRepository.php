<?php

declare(strict_types=1);

namespace App\Domain\Address;

interface AddressRepository
{
    /**
     * @return Address[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Address
     * @throws AddressNotFoundException
     */
    public function findById($id): Address;

    /**
     * @return Address
     * @throws AddressNotCreatedException
     */
    public function create($data): Address;

    /**
     * @return Address
     * @throws AddressNotFoundException
     */
    public function update($data): Address;

    /**
     * @param int $id
     * @throws AddressNotFoundException
     */
    public function deleteById(int $id);
}
