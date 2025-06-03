<?php

declare(strict_types=1);

namespace App\Domain\Project;

use JsonSerializable;

class Project implements JsonSerializable
{
    private ?int $id;
    private $title;
    private $addressId;
    private $startDate;
    private $endDate;
    private $imageKitGalleryName;

    public function __construct($id, $title, $addressId, $startDate, $endDate, $imageKitGalleryName)
    {
        $this->id = $id;
        $this->title = $title;
        $this->addressId = $addressId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->imageKitGalleryName = $imageKitGalleryName;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAddressId()
    {
        return $this->addressId;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function getImageKitGalleryName()
    {
        return $this->imageKitGalleryName;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
        'id' => $this->id,
        'title' => $this->title,
        'addressId' => $this->addressId,
        'startDate' => $this->startDate,
        'endDate' => $this->endDate,
        'imageKitGalleryName' => $this->imageKitGalleryName,
        ];
    }
}
