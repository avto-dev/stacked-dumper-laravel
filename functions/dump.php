<?php

declare(strict_types = 1);

namespace dev;

use Illuminate\Container\Container;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;
use AvtoDev\StackedDumper\Stack\DumpStackInterface;
use AvtoDev\StackedDumper\Exceptions\VarDumperException;

if (! \function_exists('\\dev\\ran_using_cli')) {
    /**
     * Detects ran using CLI.
     *
     * @return bool
     */
    function ran_using_cli(): bool
    {
        if (isset($_SERVER[$name = 'DEV_DUMP_CLI_MODE'])) {
            return ((bool) $_SERVER[$name]) === true;
        }

        // Detect running under RoadRunner (since RR v1.2.1)
        if (((bool) \getenv('RR_HTTP')) === true) {
            return false;
        }

        return \in_array(\PHP_SAPI, ['cli', 'phpdbg'], true);
    }
}

if (! \function_exists('\\dev\\dd')) {
    /**
     * Dump passed values and die (or throw an Exception).
     *
     * @param mixed ...$_
     *
     * @throws VarDumperException
     *
     * @return void
     */
    function dd(...$_): void
    {
        // Ran under CLI?
        if (ran_using_cli() === true) {
            // @codeCoverageIgnoreStart

            // "\dd()" is included into next packages:
            // - "illuminate/support" since v4.0 up to v5.6 included
            // - "symfony/var-dumper" since v4.1 and above
            if (\function_exists('\\dd')) {
                \dd(...$_);
            } else {
                foreach ($_ as $argument) {
                    \dump($argument);
                }

                die(1);
            }
            // @codeCoverageIgnoreEnd
        } else {
            $dumper = new HtmlDumper;

            $parts = \array_map(function ($argument) use ($dumper) {
                return $dumper->dump((new VarCloner)->cloneVar($argument), true);
            }, $_);

            throw new VarDumperException(\implode(\PHP_EOL, $parts));
        }
    }
}

if (! \function_exists('\\dev\\dump')) {
    /**
     * Dump passed values.
     *
     * @param mixed ...$_
     *
     * @return void
     */
    function dump(...$_): void
    {
        // Ran under CLI?
        if (ran_using_cli() === true) {
            // @codeCoverageIgnoreStart
            \dump(...$_);
            // @codeCoverageIgnoreEnd
        } else {
            $dumper = new HtmlDumper;

            // For Laravel application
            if (\class_exists(Container::class)) {
                /** @var DumpStackInterface $stack */
                $stack = Container::getInstance()->make(DumpStackInterface::class);

                foreach ($_ as $argument) {
                    $stack->push($dumper->dump((new VarCloner)->cloneVar($argument), true));
                }
            }
        }
    }
}
