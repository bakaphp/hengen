<?php

/**
 * Enabled providers. Order does matter.
 */

use Canvas\Providers\AppProvider;
use Canvas\Providers\CacheDataProvider;
use Canvas\Providers\DatabaseProvider;
use Canvas\Providers\MapperProvider;
use Canvas\Providers\ModelsCacheProvider;
use Canvas\Providers\RegistryProvider;
use Canvas\Providers\UserProvider;
use Hengen\Tests\Support\Providers\ConfigProvider;

return [
    ConfigProvider::class,
    DatabaseProvider::class,
    RegistryProvider::class,
    AppProvider::class,
    UserProvider::class,
    CacheDataProvider::class,
    ModelsCacheProvider::class,
    MapperProvider::class
];
