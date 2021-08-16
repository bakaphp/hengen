<?php



use Phinx\Seed\AbstractSeed;

class TemplatesSeeder extends AbstractSeed
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
        $template = '
        <?ADF VERSION \'1.0\'?>
        <?XML VERSION \'1.0\'?>
        <adf>
            <prospect>
                <customer>
                    <contact>
                        <name part="full">{{data[\'lead\'][\'firstname\']}} {{data[\'lead\'][\'lastname\']}}</name>
                        <phone>{{data[\'lead\'][\'phone\']}}</phone>
                        <email>{{data[\'lead\'][\'email\']}}</email>
                    </contact>
                </customer>
                <vehicle>
                    <vin>{{data[\'vehicles\'][\'vin\']}}</vin>
                </vehicle>
                <vendor>
                    <contact>
                        <name part=\'full\'>{{data[\'vendors\'][\'name\']}}</name>
                        <fullname part=\'full\'>{{data[\'vendors\'][\'full_name\']}}</fullname>
                    </contact>
                </vendor>
            </prospect>
        </adf>';

        $data = [
            [
                'companies_id' => 0,
                'apps_id' => 0,
                'name' => 'dealer-content',
                'template' => $template,
                'users_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $this->table('email_templates')
            ->insert($data)
            ->saveData();
    }
}
