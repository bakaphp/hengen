<?php


declare(strict_types=1);

namespace Kanvas\Hengen\Transformers;

use Baka\Database\Model;
use Canvas\Models\SystemModules;
use Canvas\Template;
use Kanvas\Hengen\Contracts\Interfaces\LeadsInterfaces;
use Kanvas\Hengen\Contracts\Interfaces\TransformerEngine;

class ADF implements TransformerEngine
{
    protected array $data;
    protected LeadsInterfaces $lead;
    protected array $options;


    /**
     * __construct.
     *
     * @param  LeadsInterfaces $leads
     * @param  array $options
     * @param  Model $args
     *
     * @return void
     */
    public function __construct(LeadsInterfaces $leads, array $options = [], Model ...$args)
    {
        foreach ($args as $arg) {
            $systemModule = SystemModules::getByModelName(get_class($arg));
            $this->data[$systemModule->slug] = $arg->toArray();
        }
        $this->data['lead'] = $leads->toArray();
        $this->lead = $leads;
        $this->setOption($options);
    }

    /**
     * Function that will return the ADF format for specific lead.
     */
    public function toFormat() : string
    {
        return Template::generate($this->getOption('template'), ['data' => $this->getData()]);
    }


    /**
     * getData.
     *
     * @return array
     */
    public function getData() : array
    {
        return $this->data;
    }

    /**
     * setOption.
     *
     * @return self
     */
    public function setOption(array $options) : self
    {
        $this->options = $options;
        return $this;
    }


    /**
     * getOption.
     *
     * @param  string $name
     *
     * @return mixed
     */
    public function getOption(?string $name = null) : array
    {
        if ($name) {
            return $this->options[$name];
        }

        return $this->options;
    }
}
