<?php
declare(strict_types=1);

namespace Kanvas\Hengen\Contracts\Interfaces;

interface TransformerEngine
{
    /**
     * Function that will return the ADF format for specific lead.
     */
    public function toFormat() : string;
    /**
     * Function that will return the array data attribute.
     */
    public function getData() : array;
}
