<?php

declare(strict_types = 1);

namespace AvtoDev\StackedDumper\Tests;

use AvtoDev\StackedDumper\Stack\DumpStack;
use Illuminate\Contracts\Http\Kernel as HttpKernel;
use AvtoDev\StackedDumper\Middleware\VarDumperMiddleware;

/**
 * @covers \AvtoDev\StackedDumper\ServiceProvider<extended>
 */
class ServiceProviderTest extends AbstractTestCase
{
    /**
     * @return void
     */
    public function testMiddlewareIsRegistered(): void
    {
        $this->assertTrue($this->app->make(HttpKernel::class)->hasMiddleware(VarDumperMiddleware::class));
    }

    /**
     * @return void
     */
    public function testServiceContainers(): void
    {
        $this->assertInstanceOf(DumpStack::class, $this->app->make(DumpStack::class));
    }
}
