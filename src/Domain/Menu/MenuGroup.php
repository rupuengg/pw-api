<?php

declare(strict_types=1);

namespace App\Domain\Menu;

use JsonSerializable;

class MenuGroup implements JsonSerializable
{
    private ?int $menuGroupId;
    private $menuGroupTitle;
    private $menuGroupType;
    private $menus;

    public function __construct(?int $menuGroupId, $menuGroupTitle, $menuGroupType, array $menus)
    {
        $this->menuGroupId = $menuGroupId;
        $this->menuGroupTitle = $menuGroupTitle;
        $this->menuGroupType = $menuGroupType;
        $this->menus = $menus;
    }

    public function getId()
    {
        return $this->menuGroupId;
    }

    public function getTitle()
    {
        return $this->menuGroupTitle;
    }

    public function getType()
    {
        return $this->menuGroupType;
    }

    public function getMenus()
    {
        return $this->menus;
    }

    public function updateMenu(array $menus) {
        $this->menus = $menus;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
        'id' => $this->menuGroupId,
        'menuGroupTitle' => $this->menuGroupTitle,
        'menuGroupType' => $this->menuGroupType,
        'menus' => $this->menus,
        ];
    }
}
