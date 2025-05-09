<?php

declare(strict_types=1);

namespace App\Domain\Menu;

use JsonSerializable;

class Menu implements JsonSerializable
{
    private ?int $id;
    private $title;
    private $route;
    private $page;
    private $menuType;
    private $type;
    private $subMenuId;
    private $entrypoint;

    public function __construct(?int $id, $title, $route, $page, $menuType, $type, $subMenuId, $entrypoint)
    {
        $this->id = $id;
        $this->title = $title;
        $this->route = $route;
        $this->page = $page;
        $this->menuType = $menuType;
        $this->type = $type;
        $this->subMenuId = $subMenuId;
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

    public function getRoute()
    {
        return $this->route;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function getMenuType()
    {
        return $this->menuType;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getSubMenuId()
    {
        return $this->subMenuId;
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
        'route' => $this->route,
        'page' => $this->page,
        'menuType' => $this->menuType,
        'type' => $this->type,
        'subMenuId' => $this->subMenuId,
        'entrypoint' => $this->entrypoint,
        ];
    }
}
