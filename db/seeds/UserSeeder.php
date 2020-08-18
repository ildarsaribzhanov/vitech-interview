<?php


use Faker\Factory;
use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
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
        $faker = Factory::create();
        $this->execute('insert into users(id, login) values (1, "' . $faker->name . '") 
            on duplicate key update login = "' . $faker->name . '"');
    }
}
