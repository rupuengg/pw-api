<?php

namespace App\Infrastructure\Persistence\SiteConfig;

use DomainException;
use Selective\Database\Connection;
use App\Domain\SiteConfig\SiteConfig;
use App\Domain\SiteConfig\SiteConfigRepository;

final class SiteConfigReaderRepository implements SiteConfigRepository
{
    private Connection $connection;
    private $tableName = "seo_setting";
    private $columns = [
        'id',
        'route',
        'imageKitFolder',
        'title',
        'description',
        'keywords',
        'ogSiteName',
        'ogUrl',
        'ogTitle',
        'ogDescription',
        'ogType',
        'ogSeeAlso',
        'ogLocale',
        'ogLocaleAlternate1',
        'ogLocaleAlternate2',
        'ogUpdatedTime',
        'ogImageType',
        'ogImageWidth',
        'ogImageHeight',
        'ogImageUrl',
        'ogImageSecureUrl',
        'ogImageAlt',
        'ogVideoType',
        'ogVideoWidth',
        'ogVideoHeight',
        'ogVideoSecureUrl'
    ];

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $query = $this->connection->select()->from($this->tableName);
        $query->columns($this->columns);

        $rows = $query->execute()->fetchAll() ?: [];

        if (!is_array($rows)) {
            throw new DomainException(sprintf('Site Configs not found'));
        }

        $siteConfigs = [];

        for ($iCounter = 0; $iCounter < count($rows); $iCounter++) {
            array_push($siteConfigs, $this->makeSiteConfigData($rows[$iCounter]));
        }

        return $siteConfigs;
    }

    public function findSiteConfigOfId(int $id): SiteConfig
    {
        $query = $this->connection->select()->from($this->tableName);
        $query->columns($this->columns);
        $query->where('id', '=', $id);

        $row = $query->execute()->fetch() ?: [];

        if (!$row) {
            throw new DomainException(sprintf('Site Config not found: %s', $id));
        }

        return $this->makeSiteConfigData($row);
    }

    public function create($d): SiteConfig
    {
        $d['id'] = null;
        $query = $this->connection->insert()->into($this->tableName)->set($d);
        $row = $query->execute();

        if (!$row) {
            throw new DomainException(sprintf('Site Config not found'));
        }

        return $this->findSiteConfigOfId($query->lastInsertId());
    }

    public function update($d): SiteConfig
    {
        $id = $d['id'];
        $query = $this->connection->update()->table($this->tableName)->set($d)->where("id", "=", $d['id']);
        $row = $query->execute();

        if (!$row) {
            throw new DomainException(sprintf('Site Config not found: %s', $id));
        }

        return $this->findSiteConfigOfId($id);
    }

    public function deleteSiteConfigOfId(int $id)
    {
        $query = $this->connection->delete()->from($this->tableName)->where("id", "=", $id);
        $row = $query->execute();

        if (!$row) {
            throw new DomainException(sprintf('Site Config not found: %s', $id));
        }

        return 'OK';
    }

    private function makeSiteConfigData($row): SiteConfig
    {
        $siteConfig = new SiteConfig($row['id'], $row['route'], $row['imageKitFolder'], $row['title'], $row['description'], $row['keywords']);
        $siteConfig->setOgData($row['ogSiteName'], $row['ogUrl'], $row['ogTitle'], $row['ogDescription'], $row['ogType'], $row['ogSeeAlso'], $row['ogLocale'], $row['ogLocaleAlternate1'], $row['ogLocaleAlternate2'], $row['ogUpdatedTime']);
        $siteConfig->setOgImageData($row['ogImageType'], $row['ogImageWidth'], $row['ogImageHeight'], $row['ogImageUrl'], $row['ogImageSecureUrl'], $row['ogImageAlt']);
        $siteConfig->setOgVideoData($row['ogVideoType'], $row['ogVideoWidth'], $row['ogVideoHeight'], $row['ogVideoSecureUrl']);

        return $siteConfig;
    }
}
