<?php

declare(strict_types=1);

namespace App\Application\Actions\ContactInfo;

use Psr\Http\Message\ResponseInterface as Response;

class CreateContactInfoAction extends ContactInfoAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();
        
        $contactInfo = $this->contactInfoRepository->create($data);

        $this->logger->info("Contact info created");

        return $this->respondWithData($contactInfo);
    }
}
