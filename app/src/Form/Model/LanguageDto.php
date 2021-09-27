<?php

namespace App\Form\Model;

use App\Entity\Language;

/**
 * Language DTO for helping on DDBB related functions
 */
class LanguageDto
{
    public ?int $id = null;
    public ?string $name = null;
    public ?string $iso = null;
    public ?bool $rtl = null;

    public static function createFromLanguage(Language $language): self
    {
        $dto = new self();
        $dto->id = $language->getId();
        $dto->name = $language->getName();
        $dto->iso = $language->getIso();
        $dto->rtl = $language->getRtl();
        return $dto;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getIso(): ?string
    {
        return $this->iso;
    }

    public function getRtl(): ?bool
    {
        return $this->rtl;
    }
}
