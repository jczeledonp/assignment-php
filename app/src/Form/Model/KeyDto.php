<?php

namespace App\Form\Model;

use App\Entity\Key;
use DateTimeInterface;

/**
 * Key DTO for helping on DDBB related functions
 */

class KeyDto
{
    public ?int $id = null;
    public ?string $name = null;
    public ?DateTimeInterface $created = null;
    public ?int $created_by = null;

    public static function createEmptyKey(): self
    {
        return new self();
    }

    public static function createFromKey(Key $key): self
    {
        $dto = new self();
        $dto->id = $key->getId();
        $dto->name = $key->getName();
        $dto->created = $key->getCreated();
        $dto->created_by = $key->getCreatedBy();
        return $dto;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getCreated(): ?DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;
        return $this;
    }

    public function getCreatedBy(): ?int
    {
        return $this->created_by;
    }

    public function setCreatedBy(int $created_by): self
    {
        $this->created_by = $created_by;
        return $this;
    }
}
