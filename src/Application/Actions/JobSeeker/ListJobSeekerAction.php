<?php

declare(strict_types=1);

namespace App\Application\Actions\JobSeeker;

use Psr\Http\Message\ResponseInterface as Response;

class ListJobSeekerAction extends JobSeekerAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $contactInfos = $this->jobSeekerRepository->findAll();

        $this->logger->info("Contact Infos all list was viewed.");

        return $this->respondWithData($contactInfos);
    }
}
