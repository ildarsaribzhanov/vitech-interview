<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

/**
 * Class CreateProducts
 */
final class CreateProducts extends AbstractMigration
{
    /**
     *
     */
    public function up()
    {
        // create the table
        $table = $this->table('products');
        $table->addColumn('name', 'string')
            ->addColumn('price', 'integer')
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->table('products')->drop()->save();
    }
}
