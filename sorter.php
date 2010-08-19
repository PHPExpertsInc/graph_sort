<?php

$algorithm = filter_input(INPUT_GET, 'algorithm', FILTER_SANITIZE_STRING);
$encodedNumbers = filter_input(INPUT_GET, 'numbers', FILTER_SANITIZE_STRING);
$numbers = json_decode(base64_decode($encodedNumbers));
$iteration = filter_input(INPUT_GET, 'i', FILTER_SANITIZE_NUMBER_INT);

if ($algorithm == 'insertion')
{
    require 'sorts/insertion_sort.algorithm.php';
    
    $numbers = iterative_insertion_sort($numbers, $iteration);
}

echo json_encode($numbers);