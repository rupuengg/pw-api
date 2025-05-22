<?php

declare(strict_types=1);

namespace App\Domain\Blog;

use JsonSerializable;

class Blog implements JsonSerializable
{
    private ?int $id;
    private $title;
    private $route;
    private $description;
    private $isShow;

    public function __construct($id, $title, $route, $description, $isShow)
    {
        $this->id = $id;
        $this->title = $title;
        $this->route = $route;
        $this->description = $description;
        $this->isShow = $isShow;
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

    public function getDescription()
    {
        return $this->description;
    }

    public function getIsShow()
    {
        return $this->isShow;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
        'id' => $this->id,
        'title' => $this->title,
        'route' => $this->route,
        'description' => $this->description,
        'isShow' => $this->isShow,
        ];
    }
}
