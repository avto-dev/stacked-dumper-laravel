<?php

declare(strict_types = 1);

namespace AvtoDev\StackedDumper;

use Illuminate\Contracts\Http\Kernel;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Boot package services.
     *
     * @return void
     */
    public function boot(): void
    {
        /** @var \Illuminate\Foundation\Http\Kernel $kernel */
        $kernel = $this->app->make(Kernel::class);
        $kernel->pushMiddleware(Middleware\VarDumperMiddleware::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(Stack\DumpStackInterface::class, Stack\DumpStack::class);
    }
}
