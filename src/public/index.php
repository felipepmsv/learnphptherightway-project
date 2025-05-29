<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Complicado demais para descrever em poucas palavras,
// portanto é melhor rever o vídeo caso não tenha entendido

$classA = new \App\ClassA();
$classB = new \App\ClassB();

// echo $classA->getName() . PHP_EOL;
// echo $classB->getName() . PHP_EOL;

// echo \App\ClassA::getName() . PHP_EOL;
// echo \App\ClassB::getName() . PHP_EOL;

var_dump(\App\ClassB::make());

