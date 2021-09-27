<?php

namespace App\Form\Model;

use App\Entity\Translation;
use DateTimeInterface;

/**
 *  * Translation DTO for helping on DDBB related functions
 class
 */
class TranslationDto
{
    public ?int $id = null;
    public ?int $key_id = null;
    public ?int $language_id = null;
    public ?string $translation = null;
    public ?DateTimeInterface $created = null;
    public ?int $created_by = null;
    public ?DateTimeInterface $updated = null;
    public ?int $updated_by = null;

    public static function createEmptyTranslation(): self
    {
        return new self();
    }

    public static function createFromTranslation(Translation $translation): self
    {
        $dto = new self();
        $dto->id = $translation->getId();
        $dto->key_id = $translation->getKeyId();
        $dto->language_id = $translation->getLanguageId();
        $dto->translation = $translation->getTranslation();
        $dto->created = $translation->getCreated();
        $dto->created_by = $translation->getCreatedBy();
        $dto->updated = $translation->getUpdated();
        $dto->updated_by = $translation->getUpdatedBy();
        return $dto;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKeyId(): ?int
    {
        return $this->key_id;
    }

    public function getLanguageId(): ?int
    {
        return $this->language_id;
    }

    public function getTranslation(): ?string
    {
        return $this->translation;
    }

    public function getCreated(): ?DateTimeInterface
    {
        return $this->created;
    }

    public function getCreatedBy(): ?int
    {
        return $this->created_by;
    }
    public function getUpdated(): ?DateTimeInterface
    {
        return $this->updated;
    }

    public function getUpdatedBy(): ?int
    {
        return $this->updated_by;
    }
}
