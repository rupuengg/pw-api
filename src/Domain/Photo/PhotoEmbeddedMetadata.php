<?php

declare(strict_types=1);

namespace App\Domain\Photo;

use JsonSerializable;

class PhotoEmbeddedMetadata implements JsonSerializable
{
  private string $YResolution;

  private string $XResolution;

  private string $DateCreated;

  private string $DateTimeCreated;

  public function __construct(string $YResolution, string $XResolution, string $DateCreated, $DateTimeCreated)
  {
    $this->YResolution = $YResolution;
    $this->XResolution = $XResolution;
    $this->DateCreated = $DateCreated;
    $this->DateTimeCreated = $DateTimeCreated;
  }

  public function getYResolution(): string
  {
    return $this->YResolution;
  }

  public function getXResolution(): string
  {
    return $this->XResolution;
  }

  public function getDateCreated(): string
  {
    return $this->DateCreated;
  }

  public function getDateTimeCreated(): string
  {
    return $this->DateTimeCreated;
  }

  #[\ReturnTypeWillChange]
  public function jsonSerialize(): array
  {
    return [
      'YResolution' => $this->YResolution,
      'XResolution' => $this->XResolution,
      'DateCreated' => $this->DateCreated,
      'DateTimeCreated' => $this->DateTimeCreated,
    ];
  }
}