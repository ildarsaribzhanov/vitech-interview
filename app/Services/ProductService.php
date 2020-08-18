<?php

namespace App\Services;


use App\Entities\Product;
use App\Repositories\ProductRepository;
use Phinx\Console\PhinxApplication;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\NullOutput;

/**
 * Class ProductService
 *
 * @package App\Services
 */
class ProductService
{
    /** @var ProductRepository */
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Fill table with fake products
     *
     * @return int
     * @throws \Exception
     */
    public function fillFake()
    {
        $app = new PhinxApplication();

        $app->setAutoExit(false);

        return $app->run(new StringInput('seed:run -s ProductSeeder'), new NullOutput());
    }

    /**
     * @param int $id
     *
     * @return Product|null
     */
    public function findById(int $id): ?Product
    {
        return $this->productRepository->find($id);
    }
}