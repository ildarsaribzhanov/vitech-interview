<?php


use Faker\Factory;
use Phinx\Seed\AbstractSeed;

/**
 * Class ProductSeeder
 */
class ProductSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $productsTable = $this->table('products');
        $productsTable->truncate();

        $faker = Factory::create();
        $data  = [];

        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                'name'       => $faker->text(20),
                'price'      => $faker->randomNumber(3) * 100,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),

            ];
        }

        $productsTable->insert($data)->saveData();
    }
}
