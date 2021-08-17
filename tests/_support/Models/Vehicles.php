<?php

declare(strict_types=1);

namespace Kanvas\Hengen\Tests\Support\Models;

use Baka\Database\Model;

class Vehicles extends Model
{
    public string $vin;
    public string $make;
    public string $model;
    public string $int_color;
    public string $ext_color;

    public function initialize()
    {
        $this->setSource('vehicles');
    }
}
