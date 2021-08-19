<?php

declare(strict_types=1);

namespace Kanvas\Hengen\Communicators;

use Canvas\Models\Companies;
use Kanvas\Hengen\Contracts\Interfaces\CommunicationEngine;
use Kanvas\Hengen\Contracts\Interfaces\TransformerEngine;
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
        $config = Di::getDefault()->get('config');
        $email = $config->app->production ? $this->company->user->getEmail() : $config->app->emailDev;
        $mail->to($email)
            ->content($this->transformedLead->toFormat(), 'text/plain')
            ->sendNow();

        //save reference to leads_lead_source

        return true;
    }
}
