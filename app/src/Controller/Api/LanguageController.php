<?php

namespace App\Controller\Api;

use App\Repository\LanguageRepository;
use App\Service\Exception\TMSException;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class LanguageController extends AbstractFOSRestController
{
    /**
     * @Rest\Get(path="/languages")
     * @Rest\View(serializerGroups={"tms"}, serializerEnableMaxDepthChecks=true)
     */
    public function getAction(LanguageRepository $languageRepository)
    {
        return $languageRepository->findAll();
    }
}
