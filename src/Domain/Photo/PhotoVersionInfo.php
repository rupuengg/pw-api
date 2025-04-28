<?php

declare(strict_types=1);

namespace App\Domain\Photo;

use JsonSerializable;

class PhotoVersionInfo implements JsonSerializable
{
  private string $id;

  private string $name;

  public function __construct(string $id, string $name)
  {
    $this->id = $id;
    $this->name = $name;
  }

  public function getId(): string
  {
    return $this->id;
  }

  public function getName(): string
  {
    return $this->name;
  }

  #[\ReturnTypeWillChange]
  public function jsonSerialize(): array
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
    ];
  }
}