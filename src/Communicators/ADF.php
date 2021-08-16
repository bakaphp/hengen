<?php

declare(strict_types=1);

namespace Hengen\Communicators;

use Canvas\Models\Companies;
use Hengen\Contracts\Interfaces\CommunicationEngine;
use Hengen\Contracts\Interfaces\TransformerEngine;
use Phalcon\Di;

class ADF implements CommunicationEngine
{
    protected TransformerEngine $transformedLead;
    protected Companies $company;

    public function __construct(TransformerEngine $transformedLead, Companies $company)
    {
        $this->transformedLead = $transformedLead;
        $this->company = $company;
    }

    /**
     * Function that will return the ADF format for specific lead.
     */
    public function send() : bool
    {
        $mail = Di::getDefault()->get('mail');

        $mail->to($this->company->user->getEmail())
            ->content($this->transformedLead->toFormat(), 'text/plain')
            ->send();

        //save reference to leads_lead_source

        return true;
    }
}
