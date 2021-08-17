<?php


use Phinx\Seed\AbstractSeed;

class VendorsSeeder extends AbstractSeed
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
        $this->table('vendors')
            ->insert([
                [
                    'name' => 'SA',
                    'full_name' => 'Sales Assits'
                ]
            ])
            ->saveData();
    }
}
