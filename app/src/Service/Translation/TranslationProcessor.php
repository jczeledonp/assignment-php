<?php

namespace App\Service\Translation;

use App\Entity\Key;
use App\Entity\Language;
use App\Entity\Translation;
use App\Form\Model\TranslationDto;
use App\Form\Type\TranslationFormType;
use App\Repository\LanguageRepository;
use App\Repository\TranslationRepository;
use App\Service\User\UserLogged;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class TranslationProcessor
{
    private FormFactoryInterface $formFactory;
    private GetTranslation $getTranslation;
    private LanguageRepository $languageRepository;
    private TranslationRepository $translationRepository;

    public function __construct(
        FormFactoryInterface $formFactory,
        GetTranslation $getTranslation,
        LanguageRepository $languageRepository,
        TranslationRepository $translationRepository
    ) {
        $this->formFactory = $formFactory;
        $this->getTranslation = $getTranslation;
        $this->languageRepository = $languageRepository;
        $this->translationRepository = $translationRepository;
    }

    /**
     * Process create/update Translation petitions
     *
     * @param Request $request
     * @param UserLogged $user
     * @param Key $key
     * @param Language $language
     * @param Translation|null $translation
     * @return array
     */
    public function __invoke(
        Request $request,
        UserLogged $user,
        Key $key,
        Language $language,
        ?Translation $translation = null
    ): array {
        // detect mode: null Translation means we'll create a new one, if not we'll edit given Translation
        if ($translation===null) {
            $translationDto = TranslationDto::createEmptyTranslation();
        } else {
            $translationDto = TranslationDto::createFromTranslation($translation);
        }

        $formContent = json_decode($request->getContent(), true);
        $form = $this->formFactory->create(TranslationFormType::class, $translationDto);
        $form->submit($formContent);

        if (!$form->isSubmitted()) {
            return [null, 'You must sent data values to create a new Translation'];
        }

        if (!$form->isValid()) {
            return [null, 'Your translation data is missing or there are wrong values to create a new Translation'];
        }
        // prepare data for insert/update
        if ($translation===null) {
            // all data is OK, let's create a new Translation
            $translation = new Translation(
                $key->getId(),
                $language->getId(),
                $translationDto->getTranslation(),
                new \DateTime(),
                $user->getId()
            );
        } else {
            // update Translation text
            $translation->update(
                $translationDto->getTranslation(),
                new \DateTime(),
                $user->getId()
            );
        }

        $this->translationRepository->save($translation);
        return [$translation, null];
    }
}
