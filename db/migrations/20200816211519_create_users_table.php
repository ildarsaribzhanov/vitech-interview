<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUsersTable extends AbstractMigration
{
    public function up()
    {
        // create the table
        $table = $this->table('users');
        $table->addColumn('name', 'string')
            ->create();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->table('users')->drop()->save();
    }
}
