<?php

namespace App\Service\Key;

use App\Entity\Key;
use App\Repository\KeyRepository;

class GetKey
{
    private KeyRepository $keyRepository;

    public function __construct(KeyRepository $keyRepository)
    {
        $this->keyRepository = $keyRepository;
    }

    /**
     * Get Key from DDBB
     *
     * @param integer $id
     * @return Key|null
     */
    public function __invoke(int $id): ?Key
    {
        return $this->keyRepository->find($id);
    }
}
