<?php

namespace App\Service\Key;

use App\Repository\KeyRepository;
use App\Repository\TranslationRepository;
use App\Service\Exception\TMSException;
use Symfony\Component\HttpFoundation\Response;

class DeleteKey
{
    private KeyRepository $keyRepository;
    private TranslationRepository $translationRepository;

    public function __construct(
        KeyRepository $keyRepository,
        TranslationRepository $translationRepository
    ) {
        $this->keyRepository = $keyRepository;
        $this->translationRepository = $translationRepository;
    }

    /**
     * Delete Key Id on DDBB  and all related Translations
     *
     * @param [type] $id
     * @return void
     */
    public function __invoke($id)
    {
        $key = $this->keyRepository->find($id);
        if (!$key) {
            return new TMSException("There is no Key with ID# $id", Response::HTTP_BAD_REQUEST);
        }

        // delete ALL related Translations
        $translationsToDelete = $this->translationRepository->findBy(['key_id'=>$id]);
        foreach ($translationsToDelete as $translation) {
            $this->translationRepository->delete($translation);
        }
        $this->translationRepository->flush();

        // delete Key
        $this->keyRepository->delete($key);
        $this->keyRepository->flush();
    }
}
