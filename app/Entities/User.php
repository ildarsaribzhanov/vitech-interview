<?php

namespace App\Entities;

use App\Repositories\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 *
 * @package App\Entities
 *
 * @ORM\Entity(repositoryClass="UserRepository")
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
     * @var Order[]
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