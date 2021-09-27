<?php

namespace App\Service\Translation;

use App\Repository\LanguageRepository;
use App\Repository\TranslationRepository;
use App\Service\Key\GetKey;
use App\Service\Key\KeyProcessor;

class ValidateTranslation
{
    private GetKey $getKey;
    private KeyProcessor $keyProcessor;
    private LanguageRepository $languageRepository;
    private TranslationRepository $translationRepository;

    public function __construct(
        GetKey $getKey,
        KeyProcessor $keyProcessor,
        LanguageRepository $languageRepository,
        TranslationRepository $translationRepository
    ) {
        $this->getKey = $getKey;
        $this->keyProcessor = $keyProcessor;
        $this->languageRepository = $languageRepository;
        $this->translationRepository = $translationRepository;
    }

    /**
     * Validates Translation uniqueness
     * Returns Translation if there is a Translation with valid Key Id and ISO Language code pair
     *
     * @param integer $keyId
     * @param string $iso
     * @return array
     */
    public function __invoke(
        int $keyId,
        string $iso
    ): array {
        // check for valid Key with given Id
        $key = ($this->getKey)($keyId);
        // check for valid Language with given ISO code
        $language = $this->languageRepository->findOneBy(['iso'=>$iso]);
        // look for existing Translation for given Key/Language
        $translation = ($key&&$language) ? $this->translationRepository->getTranslationFromKeyLanguage($keyId, $language->getId()) : null;
        return [$key, $language, $translation];
    }
}
