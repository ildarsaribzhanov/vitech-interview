<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUsersTable extends AbstractMigration
{
    public function up()
    {
        // create the table
        $table = $this->table('users');
        $table->addColumn('login', 'string')
            ->create();

        $this->table('users')
            ->changeColumn('id', 'biginteger', ['identity' => true])->save();

        $tableOrders = $this->table('orders');
        $tableOrders->addForeignKey('user_id', 'users', 'id', ['delete' => 'RESTRICT', 'update' => 'NO_ACTION'])
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->table('users')->drop()->save();
    }
}
