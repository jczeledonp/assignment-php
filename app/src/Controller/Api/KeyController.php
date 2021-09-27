<?php

namespace App\Controller\Api;

use App\Repository\KeyRepository;
use App\Repository\TranslationRepository;
use App\Service\Exception\TMSException;
use App\Service\Key\DeleteKey;
use App\Service\Key\GetKey;
use App\Service\Key\KeyProcessor;
use App\Service\User\UserLogged;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class KeyController extends AbstractFOSRestController
{
    /**
     * @Rest\Post(path="/keys/create")
     * @Rest\View(serializerGroups={"tms"}, serializerEnableMaxDepthChecks=true)
     *
     * Create a UNIQUE new Key and assign a new Id
     *
     * @param KeyProcessor $keyProcessor
     * @param Request $request
     * @return TMSException
     */
    public function createKey(
        KeyProcessor $keyProcessor,
        Request $request
    ): TMSException
    {
        $user = new UserLogged($this->getUser());
        if (!$user->canWrite()) {
            return new TMSException("Sorry, you only can access TMS in read only mode", Response::HTTP_BAD_REQUEST);
        }
        [$key, $error] = ($keyProcessor)($request, $user);
        if (!$key) {
            return new TMSException($error,TMSException::HTTP_BAD_REQUEST);
        }
        return new TMSException(
            [
                'success' => 'CREATED new Key',
                'id' => $key->getId(),
                'name' => $key->getName()
            ],
            Response::HTTP_OK);
    }

    /**
     * @Rest\Delete(path="/keys/{keyId}", requirements={"keyId"="\d+"})
     * @Rest\View(serializerGroups={"tms"}, serializerEnableMaxDepthChecks=true)
     *
     * Delete a Key from given Id
     *
     * @param integer $keyId
     * @param GetKey $getKey
     * @param DeleteKey $deleteKey
     * @return TMSException
     */
    public function deleteKey(
        int $keyId,
        GetKey $getKey,
        DeleteKey $deleteKey
    ): TMSException
    {
        $user = new UserLogged($this->getUser());
        if (!$user->canWrite()) {
            return new TMSException("Sorry, you only can access TMS in read only mode", Response::HTTP_BAD_REQUEST);
        }
        $key = ($getKey)($keyId);
        if (!$key) {
            return new TMSException("There is no Key with ID#$keyId on TMS", Response::HTTP_BAD_REQUEST);
        }
        ($deleteKey)($key);
        return new TMSException(
            [
                'success' => 'DELETED Key and all related Translations',
                'id' => $key->getId(),
                'name' => $key->getName()
            ],
            Response::HTTP_OK);
    }

    /**
     * @Rest\Get(path="/keys/{keyId}", requirements={"keyId"="\d+"})
     * @Rest\View(serializerGroups={"tms"}, serializerEnableMaxDepthChecks=true)
     *
     * Retrieve Key from given Id and shows Key information and available Translations
     *
     * @param integer $keyId
     * @param KeyRepository $keyRepository
     * @param TranslationRepository $translationRepository
     * @return array|object
     */
    public function getKey(
        int $keyId,
        KeyRepository $keyRepository,
        TranslationRepository $translationRepository
    ){
        $key = $keyRepository->find($keyId);
        if (!$key) {
            return new TMSException("There is no Key with ID#$keyId on TMS", Response::HTTP_BAD_REQUEST);
        }
        $translations = $translationRepository->getTranslationFromKey($keyId);

        return [
            'status' => 'OK',
            'key' => $key,
            'translations' => $translations,
            'total' => count($translations)
            ];
    }


    /**
     * @Rest\Get(path="/keys")
     * @Rest\View(serializerGroups={"tms"}, serializerEnableMaxDepthChecks=true)
     *
     * List all Keys and theirs Translations
     *
     * @param KeyRepository $keyRepository
     * @param TranslationRepository $translationRepository
     * @return array
     */
    public function listKeys(
        KeyRepository $keyRepository,
        TranslationRepository $translationRepository
    ): array
    {
        $keys = $keyRepository->findAll();
        $translations = [];
        foreach($keys as $key) {
            $translations[] = $this->getKey($key->getId(), $keyRepository, $translationRepository);
        }
        return [
                'status' => 'OK',
                "keys" => $translations,
                'total' => count($translations)
            ];
    }

    /**
     * @Rest\Put(path="/keys/{keyId}", requirements={"keyId"="\d+"})
     * @Rest\View(serializerGroups={"tms"}, serializerEnableMaxDepthChecks=true)
     */
    // Rename the Key name from given Id and receives the updated Id
    public function updateKey(
        int $keyId,
        GetKey $getKey,
        KeyProcessor $keyProcessor,
        Request $request
    ): TMSException
    {
        $user = new UserLogged($this->getUser());
        if (!$user->canWrite()) {
            return new TMSException("Sorry, you only can access TMS in read only mode", Response::HTTP_BAD_REQUEST);
        }
        // check for valid Key
        $key = ($getKey)($keyId);
        if (!$key) {
            return new TMSException("There is no Key with ID#$keyId on TMS", Response::HTTP_BAD_REQUEST);
        }
        [$key, $error] = ($keyProcessor)($request, $user, $key);
        if (!$key) {
            return new TMSException($error, Response::HTTP_BAD_REQUEST);
        }
        return new TMSException(
            [
                'success' => 'UPDATED Key',
                'id' => $key->getId(),
                'name' => $key->getName()
            ],
            Response::HTTP_OK);
    }
}
