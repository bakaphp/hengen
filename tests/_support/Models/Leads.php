<?php

declare(strict_types=1);

namespace Kanvas\Hengen\Tests\Support\Models;

use Baka\Database\Model;
use Kanvas\Hengen\Contracts\Interfaces\LeadsInterfaces;

class Leads extends Model implements LeadsInterfaces
{
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $phone;

    public function initialize()
    {
        $this->setSource('leads');
    }
}
