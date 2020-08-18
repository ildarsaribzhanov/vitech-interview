<?php

namespace App\Repositories;


use App\Entities\Product;
use App\Entities\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use DomainException;

/**
 * Class UserRepository
 *
 * @package App\Repositories
 */
class UserRepository
{
    /** @var ObjectRepository */
    private ObjectRepository $emRepository;

    /**
     * ProductRepository constructor.
     *
     * @param \Doctrine\ORM\EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->emRepository = $em->getRepository(User::class);
    }

    /**
     * @param int $id
     *
     * @return User|object
     */
    public function find(int $id)
    {
        $user = $this->emRepository->find($id);

        if ($user === null) {
            throw new DomainException('Not found user by id ' . $id);
        }

        return $user;
    }
}