<?php

namespace App;

class Invoice
{
    protected function process(float $amount, $description)
    {
        var_dump($amount, $description);
    }

    public function __call(string $name, array $arguments)
    {
        if(method_exists($this, $name)) {
            call_user_func_array([$this, $name], $arguments);            
        }
        //var_dump($name, $arguments);
    }

    public static function __callStatic(string $name, array $arguments)
    {
        var_dump('static', $name, $arguments);
    }
}