<?php

declare(strict_types = 1);

namespace AvtoDev\StackedDumper\Tests\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use AvtoDev\StackedDumper\Tests\AbstractTestCase;
use AvtoDev\StackedDumper\Exceptions\VarDumperException;

/**
 * @covers \AvtoDev\StackedDumper\Exceptions\VarDumperException<extended>
 */
class VarDumperExceptionTest extends AbstractTestCase
{
    /**
     * @var VarDumperException
     */
    protected $exception;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->exception = new VarDumperException('foo');
    }

    /**
     * @small
     *
     * @return void
     */
    public function testDefaultCode(): void
    {
        $this->assertSame(Response::HTTP_INTERNAL_SERVER_ERROR, $this->exception->getCode());
    }

    /**
     * @small
     *
     * @return void
     */
    public function testReportDoNothing(): void
    {
        $message = $this->exception->getMessage();
        $code    = $this->exception->getCode();
        $prev    = $this->exception->getPrevious();

        $this->exception->report();

        $this->assertSame($message, $this->exception->getMessage());
        $this->assertSame($code, $this->exception->getCode());
        $this->assertSame($prev, $this->exception->getPrevious());
    }

    /**
     * @return void
     */
    public function testRender(): void
    {
        $response = $this->exception->render();

        $this->assertContains($this->exception->getMessage(), $response->getContent());
        $this->assertContains('<html', $response->getContent());
        $this->assertContains('<body', $response->getContent());
        $this->assertSame($this->exception->getCode(), $response->getStatusCode());
    }
}
