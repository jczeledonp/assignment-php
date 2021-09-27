<?php

namespace App\Service\Key;

use App\Entity\Key;
use App\Form\Model\KeyDto;
use App\Form\Type\KeyFormType;
use App\Repository\KeyRepository;
use App\Service\User\UserLogged;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class KeyProcessor
{
    private GetKey $getKey;
    private FormFactoryInterface $formFactory;
    private KeyRepository $keyRepository;

    public function __construct(
        FormFactoryInterface $formFactory,
        GetKey $getKey,
        KeyRepository $keyRepository
    ) {
        $this->formFactory = $formFactory;
        $this->getKey = $getKey;
        $this->keyRepository = $keyRepository;
    }

    /**
     * Process create/update Key petitions
     *
     * @param Request $request
     * @param UserLogged $user
     * @param Key|null $key
     * @return array
     */
    public function __invoke(
        Request $request,
        UserLogged $user,
        ?Key $key = null
    ): array {
        // detect mode: null Key means we'll create a new one, if not we'll edit given Key
        if ($key===null) {
            $keyDto = KeyDto::createEmptyKey();
        } else {
            $keyDto = KeyDto::createFromKey($key);
        }

        $formContent = json_decode($request->getContent(), true);
        $form = $this->formFactory->create(KeyFormType::class, $keyDto);
        $form->submit($formContent);

        if (!$form->isSubmitted()) {
            return [null, 'You must sent data values to create a new Key'];
        }

        if (!$form->isValid()) {
            return [null, 'Some data is missing or there are wrong values to create a new Key'];
        }

        // prepare data with new desired name for Key for insert/update
        $newKeyName = $keyDto->getName();
        if ($key===null) {
            // create a new Key
            // check for previous values from same Key name
            $previousKey = $this->keyRepository->isUnique($newKeyName);
            if (!$previousKey) {
                // found previous key, we can not create the new Key
                return [null, 'There is a previous Key with same name'];
            }
            // no previous keys, we can create the new Key
            $key = new Key(
                $newKeyName,
                new \DateTime(),
                $user->getId()
            );
        } else {
            // update Key name
            // check for previous values from same Key name
            $previousKey = $this->keyRepository->isUnique($newKeyName, $key->getId());
            if (!$previousKey) {
                // found previous key, we can not create the new Key
                return [null, 'There is a previous Key with same name'];
            }
            $key->setName($newKeyName);
        }
        $this->keyRepository->save($key);
        return [$key, null];
    }
}
