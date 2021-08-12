<?php

use Faker\Factory;
use Faker\Provider\en_US\Person;
use Faker\Provider\en_US\PhoneNumber;
use Faker\Provider\Internet;
use Hengen\Tests\Support\Models\Leads;
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
        $adfTransformer = new ADF($leads);
        $this->assertIsArray($adfTransformer->getData(), 'Expected an array');
    }
}
