<?php

namespace App\Controller\Api;

use App\Repository\TranslationRepository;
use App\Service\Exception\TMSException;
use App\Service\Translation\GetTranslation;
use App\Service\Translation\TranslationProcessor;
use App\Service\Translation\ValidateTranslation;
use App\Service\User\UserLogged;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TranslationController extends AbstractFOSRestController
{
    /**
     * @Rest\Post(path="/translations/create/{keyId}/{iso}", requirements={"keyId"="\d+"})
     * @Rest\View(serializerGroups={"tms"}, serializerEnableMaxDepthChecks=true)
     *
     * Create a UNIQUE new translation for given Key/Language and assign a new Id
     *
     * @param integer $keyId
     * @param string $iso
     * @param TranslationProcessor $translationProcessor
     * @param ValidateTranslation $validateTranslation
     * @param Request $request
     * @return TMSException
     */
    public function createTranslation(
        int $keyId,
        string $iso,
        TranslationProcessor $translationProcessor,
        ValidateTranslation $validateTranslation,
        Request $request
    ): TMSException
    {
        $user = new UserLogged($this->getUser());
        if (!$user->canWrite()) {
            return new TMSException("Sorry, you only can access TMS in read only mode", Response::HTTP_BAD_REQUEST);
        }
        [$key, $language, $translation] = ($validateTranslation)($keyId, $iso);
        // check for valid Key with given Id
        if (!$key) {
            return new TMSException("There is no Key with ID#$keyId on TMS. Can't create translation", Response::HTTP_BAD_REQUEST);
        }
        // check for valid Language with given ISO code
        if (!$language) {
            return new TMSException("There is no Language with ISO code '$iso' on TMS. Can't create translation", Response::HTTP_BAD_REQUEST);
        }
        // Check for existing Translation for given Key/Language
        if ($translation) {
            return new TMSException("There is already a Translation with same ISO code '$iso' for Key#$keyId on TMS. Can't create a new translation", Response::HTTP_BAD_REQUEST);
        }
        // proceed to create Translation - all sent data is OK
        [$translation, $error] = ($translationProcessor)($request, $user, $key, $language, $translation);
        if (!$translation) {
            return new TMSException($error, Response::HTTP_BAD_REQUEST);
        }
        return new TMSException(
            [
                'success' => 'CREATED new Translation',
                'key_id' => $keyId,
                'traslation_id' => $translation->getId(),
                'language'  => $iso,
                'name' => $translation->getTranslation()
            ],
            Response::HTTP_OK);
    }

    /**
     * @Rest\Delete(path="/translations/{translationId}", requirements={"translationId"="\d+"})
     * @Rest\View(serializerGroups={"tms"}, serializerEnableMaxDepthChecks=true)
     *
     * Delete a Translation from given Id
     *
     * @param integer $translationId
     * @param GetTranslation $getTranslation
     * @param TranslationRepository $translationRepository
     * @return TMSException
     */
    public function deleteTranslation(
        int $translationId,
        GetTranslation $getTranslation,
        TranslationRepository $translationRepository
    ): TMSException
    {
        $user = new UserLogged( $this->getUser() );
        if (!$user->canWrite()) {
            return new TMSException("Sorry, you only can access TMS in read only mode", Response::HTTP_BAD_REQUEST);
        }
        $translation = ($getTranslation)($translationId);
        if(!$translation) {
            return new TMSException("There is no Translation with ID#$translationId on TMS", Response::HTTP_BAD_REQUEST);
        }
        $translationRepository->delete($translation);
        //return new TMSException("DELETED", Response::HTTP_OK);
        return new TMSException(
            [
                'success' => 'Translation was DELETED',
                'id' => $translation->getId(),
                'name' => $translation->getTranslation()
            ],
            Response::HTTP_OK);
    }

    /**
     * @Rest\Get(path="/translations/{translationId}", requirements={"translationId"="\d+"})
     * @Rest\View(serializerGroups={"tms"}, serializerEnableMaxDepthChecks=true)
     *
     * Retrieve Translation from given Id with Id, name, language, creator, creation date, updater and updated date
     *
     * @param integer $translationId
     * @param TranslationRepository $translationRepository
     * @return void
     */
    public function getTranslation(
        int $translationId,
        TranslationRepository $translationRepository
    ) {
        $translation = $translationRepository->find($translationId);
        if (!$translation) {
            return new TMSException("There is no Translation with ID#$translationId on TMS", Response::HTTP_BAD_REQUEST);
        }
        return [
            'status' => 'OK',
            'translation' => $translation,
            ];
    }

    /**
     * @Rest\Get(path="/translations")
     * @Rest\View(serializerGroups={"tms"}, serializerEnableMaxDepthChecks=true)
     *
     * List all Translation Id, name, language, creator, creation date, updater and updated date
     *
     *
     * @param TranslationRepository $translationRepository
     * @return void
     */
    public function listTranslations(TranslationRepository $translationRepository)
    {
        $translations = $translationRepository->findAll();
        return [
            'status' => 'OK',
            'translations' => $translations,
            ];
    }

    /**
     * @Rest\Put(path="/translations/{keyId}/{iso}", requirements={"keyId"="\d+"})
     * @Rest\View(serializerGroups={"tms"}, serializerEnableMaxDepthChecks=true)
     *
     * update the translation text for given language from Key Id and receives the updated Id
     *
     * @param integer $keyId
     * @param string $iso
     * @param TranslationProcessor $translationProcessor
     * @param ValidateTranslation $validateTranslation
     * @param Request $request
     * @return void
     */
    public function updateTranslation(
        int $keyId,
        string $iso,
        TranslationProcessor $translationProcessor,
        ValidateTranslation $validateTranslation,
        Request $request
    ) {
        $user = new UserLogged($this->getUser());
        if (!$user->canWrite()) {
            return new TMSException("Sorry, you only can access TMS in read only mode", Response::HTTP_BAD_REQUEST);
        }
        [$key, $language, $translation] = ($validateTranslation)($keyId, $iso);
        // check for valid Key with given Id
        if (!$key) {
            return new TMSException("There is no Key with ID#$keyId on TMS. Can't update translation", Response::HTTP_BAD_REQUEST);
        }
        // check for valid Language with given ISO code
        if (!$language) {
            return new TMSException("There is no Language with ISO code '$iso' on TMS. Can't update translation", Response::HTTP_BAD_REQUEST);
        }
        // Check for existing Translation for given Key/Language
        if (!$translation) {
            return new TMSException("There is no Translation with ISO code '$iso' for Key#$keyId on TMS. Can't update translation", Response::HTTP_BAD_REQUEST);
        }
        // proceed to update Translation - all sent data is OK
        [$translation, $error] = ($translationProcessor)($request, $user, $key, $language, $translation);
        if ($translation) {
            return new TMSException($translation->getId(), Response::HTTP_OK);
        }
        return new TMSException($error, Response::HTTP_BAD_REQUEST);
    }

}
