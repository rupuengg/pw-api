<?php

declare(strict_types=1);

namespace App\Domain\Photo;

use JsonSerializable;

class Photo implements JsonSerializable
{
    private string $type;

    private string $name;

    private string $createdAt;

    private string $updatedAt;

    private string $fileId;

    private $tags;

    private $AITags;

    private PhotoVersionInfo $versionInfo;

    private PhotoEmbeddedMetadata $embeddedMetadata;

    private string $isPublished;

    private $customCoordinates;

    private PhotoCustomMetadata $customMetadata;

    private string $isPrivateFile;

    private string $url;

    private string $thumbnail;

    private string $fileType;

    private string $filePath;

    private string $height;

    private string $width;

    private string $size;

    private string $hasAlpha;

    private string $mime;

    public function __construct(
        string $type,
        string $name,
        string $createdAt,
        string $updatedAt,
        string $fileId,
        $tags,
        $AITags,
        PhotoVersionInfo $versionInfo,
        PhotoEmbeddedMetadata $embeddedMetadata,
        string $isPublished,
        $customCoordinates,
        PhotoCustomMetadata $customMetadata,
        string $isPrivateFile,
        string $url,
        string $thumbnail,
        string $fileType,
        string $filePath,
        string $height,
        string $width,
        string $size,
        string $hasAlpha,
        string $mime
    )
    {
        $this->type = $type;
        $this->name = $name;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->fileId = $fileId;
        $this->tags = $tags;
        $this->AITags = $AITags;
        $this->versionInfo = $versionInfo;
        $this->embeddedMetadata = $embeddedMetadata;
        $this->isPublished = $isPublished;
        $this->customCoordinates = $customCoordinates;
        $this->customMetadata = $customMetadata;
        $this->isPrivateFile = $isPrivateFile;
        $this->url = $url;
        $this->thumbnail = $thumbnail;
        $this->fileType = $fileType;
        $this->filePath = $filePath;
        $this->height = $height;
        $this->width = $width;
        $this->size = $size;
        $this->hasAlpha = $hasAlpha;
        $this->mime = $mime;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getFileId(): string
    {
        return $this->fileId;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function getAITags()
    {
        return $this->AITags;
    }

    public function getVersionInfo(): PhotoVersionInfo
    {
        return $this->versionInfo;
    }

    public function getEmbeddedMetadata(): PhotoEmbeddedMetadata
    {
        return $this->embeddedMetadata;
    }

    public function getIsPublished(): string
    {
        return $this->isPublished;
    }

    public function getCustomCoordinates()
    {
        return $this->customCoordinates;
    }

    public function getCustomMetadata(): PhotoCustomMetadata
    {
        return $this->customMetadata;
    }

    public function getIsPrivateFile(): string
    {
        return $this->isPrivateFile;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    public function getFileType(): string
    {
        return $this->fileType;
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }

    public function getHeight(): string
    {
        return $this->height;
    }

    public function getWidth(): string
    {
        return $this->width;
    }

    public function getSize(): string
    {
        return $this->size;
    }

    public function getHasAlpha(): string
    {
        return $this->hasAlpha;
    }

    public function getMime(): string
    {
        return $this->mime;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'type' => $this->type,
            'name' => $this->name,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'fileId' => $this->fileId,
            'tags' => $this->tags,
            'AITags' => $this->AITags,
            'versionInfo' => $this->versionInfo,
            'embeddedMetadata' => $this->embeddedMetadata,
            'isPublished' => $this->isPublished,
            'customCoordinates' => $this->customCoordinates,
            'customMetadata' => $this->customMetadata,
            'isPrivateFile' => $this->isPrivateFile,
            'url' => $this->url,
            'thumbnail' => $this->thumbnail,
            'fileType' => $this->fileType,
            'filePath' => $this->filePath,
            'height' => $this->height,
            'width' => $this->width,
            'size' => $this->size,
            'hasAlpha' => $this->hasAlpha,
            'mime' => $this->mime,
        ];
    }
}