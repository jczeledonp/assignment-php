<?php

namespace App\Entity;

class Key
{
    private ?int $id;
    private ?string $name;
    private ?\DateTimeInterface $created;
    private ?int $created_by;

    public function __construct(
        ?string $name,
        ?\DateTimeInterface $created,
        ?int $created_by
    ) {
        $this->id = null;
        $this->name = $name;
        $this->created = $created;
        $this->created_by = $created_by;
    }

    /**
     * Get Key Id
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get Key name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Update Key name
     *
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get Key created date
     *
     * @return \DateTimeInterface|null
     */
    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    /**
     * Set Key created date
     *
     * @param \DateTimeInterface $created
     * @return self
     */
    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;
        return $this;
    }

    /**
     * Get Key created by User Id
     *
     * @return integer|null
     */
    public function getCreatedBy(): ?int
    {
        return $this->created_by;
    }

    /**
     * Set created by User Id
     *
     * @param integer $created_by
     * @return self
     */
    public function setCreatedBy(int $created_by): self
    {
        $this->created_by = $created_by;
        return $this;
    }
}
