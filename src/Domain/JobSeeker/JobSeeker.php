<?php

declare(strict_types=1);

namespace App\Domain\JobSeeker;

use JsonSerializable;

class JobSeeker implements JsonSerializable
{
  private ?int $id;
  private $firstName;
  private $lastName;
  private $email;
  private $phone;

  public function __construct(?int $id, $firstName, $lastName, $email, $phone)
  {
    $this->id = $id;
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->email = $email;
    $this->phone = $phone;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getFirstName()
  {
    return $this->firstName;
  }

  public function getLastName()
  {
    return $this->lastName;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function getPhone()
  {
    return $this->phone;
  }

  #[\ReturnTypeWillChange]
  public function jsonSerialize(): array
  {
    return [
      'id' => $this->id,
      'firstName' => $this->firstName,
      'lastName' => $this->lastName,
      'email' => $this->email,
      'phone' => $this->phone,
      'query' => $this->query,
    ];
  }
}