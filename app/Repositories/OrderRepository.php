<?php

namespace App\Repositories;


use App\Entities\Order;
use App\Entities\Product;
use Doctrine\ORM\EntityManagerInterface;
use DomainException;

/**
 * Class OrderRepository
 *
 * @package App\Repositories
 */
class OrderRepository
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * ProductRepository constructor.
     *
     * @param \Doctrine\ORM\EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;

        $this->emRepository = $em->getRepository(Order::class);
    }

    /**
     * @param Order $order
     *
     * @return \App\Entities\Order
     */
    public function save(Order $order): Order
    {
        $this->em->persist($order);
        $this->em->flush();

        return $order;
    }

    /**
     * @param int $id
     *
     * @return Order|null
     */
    public function find(int $id): ?Order
    {
        $order = $this->emRepository->find($id);

        if ($order === null) {
            throw new DomainException('Not found product by id ' . $id);
        }

        return $order;
    }
}