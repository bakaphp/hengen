<?php

namespace Hengen;

use Baka\Database\Model;
use Canvas\Models\Companies;
use Hengen\Communicators\ADF as ADFCommunicator;
use Hengen\Contracts\Interfaces\LeadsInterfaces;
use Hengen\Contracts\Interfaces\TransformerEngine;
use Hengen\Transformers\ADF;

class Hengen
{
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
     * @param  string $type
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
