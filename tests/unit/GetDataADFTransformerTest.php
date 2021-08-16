<?php

use Canvas\Models\SystemModules;
use Faker\Factory;
use Faker\Provider\en_US\Person;
use Faker\Provider\en_US\PhoneNumber;
use Faker\Provider\Internet;
use Hengen\Tests\Support\Models\Leads;
use Hengen\Tests\Support\Models\Vehicles;

use Hengen\Tests\Support\Models\Vendors;
use Hengen\Transformers\ADF;

class GetDataADFTransformerTest extends \Codeception\Test\Unit
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
    public function testGetData()
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
        $leads = new Leads();
        $leads->saveOrFail($data);

        $vendor = Vendors::findFirst();
        $vehicle = Vehicles::findFirst();

        $adfTransformer = new ADF($leads, ['template' => 'dealer-content'], $vendor, $vehicle);
        $adfData = $adfTransformer->getData();

        $this->assertIsArray($adfData, 'Expected an array');

        $vendorKey = SystemModules::getByModelName(Vendors::class)->slug;
        $vehiclesKey = SystemModules::getByModelName(Vehicles::class)->slug;

        $this->assertEquals(array_key_exists($vendorKey, $adfData), true);
        $this->assertEquals(array_key_exists($vehiclesKey, $adfData), true);
    }
}
