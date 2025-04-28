<?php

declare(strict_types=1);

namespace App\Application\Actions\SiteConfig;

use Psr\Http\Message\ResponseInterface as Response;

class CreateSiteConfigAction extends SiteConfigAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();
        
        $siteConfig = $this->siteConfigRepository->create($data);

        $this->logger->info("Site config created");

        return $this->respondWithData($siteConfig);
    }
}
