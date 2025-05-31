<?php

declare(strict_types=1);

namespace App\Domain\BasicConfig;

use JsonSerializable;

class BasicConfig implements JsonSerializable
{
    private ?int $id;
    private $key;
    private $socialMediaLink;

    public function __construct($id, $key, $socialMediaLink)
    {
        $this->id = $id;
        $this->key = $key;
        $this->socialMediaLink = $socialMediaLink;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSocialMediaLink()
    {
        return $this->socialMediaLink;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
        'id' => $this->id,
        'key' => $this->key,
        'socialMediaLink' => $this->socialMediaLink,
        ];
    }
}
