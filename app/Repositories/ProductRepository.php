<?php

namespace App\Repositories;


use App\Entities\Price;
use App\Entities\Product;
use Doctrine\ORM\EntityManagerInterface;
use DomainException;

/**
 * Class ProductRepository
 *
 * @package App\Repositories
 */
class ProductRepository
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
     * @param array $idList
     *
     * @return Product[]
     */
    public function getFromIdList(array $idList): array
    {
        $productList = [];

        foreach ($idList as $id) {
            $productList[$id] = new Product('Name', Price::create(100), $id);
        }

        return $productList;
    }

    /**
     * @param int $id
     *
     * @return Product|null
     */
    public function find(int $id): ?Product
    {
        $productRepository = $this->em->getRepository(Product::class);

        $product = $productRepository->find($id);

        if ($product === null) {
            throw new DomainException('Not found product by id ' . $id);
        }

        return $product;
    }
}