<?php


declare(strict_types=1);

namespace Hengen\Transformers;

use Baka\Database\Model;
use Canvas\Models\SystemModules;
use Canvas\Template;
use Hengen\Contracts\Interfaces\LeadsInterfaces;
use Hengen\Contracts\Interfaces\TransformerEngine;

class ADF implements TransformerEngine
{
    protected array $data;

    /**
     * __construct.
     *
     * @param  LeadsInterfaces $leads
     * @param  Model $args
     *
     * @return void
     */
    public function __construct(LeadsInterfaces $leads, Model ...$args)
    {
        foreach ($args as $arg) {
            $systemModule = SystemModules::getByModelName(self::class);
            $this->data[$systemModule->slug] = $args->getData();
        }
    }

    /**
     * Function that will return the ADF format for specific lead.
     */
    public function toFormat() : string
    {
        return Template::generate('ADF', $this->getData());
    }
}
