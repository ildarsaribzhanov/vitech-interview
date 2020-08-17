<?php

namespace App\Repositories;


use App\Entities\Order;
use App\Entities\OrderItm;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class OrderItmRepository
 *
 * @package App\Repositories
 */
class OrderItmRepository
{
    /** @var EntityManagerInterface */
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
     * @param OrderItm[] $list
     * @param Order      $order
     */
    public function createListForOrder(array $list, Order $order): void
    {
        foreach ($list as $orderItm) {
            $orderItm->setOrder($order);
            $this->em->persist($orderItm);
        }

        $this->em->flush();
    }
}