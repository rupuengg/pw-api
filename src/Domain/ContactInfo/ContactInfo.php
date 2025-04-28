<?php

declare(strict_types=1);

namespace App\Domain\ContactInfo;

use JsonSerializable;

class ContactInfo implements JsonSerializable
{
  // SEO
  private ?int $id;
  private $isRead;
  private $name;
  private $email;
  private $phone;
  private $query;

  public function __construct($id, $isRead, $name, $email, $phone, $query)
  {
    $this->id = $id;
    $this->isRead = $isRead;
    $this->name = $name;
    $this->email = $email;
    $this->phone = $phone;
    $this->query = $query;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getIsRead()
  {
    return $this->isRead;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function getPhone()
  {
    return $this->phone;
  }

  public function getQuery()
  {
    return $this->query;
  }

  #[\ReturnTypeWillChange]
  public function jsonSerialize(): array
  {
    return [
      'id' => $this->id,
      'isRead' => $this->isRead,
      'name' => $this->name,
      'email' => $this->email,
      'phone' => $this->phone,
      'query' => $this->query,
    ];
  }
}