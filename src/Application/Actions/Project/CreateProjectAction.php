<?php

declare(strict_types=1);

namespace App\Application\Actions\Project;

use Psr\Http\Message\ResponseInterface as Response;

class CreateProjectAction extends ProjectAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();

        $addressId = NULL;
        if(!empty($data['address']))
        {
            $address = array(
                'addressOne' => $data['address']['addressOne'], 
                'addressTwo' => $data['address']['addressTwo'], 
                'city' => $data['address']['city'], 
                'state' => $data['address']['state'], 
                'zipCode' => $data['address']['zipCode'], 
                'country' => $data['address']['country']
            );
            $address = $this->addressRepository->create($address);
            $addressId = $address->getId();
        }
        $project = array(
            'title' => $data['title'], 
            'addressId' => $addressId, 
            'startDate' => $data['startDate'], 
            'endDate' => $data['endDate'], 
            'imageKitGalleryName' => $data['imageKitGalleryName']
        );
        $data = $this->projectRepository->create($project);
        $this->logger->info("Project created");

        return $this->respondWithData($data);
    }
}
