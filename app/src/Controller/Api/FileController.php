<?php

namespace App\Controller\Api;

use App\Repository\LanguageRepository;
use App\Repository\TranslationRepository;
use App\Service\Exception\TMSException;
use App\Service\File\JsonYamlFiles;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

class FileController extends AbstractFOSRestController
{
    /**
     * @Rest\Post(path="/files")
     * @Rest\View(serializerGroups={"files"}, serializerEnableMaxDepthChecks=true)
     *
     * create Zip file with all available Translations for all Keys in JSON and YAML versions
     *
     * @param JsonYamlFiles $jsonYamlFiles
     * @param LanguageRepository $languageRepository
     * @param TranslationRepository $translationRepository
     * @return TMSException
     */
    public function getJson(
        JsonYamlFiles $jsonYamlFiles,
        LanguageRepository $languageRepository,
        TranslationRepository $translationRepository
    ): TMSException
    {
        [$message, $error] = ($jsonYamlFiles)($translationRepository, $languageRepository);
        if ($message) {
            return new TMSException($message, Response::HTTP_OK);
        }
        return new TMSException($error,TMSException::HTTP_BAD_REQUEST);
    }
}