<?php

namespace App\Repositories;


use App\Entities\Product;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use DomainException;

/**
 * Class ProductRepository
 *
 * @package App\Repositories
 */
class ProductRepository
{
    /** @var ObjectRepository */
    private ObjectRepository $emRepository;

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

        $this->emRepository = $em->getRepository(Product::class);
    }

    /**
     * @param array $idList
     *
     * @return Product[]
     */
    public function getFromIdList(array $idList): array
    {
        $query       = $this->em->createQuery("SELECT p FROM " . Product::class . " p WHERE p.id IN (" . implode(', ', $idList) . ")");
        $productList = $query->getResult();

        $listRes = [];

        /** @var Product $productEntity */
        foreach ($productList as $productEntity) {
            $listRes[$productEntity->getId()] = $productEntity;
        }

        return $listRes;
    }

    /**
     * @param int $id
     *
     * @return Product|object|null
     */
    public function find(int $id): ?Product
    {
        $product = $this->emRepository->find($id);

        if ($product === null) {
            throw new DomainException('Not found product by id ' . $id);
        }

        return $product;
    }
}