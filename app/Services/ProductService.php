<?php

namespace App\Services;


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

        return $app->run(new StringInput('seed:run'), new NullOutput());
    }
}