<?php

declare(strict_types = 1);

namespace AvtoDev\StackedDumper\Tests;

use AvtoDev\StackedDumper\Stack\DumpStackInterface;
use AvtoDev\StackedDumper\Exceptions\VarDumperException;

/**
 * @coversNothing
 */
class FunctionsTest extends AbstractTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        unset($_SERVER['DEV_DUMP_CLI_MODE']);
    }

    /**
     * @return void
     */
    public function testFunctionExists(): void
    {
        $functions = [
            '\\dev\\ran_using_cli',
            '\\dev\\dd',
            '\\dev\\dump',
        ];

        foreach ($functions as $function) {
            $this->assertTrue(\function_exists($function));
        }
    }

    /**
     * @return void
     */
    public function testRanUsingCli(): void
    {
        $_SERVER['DEV_DUMP_CLI_MODE'] = true;

        $this->assertTrue(\dev\ran_using_cli());

        $_SERVER['DEV_DUMP_CLI_MODE'] = false;

        $this->assertFalse(\dev\ran_using_cli());

        unset($_SERVER['DEV_DUMP_CLI_MODE']);
    }

    /**
     * @return void
     */
    public function testNonCliDdExecution(): void
    {
        $this->expectException(VarDumperException::class);

        $_SERVER['DEV_DUMP_CLI_MODE'] = false;

        \dev\dd(null);

        unset($_SERVER['DEV_DUMP_CLI_MODE']);
    }

    /**
     * @return void
     */
    public function testNonCliDumpExecution(): void
    {
        /** @var DumpStackInterface $stack */
        $stack = $this->app->make(DumpStackInterface::class);

        $_SERVER['DEV_DUMP_CLI_MODE'] = false;

        $this->assertEmpty($stack);

        \dev\dump(null);

        $this->assertCount(1, $stack);

        \dev\dump('foo');

        $this->assertCount(2, $stack);
    }
}
