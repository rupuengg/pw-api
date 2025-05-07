<?php

declare(strict_types=1);

namespace App\Domain\Menu;

use JsonSerializable;

class Menu implements JsonSerializable
{
  // SEO
  private ?int $id;
  private $title;
  private $link;
  private $type;
  private $subMenus;
  private $entrypoint;

  public function __construct(?int $id, $title, $link, $type, $subMenus, $entrypoint)
  {
    $this->id = $id;
    $this->title = $title;
    $this->link = $link;
    $this->type = $type;
    $this->subMenus = $subMenus;
    $this->entrypoint = $entrypoint;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getTitle()
  {
    return $this->title;
  }

  public function getLink()
  {
    return $this->link;
  }

  public function getType()
  {
    return $this->type;
  }

  public function getSubMenus()
  {
    return $this->subMenus;
  }

  public function getEntrypoint()
  {
    return $this->entrypoint;
  }

  #[\ReturnTypeWillChange]
  public function jsonSerialize(): array
  {
    return [
      'id' => $this->id,
      'title' => $this->title,
      'link' => $this->link,
      'type' => $this->type,
      'subMenus' => $this->subMenus,
      'entrypoint' => $this->entrypoint,
    ];
  }
}