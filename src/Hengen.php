<?php

namespace Kanvas\Hengen;

use Baka\Database\Model;
use Canvas\Models\Companies;
use Kanvas\Hengen\Communicators\ADF as ADFCommunicator;
use Kanvas\Hengen\Contracts\Interfaces\LeadsInterfaces;
use Kanvas\Hengen\Contracts\Interfaces\TransformerEngine;
use Kanvas\Hengen\Transformers\ADF;

class Hengen
{
    /**
     * getTransformer.
     *
     * @param  string $type
     * @param  LeadsInterfaces $leads
     * @param  array $options
     * @param  Model $args
     *
     * @return void
     */
    public static function getTransformer(string $type, LeadsInterfaces $leads, array $options = [], Model ...$args)
    {
        /**
         * doesn't necessary has to be a switch , we can get it from the DB better so we don't have to hard code
         * each implementation.
         **/
        switch ($type) {
            case 'ADF':
                    return new ADF($leads, $options, ...$args);
                break;
        }
    }

    /**
     * getCommunication.
     *
     * @param  TransformerEngine $transformer
     * @param  Companies $companies
     *
     * @return void
     */
    public static function getCommunication(TransformerEngine $transformer, Companies $companies)
    {
        switch (get_class($transformer)) {
            case ADF::class:
                return new ADFCommunicator($transformer, $companies);
                break;
        }
    }
}
