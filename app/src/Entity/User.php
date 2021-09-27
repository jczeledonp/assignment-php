<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    private ?int $id;
    private ?string $name;
    private ?bool $read_write;
    private ?array $roles = [];
    private ?string $token;
    private ?\DateTimeInterface $created;

    /**
     * Create a new User
     *
     * @param integer $id
     * @param string $name
     * @param boolean $read_write
     * @param array $roles
     * @param string $token
     * @param \DateTimeInterface $created
     */
    public function __construct(
        int $id,
        string $name,
        bool $read_write,
        array $roles,
        string $token,
        \DateTimeInterface $created
    ) {
        $this->$id = $id;
        $this->name = $name;
        $this->read_write = $read_write;
        $this->roles = $roles;
        $this->token = $token;
        $this->created = $created;
    }

    /**
     * Get user Id
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get User name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Get user permision to read/write
     * 1 = read and write
     * 0 = read only
     *
     * @return boolean|null
     */
    public function getReadWrite(): ?bool
    {
        return $this->read_write;
    }

    /**
     * Get User authenticathion token
     *
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * Get user created date
     *
     * @return \DateTimeInterface|null
     */
    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->name;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        return array_unique($roles);
    }

    /**
     * This method can be d in Symfony 6.0 - is not needed for apps that do not check user passwords.
     *
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return null;
    }

    /**
     * This method can be d in Symfony 6.0 - is not needed for apps that do not check user passwords.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
