<?php

namespace App\Entity;

class Language
{
    private ?int $id;
    private ?string $name;
    private ?string $iso;
    private ?bool $rtl;

    /**
     * Get Language Id
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get Language name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set Language name
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
     * Get Language ISO name
     *
     * @return string|null
     */
    public function getIso(): ?string
    {
        return $this->iso;
    }

    /**
     * Set Language ISO name
     *
     * @param string $iso
     * @return self
     */
    public function setIso(string $iso): self
    {
        $this->iso = $iso;
        return $this;
    }

    /**
     * Set RTL value to Key (right to left)
     *
     * @return boolean|null
     */
    public function getRtl(): ?bool
    {
        return $this->rtl;
    }

    /**
     * Set RTL value to Key (right to left)
     *
     * @param boolean $rtl
     * @return self
     */
    public function setRtl(bool $rtl): self
    {
        $this->rtl = $rtl;
        return $this;
    }
}
