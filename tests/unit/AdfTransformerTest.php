<?php

use Faker\Factory;
use Faker\Provider\en_US\Person;
use Faker\Provider\en_US\PhoneNumber;
use Faker\Provider\Internet;

use Hengen\Tests\Support\Models\Leads;
use Hengen\Tests\Support\Models\Vehicles;
use Hengen\Tests\Support\Models\Vendors;

use Hengen\Transformers\ADF;

class AdfTransformerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testTemplateString()
    {
        $faker = Factory::create();
        $faker->addProvider(new Person($faker));
        $faker->addProvider(new PhoneNumber($faker));
        $faker->addProvider(new Internet($faker));

        $data = [
            'firstname' => $faker->name,
            'lastname' => $faker->address,
            'email' => $faker->email,
            'phone' => $faker->phoneNumber
        ];

        $dataVehicle = [
            'vin' => rand(10000, 100000),
            'make' => 'American Vehicle',
            'model' => 'V1',
            'int_color' => 'grey',
            'ext_color' => 'blue'
        ];

        $leads = new Leads();
        $leads->saveOrFail($data);

        $vehicles = new Vehicles();
        $vehicles->saveOrFail($dataVehicle);

        $vendors = Vendors::findFirst();

        $adfTransformer = new ADF($leads, ['template' => 'dealer-content'], $vehicles, $vendors);
        $this->assertIsString($adfTransformer->toFormat(), "ADF Trasnformer format isn't a string");
    }
}
