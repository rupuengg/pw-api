<?php

declare(strict_types=1);

namespace App\Domain\SiteConfig;

use JsonSerializable;

class SiteConfig implements JsonSerializable
{
    // SEO
    private ?int $id;
    private $route;
    private $imageKitFolder;
    private $title;
    private $description;
    private $keywords;

    // OG Configuration
    private $ogSiteName;
    private $ogUrl;
    private $ogTitle;
    private $ogDescription;
    private $ogType;
    private $ogSeeAlso;
    private $ogLocale;
    private $ogLocaleAlternate1;
    private $ogLocaleAlternate2;
    private $ogUpdatedTime;

    // OG Image
    private $ogImageType;
    private $ogImageWidth;
    private $ogImageHeight;
    private $ogImageUrl;
    private $ogImageSecureUrl;
    private $ogImageAlt;

    // OG Video
    private $ogVideoType;
    private $ogVideoWidth;
    private $ogVideoHeight;
    private $ogVideoSecureUrl;

    public function __construct($id, $route, $imageKitFolder, $title, $description, $keywords)
    {
        $this->id = $id;
        $this->route = $route;
        $this->imageKitFolder = $imageKitFolder;
        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords;
    }

    public function setOgData($ogSiteName, $ogUrl, $ogTitle, $ogDescription, $ogType, $ogSeeAlso, $ogLocale, $ogLocaleAlternate1, $ogLocaleAlternate2, $ogUpdatedTime)
    {
        $this->ogSiteName = $ogSiteName;
        $this->ogUrl = $ogUrl;
        $this->ogTitle = $ogTitle;
        $this->ogDescription = $ogDescription;
        $this->ogType = $ogType;
        $this->ogSeeAlso = $ogSeeAlso;
        $this->ogLocale = $ogLocale;
        $this->ogLocaleAlternate1 = $ogLocaleAlternate1;
        $this->ogLocaleAlternate2 = $ogLocaleAlternate2;
        $this->ogUpdatedTime = $ogUpdatedTime;
    }

    public function setOgImageData($ogImageType, $ogImageWidth, $ogImageHeight, $ogImageUrl, $ogImageSecureUrl, $ogImageAlt)
    {
        $this->ogImageType = $ogImageType;
        $this->ogImageWidth = $ogImageWidth;
        $this->ogImageHeight = $ogImageHeight;
        $this->ogImageUrl = $ogImageUrl;
        $this->ogImageSecureUrl = $ogImageSecureUrl;
        $this->ogImageAlt = $ogImageAlt;
    }

    public function setOgVideoData($ogVideoType, $ogVideoWidth, $ogVideoHeight, $ogVideoSecureUrl)
    {
        $this->ogVideoType = $ogVideoType;
        $this->ogVideoWidth = $ogVideoWidth;
        $this->ogVideoHeight = $ogVideoHeight;
        $this->ogVideoSecureUrl = $ogVideoSecureUrl;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function getImageKitFolder()
    {
        return $this->imageKitFolder;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getKeywords()
    {
        return $this->keywords;
    }

    public function getOgSiteName()
    {
        return $this->ogSiteName;
    }

    public function getOgUrl()
    {
        return $this->ogUrl;
    }

    public function getOgTitle()
    {
        return $this->ogTitle;
    }

    public function getOgDescription()
    {
        return $this->ogDescription;
    }

    public function getOgSeeAlso()
    {
        return $this->ogSeeAlso;
    }

    public function getOgLocale()
    {
        return $this->ogLocale;
    }

    public function getOgLocaleAlternate1()
    {
        return $this->ogLocaleAlternate1;
    }

    public function getOgLocaleAlternate2()
    {
        return $this->ogLocaleAlternate2;
    }

    public function getOgType()
    {
        return $this->ogType;
    }

    public function getOgUpdatedTime()
    {
        return $this->ogUpdatedTime;
    }

    public function getOgImageType()
    {
        return $this->ogImageType;
    }

    public function getOgImageWidth()
    {
        return $this->ogImageWidth;
    }

    public function getOgImageHeight()
    {
        return $this->ogImageHeight;
    }

    public function getOgImageUrl()
    {
        return $this->ogImageUrl;
    }

    public function getOgImageSecureUrl()
    {
        return $this->ogImageSecureUrl;
    }

    public function getOgImageAlt()
    {
        return $this->ogImageAlt;
    }

    public function getOgVideoType()
    {
        return $this->ogVideoType;
    }

    public function getOgVideoWidth()
    {
        return $this->ogVideoWidth;
    }

    public function getOgVideoHeight()
    {
        return $this->ogVideoHeight;
    }

    public function getOgVideoSecureUrl()
    {
        return $this->ogVideoSecureUrl;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
        'id' => $this->id,
        'route' => $this->route,
        'imageKitFolder' => $this->imageKitFolder,
        'title' => $this->title,
        'description' => $this->description,
        'keywords' => $this->keywords,
        'ogSiteName' => $this->ogSiteName,
        'ogUrl' => $this->ogUrl,
        'ogTitle' => $this->ogTitle,
        'ogDescription' => $this->ogDescription,
        'ogType' => $this->ogType,
        'ogSeeAlso' => $this->ogSeeAlso,
        'ogLocale' => $this->ogLocale,
        'ogLocaleAlternate1' => $this->ogLocaleAlternate1,
        'ogLocaleAlternate2' => $this->ogLocaleAlternate2,
        'ogUpdatedTime' => $this->ogUpdatedTime,
        'ogImageType' => $this->ogImageType,
        'ogImageWidth' => $this->ogImageWidth,
        'ogImageHeight' => $this->ogImageHeight,
        'ogImageUrl' => $this->ogImageUrl,
        'ogImageSecureUrl' => $this->ogImageSecureUrl,
        'ogImageAlt' => $this->ogImageAlt,
        'ogVideoType' => $this->ogVideoType,
        'ogVideoWidth' => $this->ogVideoWidth,
        'ogVideoHeight' => $this->ogVideoHeight,
        'ogVideoSecureUrl' => $this->ogVideoSecureUrl,
        ];
    }
}
