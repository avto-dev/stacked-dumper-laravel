<?php

declare(strict_types = 1);

namespace AvtoDev\StackedDumper\Tests\Stack;

use AvtoDev\StackedDumper\Stack\DumpStack;
use AvtoDev\StackedDumper\Tests\AbstractTestCase;

/**
 * @covers \AvtoDev\StackedDumper\Stack\DumpStack
 */
class DumpStackTest extends AbstractTestCase
{
    /**
     * @var DumpStack
     */
    protected $stack;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->stack = new DumpStack;
    }

    /**
     * @return void
     */
    public function testInterfaces(): void
    {
        $this->assertInstanceOf(\Countable::class, $this->stack);
    }

    /**
     * @return void
     */
    public function testPush(): void
    {
        $this->assertCount(0, $this->stack);

        $this->stack->push($value = 'foo_' . \random_int(1, 255));

        $this->assertCount(1, $this->stack);
        $this->assertSame($value, $this->stack->all()[0]);
    }

    /**
     * @return void
     */
    public function testClearAndCount(): void
    {
        $this->stack->push('foo');

        $this->assertEquals(1, $this->stack->count());

        $this->stack->clear();

        $this->assertEquals(0, $this->stack->count());
    }

    /**
     * @return void
     */
    public function testAll(): void
    {
        $data = ['baz', 'foo', 'bar'];

        foreach ($data as $item) {
            $this->stack->push($item);
        }

        $this->assertSame($data, $this->stack->all());
    }
}
