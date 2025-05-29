<?php

namespace App;

class ClassA
{
    protected static string $name = 'A';

    public function getName(): string
    {
        var_dump(get_class($this));

        return static::$name;
    }

    public static function make(): static
    {
        return new static();
    }
}