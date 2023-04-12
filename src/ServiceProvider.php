<?php

declare(strict_types = 1);

namespace AvtoDev\StackedDumper;

use Illuminate\Foundation\Http\Kernel;
use Illuminate\Contracts\Http\Kernel as KernelContract;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Boot package services.
     *
     * @return void
     */
    public function boot(): void
    {
        /** @var Kernel $kernel */
        $kernel = $this->app->make(KernelContract::class);

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
