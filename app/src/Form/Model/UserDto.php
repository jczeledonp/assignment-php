<?php

namespace App\Form\Model;

use App\Entity\User;
use DateTimeInterface;

class UserDto
{
    public ?int $id = null;
    public ?string $name = null;
    public ?int $read_write = null;
    public ?array $roles = null;
    public ?string $token = null;
    public ?DateTimeInterface $created = null;

    public static function createFromUser(User $user): self
    {
        $dto = new self();
        $dto->id = $user->getId();
        $dto->name = $user->getname();
        $dto->read_write = $user->getReadWrite();
        $dto->roles = $user->getRoles();
        $dto->token = $user->getToken();
        $dto->created = $user->getCreated();
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

    public function getReadWrite(): int
    {
        return $this->read_write;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function getCreated(): ?DateTimeInterface
    {
        return $this->created;
    }
}
