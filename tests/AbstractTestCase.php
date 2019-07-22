<?php

declare(strict_types = 1);

namespace AvtoDev\StackedDumper\Tests;

use Illuminate\Contracts\Console\Kernel;
use AvtoDev\StackedDumper\ServiceProvider;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class AbstractTestCase extends BaseTestCase
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        /** @var \Illuminate\Foundation\Application $app */
        $app = require __DIR__ . '/../vendor/laravel/laravel/bootstrap/app.php';

        $app->useStoragePath($temp_path = __DIR__ . '/temp/storage');

        $app->make(Kernel::class)->bootstrap();

        //$app->make('config')->set('app.debug', true);
        //$app->make('config')->set('cache.default', 'file');

        $app->register(ServiceProvider::class);

        return $app;
    }
}
