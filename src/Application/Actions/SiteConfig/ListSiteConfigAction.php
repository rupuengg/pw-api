<?php

declare(strict_types=1);

namespace App\Application\Actions\SiteConfig;

use Psr\Http\Message\ResponseInterface as Response;

class ListSiteConfigAction extends SiteConfigAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $seoAll = $this->siteConfigRepository->findAll();

        $this->logger->info("SEO all list was viewed.");

        return $this->respondWithData($seoAll);
    }
}
