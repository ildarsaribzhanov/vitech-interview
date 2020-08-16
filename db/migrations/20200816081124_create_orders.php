<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateOrders extends AbstractMigration
{
    /**
     *
     */
    public function up()
    {
        // create the table
        $tableOrders = $this->table('orders');
        $tableOrders->addColumn('user_id', 'biginteger')
            ->addColumn('total_cost', 'integer')
            ->addColumn('status', 'string', ['default' => 'NEW'])
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();

        $tableOrderItms = $this->table('order_products');
        $tableOrderItms->addColumn('order_id', 'biginteger')
            ->addColumn('product_id', 'biginteger')
            ->addColumn('amount', 'integer')
            ->create();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->table('orders')->drop()->save();
        $this->table('order_products')->drop()->save();
    }
}
