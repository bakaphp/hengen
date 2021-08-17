<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class VehiclesTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change() : void
    {
        $this->table('vehicles')
            ->addColumn('vin', 'string', ['null' => false])
            ->addColumn('make', 'string', ['null' => false])
            ->addColumn('model', 'string', ['null' => false])
            ->addColumn('int_color', 'string', ['null' => false])
            ->addColumn('ext_color', 'string', ['null' => false])
            ->create();
    }
}
