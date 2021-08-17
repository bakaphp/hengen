<?php

use Canvas\Models\Companies;

use Faker\Factory;
use Faker\Provider\en_US\Person;
use Faker\Provider\en_US\PhoneNumber;
use Faker\Provider\Internet;

use Kanvas\Hengen\Hengen;
use Kanvas\Hengen\Tests\Support\Models\Leads;
use Kanvas\Hengen\Tests\Support\Models\Vehicles;
use Kanvas\Hengen\Tests\Support\Models\Vendors;

class ADFTest extends \Codeception\Test\Unit
{
    /**
     * @var \IntegrationTester
     */
    protected $tester;

    protected function _before()
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
    }

    protected function _after()
    {
    }

    // tests
    public function testHengen()
    {
        $lead = Leads::findFirstOrFail();
        $vendors = Vendors::findFirstOrFail();
        $vehicles = Vehicles::findFirstOrFail();
        $companies = Companies::findFirstOrFail();

        $transformer = Hengen::getTransformer('ADF', $lead, ['template' => 'dealer-content'], $vendors, $vehicles);
        $communicator = Hengen::getCommunication($transformer, $companies);
        codecept_debug($transformer->toFormat());
        $confComm = $communicator->send();

        $this->assertTrue($confComm);
    }
}
