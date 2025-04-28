<?php

declare(strict_types=1);

namespace App\Application\Actions\ContactInfo;

use Psr\Http\Message\ResponseInterface as Response;

class ListContactInfoAction extends ContactInfoAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $contactInfos = $this->contactInfoRepository->findAll();

        $this->logger->info("Contact Infos all list was viewed.");

        return $this->respondWithData($contactInfos);
    }
}
