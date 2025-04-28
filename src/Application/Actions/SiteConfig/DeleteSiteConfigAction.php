<?php

declare(strict_types=1);

namespace App\Application\Actions\SiteConfig;

use Psr\Http\Message\ResponseInterface as Response;

class DeleteSiteConfigAction extends SiteConfigAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $siteConfigId = (int) $this->resolveArg('id');
        $seoAll = $this->siteConfigRepository->deleteSiteConfigOfId($siteConfigId);

        $this->logger->info("SEO all list was viewed.");

        return $this->respondWithData($seoAll);
    }
}
