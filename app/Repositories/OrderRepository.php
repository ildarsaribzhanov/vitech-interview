<?php

namespace App\Repositories;


use App\Entities\Order;
use Doctrine\ORM\EntityManagerInterface;

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
    }

    /**
     * @param Order $order
     *
     * @return \App\Entities\Order
     */
    public function create(Order $order): Order
    {
        $this->em->persist($order);
        $this->em->flush();

        return $order;
    }
}