<?php

namespace App\Entity;

class Translation
{
    private ?int $id;
    private ?int $key_id;
    private ?int $language_id;
    private ?string $translation;
    private ?\DateTimeInterface $created;
    private ?int $created_by;
    private ?\DateTimeInterface $updated;
    private ?int $updated_by;

    /**
     * Create a new Translation object
     *
     * @param integer|null $key_id
     * @param integer|null $language_id
     * @param string|null $translation
     * @param \DateTimeInterface|null $created
     * @param integer|null $created_by
     */
    public function __construct(
        ?int $key_id,
        ?int $language_id,
        ?string $translation,
        ?\DateTimeInterface $created,
        ?int $created_by
    ) {
        $this->id = null;
        $this->key_id = $key_id;
        $this->language_id = $language_id;
        $this->translation = $translation;
        $this->created = $created;
        $this->created_by = $created_by;
        $this->updated = null;
        $this->updated_by = null;
    }

    /**
     * Update a previously created Translation
     *
     * @param string|null $translation
     * @param \DateTimeInterface|null $updated
     * @param integer|null $updated_by
     * @return void
     */
    public function update(
        ?string $translation,
        ?\DateTimeInterface $updated,
        ?int $updated_by
    ) {
        $this->translation = $translation;
        $this->updated = $updated;
        $this->updated_by = $updated_by;
    }

    /**
     * Get Translation id
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get Translation Key id
     *
     * @return integer|null
     */
    public function getKeyId(): ?int
    {
        return $this->key_id;
    }

    /**
     * Get Translation Language id
     *
     * @return integer|null
     */
    public function getLanguageId(): ?int
    {
        return $this->language_id;
    }

    /**
     * Set Translation Language id
     *
     * @param [type] $language_id
     * @return self
     */
    public function setLanguageId($language_id): self
    {
        $this->language_id = $language_id;
        return $this;
    }

    /**
     * Get Translation text
     *
     * @return string|null
     */
    public function getTranslation(): ?string
    {
        return $this->translation;
    }

    /**
     * Set Translation text
     *
     * @param string $translation
     * @return self
     */
    public function setTranslation(string $translation): self
    {
        $this->translation = $translation;
        return $this;
    }

    /**
     * Get Translation created date
     *
     * @return \DateTimeInterface|null
     */
    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    /**
     * Set Translation created date
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
     * Get Translation created by User Id
     *
     * @return integer|null
     */
    public function getCreatedBy(): ?int
    {
        return $this->created_by;
    }

    /**
     * Set Translation created by User Id
     *
     * @param integer $created_by
     * @return self
     */
    public function setCreatedBy(int $created_by): self
    {
        $this->created_by = $created_by;
        return $this;
    }

    /**
     * Get Translation updated date
     *
     * @return \DateTimeInterface|null
     */
    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    /**
     * Set Translation updated date
     *
     * @param \DateTimeInterface|null $updated
     * @return self
     */
    public function setUpdated(?\DateTimeInterface $updated): self
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * Get Translation updated by User Id
     *
     * @return integer|null
     */
    public function getUpdatedBy(): ?int
    {
        return $this->updated_by;
    }

    /**
     * Set Translation updated by User Id
     *
     * @param integer|null $updated_by
     * @return self
     */
    public function setUpdatedBy(?int $updated_by): self
    {
        $this->updated_by = $updated_by;
        return $this;
    }
}
