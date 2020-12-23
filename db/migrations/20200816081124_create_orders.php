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

        $this->table('orders')
            ->changeColumn('id', 'biginteger', ['identity' => true])->save();

        $tableOrderItms = $this->table('order_products', ['id' => false, 'primary_key' => ['order_id', 'product_id']]);
        $tableOrderItms->addColumn('order_id', 'biginteger')
            ->addColumn('product_id', 'biginteger', ['null' => true])
            ->addColumn('amount', 'integer')
            ->addForeignKey('order_id', 'orders', 'id', ['delete' => 'CASCADE','update' => 'NO_ACTION', 'constraint' => 'amount_by_order'])
            ->addForeignKey('product_id', 'products', 'id', ['delete'=> 'RESTRICT', 'update'=> 'RESTRICT', 'constraint' => 'amount_by_product'])
            ->create();

        $this->table('order_products')
            ->save();
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
