<?php


use Phinx\Seed\AbstractSeed;

class SystemsModulesSeeder extends AbstractSeed
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
        $data = [
            [
                'name' => 'Vehicles',
                'slug' => 'vehicles',
                'model_name' => 'Kanvas\Hengen\Tests\Support\Models\Vehicles',
                'apps_id' => 1,
                'parents_id' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Vendors',
                'slug' => 'vendors',
                'model_name' => 'Kanvas\Hengen\Tests\Support\Models\Vendors',
                'apps_id' => 1,
                'parents_id' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];
        $this->table('system_modules')
            ->insert($data)
            ->saveData();
    }
}
