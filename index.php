<?php

require_once 'vendor/autoload.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

use ArrHelper\Arr;

$array = [
    [1, 2, 3, 4, 5],
    [
        [2, 4, 6, 7],
        [1, 2, 3],
    ],
    2, 4, 5
];

$newArr = Arr::with($array)->filterRecursive(function($value){
    return $value % 2 == 0;
})->map('print_r');
