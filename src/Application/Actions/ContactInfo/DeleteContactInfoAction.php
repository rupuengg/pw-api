<?php

declare(strict_types=1);

namespace App\Application\Actions\ContactInfo;

use Psr\Http\Message\ResponseInterface as Response;

class DeleteContactInfoAction extends ContactInfoAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $contactId = (int) $this->resolveArg('id');
        $contact = $this->contactInfoRepository->deleteById($contactId);

        $this->logger->info("SEO all list was viewed.");

        return $this->respondWithData($contact);
    }
}
