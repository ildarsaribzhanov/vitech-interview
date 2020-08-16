<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 *
 * @package App\Entities
 *
 * @ORM\Entity()
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $login;

    /**
     * @ORM\OneToMany(targetEntity="Order", mappedBy="user")
     * @var OrderItm[] An ArrayCollection of Bug objects.
     */
    private $orders;

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