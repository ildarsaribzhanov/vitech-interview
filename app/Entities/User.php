<?php

namespace App\Entities;


/**
 * Class User
 *
 * @package App\Entities
 */
class User
{
    /** @var int */
    private int $id;

    /** @var string */
    private string $login;

    public function __construct(int $id, string $login)
    {
        $this->id    = $id;
        $this->login = $login;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }
}