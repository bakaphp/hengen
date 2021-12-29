<?php

declare(strict_types=1);

namespace Kanvas\Hengen\Contracts;

interface Hengen
{
    /**
     * Return a transformed entity.
     *
     * @return mixed|object|array|string
     */
    public function transform();
}
