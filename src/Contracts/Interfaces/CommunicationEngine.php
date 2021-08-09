<?php

namespace Hengen\Contracts\Interfaces;

interface CommunicationEngine
{
    /**
     * Function that will send a transformed entity to the third party integration.
     */
    public function send() : bool;
}
