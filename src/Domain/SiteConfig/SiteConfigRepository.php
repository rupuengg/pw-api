<?php

declare(strict_types=1);

namespace App\Domain\SiteConfig;

interface SiteConfigRepository
{
    /**
     * @return SiteConfig[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return SiteConfig
     * @throws SiteConfigNotFoundException
     */
    public function findSiteConfigOfId(int $id): SiteConfig;

    /**
     * @return SiteConfig
     * @throws SiteConfigNotCreatedException
     */
    public function create($data): SiteConfig;

    /**
     * @return SiteConfig
     * @throws SiteConfigNotCreatedException
     */
    public function update($data): SiteConfig;

    /**
     * @param int $id
     * @throws SiteConfigNotFoundException
     */
    public function deleteSiteConfigOfId(int $id);
}
