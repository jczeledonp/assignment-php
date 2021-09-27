<?php

namespace App\Service\User;

use App\Entity\User;
use App\Form\Model\UserDto;

/**
 * Detect is user Logged and Authenticated
 */
class UserLogged
{
    private $user;
    private $security;

    public function __construct(?User $user)
    {
        $this->user =  UserDto::createFromUser($user);
    }

    public function canWrite()
    {
        return $this->user->getReadWrite();
    }

    public function getId()
    {
        return $this->user->getId();
    }

    public function isLogged()
    {
        return !empty($this->user);
    }
}
