<?php

namespace App\Repositories;


use App\Entities\Price;
use App\Entities\Product;

/**
 * Class ProductRepository
 *
 * @package App\Repositories
 */
class ProductRepository
{
    /**
     * @param array $idList
     *
     * @return Product[]
     */
    public function getFromIdList(array $idList): array
    {
        $productList = [];

        foreach ($idList as $id) {
            $productList[$id] = new Product($id, 'Name', Price::create(100));
        }

        return $productList;
    }
}