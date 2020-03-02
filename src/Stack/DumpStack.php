<?php

declare(strict_types = 1);

namespace AvtoDev\StackedDumper\Stack;

class DumpStack implements DumpStackInterface
{
    /**
     * @var string[]
     */
    protected $stack = [];

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function push(string $data): void
    {
        $this->stack[] = $data;
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->stack = [];
    }

    /**
     * {@inheritdoc}
     */
    public function all(): array
    {
        return $this->stack;
    }

    /**
     * {@inheritdoc}
     */
    public function count(): int
    {
        return \count($this->stack);
    }
}
