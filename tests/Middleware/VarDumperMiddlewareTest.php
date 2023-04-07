<?php

declare(strict_types = 1);

namespace AvtoDev\StackedDumper\Tests\Middleware;

use Illuminate\Routing\Router;
use AvtoDev\StackedDumper\Tests\AbstractTestCase;
use AvtoDev\StackedDumper\Middleware\VarDumperMiddleware;

/**
 * @covers \AvtoDev\StackedDumper\Middleware\VarDumperMiddleware
 */
class VarDumperMiddlewareTest extends AbstractTestCase
{
    /**
     * @return void
     */
    public function testDumpWithMiddlewareWorking(): void
    {
        /** @var Router $router */
        $router         = $this->app->make(Router::class);
        $repeat_counter = 0;

        // Two requests will contains dump data, any another - not
        $router
            ->get($path = '/test' . \random_int(1, 255), function () use (&$repeat_counter) {
                if ($repeat_counter < 2) {
                    \dev\dump('foo bar', 'john doe');

                    $repeat_counter++;
                }

                return response('<html><body>bar baz</body></html>');
            })->middleware(VarDumperMiddleware::class);

        $response1 = $this->get($path);
        $response2 = $this->get($path);
        $response3 = $this->get($path);

        foreach (['foo bar', 'john doe', 'bar baz', 'window.Sfdump'] as $item) {
            $this->assertStringContainsString($item, $response1->getContent());
            $this->assertStringContainsString($item, $response2->getContent());
        }

        foreach (['foo bar', 'john doe', 'window.Sfdump'] as $item) {
            $this->assertStringNotContainsString($item, $response3->getContent());
        }
        $this->assertStringContainsString('bar baz', $response3->getContent());
    }

    /**
     * @return void
     */
    public function testDdWithException(): void
    {
        /** @var Router $router */
        $router = $this->app->make(Router::class);

        // \dev\dd() should work with middleware
        $router
            ->get($path_with_middleware = '/test' . \random_int(1, 255), function () {
                \dev\dd('foo bar');

                return \response('bar baz');
            })->middleware(VarDumperMiddleware::class);

        // and without it
        $router
            ->get($path_without_middleware = '/test' . \random_int(256, 512), function () {
                \dev\dd('foo bar');

                return \response('bar baz');
            });

        $response_with_middleware    = $this->get($path_with_middleware);
        $response_without_middleware = $this->get($path_without_middleware);

        foreach ([$response_with_middleware, $response_without_middleware] as $response) {
            $this->assertStringContainsString('foo bar', $response->getContent());
            $this->assertStringContainsString('window.Sfdump', $response->getContent());
            $this->assertStringNotContainsString('bar baz', $response->getContent());
        }
    }
}
