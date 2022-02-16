<?php

require 'vendor/autoload.php';

$twig = new Twig\Environment(
    new Twig\Loader\ArrayLoader(),
    ['autoescape' => false]
);



// Your code goes here



$test = static function (string $expression, string $expected) use ($twig): string {
    $twig->getLoader()->setTemplate($expression, "{{ $expression }}");
    
    $actual = $twig->render($expression, [
        'a' => 1000,
        'b' =>  337,
        'c' => null,
    ]);
    
    if ($actual !== $expected) {
        error_log("Result for expression '$expression' is '$actual', expected '$expected'");
        return false;
    }
    return true;
};

$test('a',                  '1000');
$test('a + b',              '1337');

$test('c',                  '');
$test('+c',                 '');
$test('a + c',              '');
$test('a + (b - b)',        '1000');

$test('a ? b : c',          '337');
$test('a + (c ?? b)',       '1337');
$test('a + {"v": c}["v"]',  '');

// Stretch goal: remove return statement and ensure that the tests below pass as well
return;

$test('a - c',              '');
$test('a * c',              '');
$test('a / c',              '');
