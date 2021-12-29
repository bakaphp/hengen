<?php

declare(strict_types=1);

namespace Kanvas\Hengen\Contracts\Interfaces;

interface CommunicationEngine
{
    /**
     * Function that will send a transformed entity to the third party integration.
     */
    public function send() : bool;
}
