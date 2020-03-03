<?php

namespace AvtoDev\StackedDumper\Stack;

use Countable;

interface DumpStackInterface extends Countable
{
    /**
     * Push an element into stack.
     *
     * @param string $data
     *
     * @return mixed|void
     */
    public function push(string $data);

    /**
     * Clear stack.
     *
     * @return void
     */
    public function clear();

    /**
     * Get all stack elements.
     *
     * @return string[]
     */
    public function all(): array;
}
