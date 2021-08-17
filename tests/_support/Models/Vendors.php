<?php

declare(strict_types=1);

namespace Kanvas\Hengen\Tests\Support\Models;

use Baka\Database\Model;

class Vendors extends Model
{
    public string $name;
    public string $full_name;

    public function initialize()
    {
        $this->setSource('vendors');
    }
}
