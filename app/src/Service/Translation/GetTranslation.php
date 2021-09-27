<?php

namespace App\Service\Translation;

use App\Entity\Translation;
use App\Repository\TranslationRepository;

class GetTranslation
{
    private TranslationRepository $translationRepository;

    public function __construct(TranslationRepository $translationRepository)
    {
        $this->translationRepository = $translationRepository;
    }

    /**
     * Get Translaltion from DDBB
     *
     * @param integer $id
     * @return Translation|null
     */
    public function __invoke(int $id): ?Translation
    {
        return $this->translationRepository->find($id);
    }
}
