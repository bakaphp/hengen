<?php

use Canvas\Models\Companies;

use Hengen\Hengen;
use Hengen\Tests\Support\Models\Leads;
use Hengen\Tests\Support\Models\Vehicles;

use Hengen\Tests\Support\Models\Vendors;

class ADFTest extends \Codeception\Test\Unit
{
    /**
     * @var \IntegrationTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testHengen()
    {
        $lead = Leads::findFirst();
        $vendors = Vendors::findFirst();
        $vehicles = Vehicles::findFirst();
        $companies = Companies::findFirst();

        $transformer = Hengen::getTransformer('ADF', $lead, ['template' => 'dealer-content'], $vendors, $vehicles);
        $communicator = Hengen::getCommunication($transformer, $companies);

        $confComm = $communicator->send();

        $this->assertTrue($confComm);
    }
}
