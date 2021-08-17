<?php

namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I
use Codeception\TestInterface;


use Phalcon\Di;
use Phalcon\Mvc\Model\Manager as ModelsManager;
use Phalcon\Mvc\Model\Metadata\Memory;

class Integration extends \Codeception\Module
{
    protected $diContainer = null;

    public function _before(TestInterface $test)
    {
        $this->diContainer = new Di();
        $this->setDi();
    }

    protected function setDi()
    {
        $this->diContainer->setShared(
            'modelsManager',
            function () {
                return new ModelsManager();
            }
        );

        $this->diContainer->setShared(
            'modelsMetadata',
            function () {
                return new Memory();
            }
        );
        $providers = include __DIR__ . '/../../providers.php';
        foreach ($providers as $provider) {
            (new $provider())->register($this->diContainer);
        }
    }
}
