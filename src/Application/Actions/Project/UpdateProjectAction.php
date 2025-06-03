<?php

declare(strict_types=1);

namespace App\Application\Actions\Project;

use Psr\Http\Message\ResponseInterface as Response;

class UpdateProjectAction extends ProjectAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $requestData = $this->request->getParsedBody();

        $address = array(
            'addressOne' => $requestData['address']['addressOne'], 
            'addressTwo' => $requestData['address']['addressTwo'], 
            'city' => $requestData['address']['city'], 
            'state' => $requestData['address']['state'], 
            'zipCode' => $requestData['address']['zipCode'], 
            'country' => $requestData['address']['country']
        );

        $addressId = NULL;
        if(!empty($requestData['addressId']))
        {
            $address['id'] = $requestData['addressId'];
            $address = $this->addressRepository->update($address);
            $addressId = $address->getId();
        }
        else 
        {
            $address['id'] = $requestData['addressId'];
            $address = $this->addressRepository->create($address);
            $addressId = $address->getId();
        }

        $project = array(
            'id' => $requestData['id'], 
            'title' => $requestData['title'], 
            'addressId' => $addressId, 
            'startDate' => $requestData['startDate'], 
            'endDate' => $requestData['endDate'], 
            'imageKitGalleryName' => $requestData['imageKitGalleryName']
        );
        $data = $this->projectRepository->update($project);
        $this->logger->info("Project updated");

        return $this->respondWithData($data);
    }
}
