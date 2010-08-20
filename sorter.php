<?php

$algorithm = filter_input(INPUT_GET, 'algorithm', FILTER_SANITIZE_STRING);
$encodedNumbers = filter_input(INPUT_GET, 'numbers', FILTER_SANITIZE_STRING);
$numbers = json_decode(base64_decode($encodedNumbers));
$iteration = filter_input(INPUT_GET, 'i', FILTER_SANITIZE_NUMBER_INT);

if (isset($_GET['debug']))
{
    echo 'Original: ' . base64_decode($encodedNumbers);
}

if ($algorithm == 'insertion')
{
    require 'sorts/insertion_sort.algorithm.php';
    
    $partially_sorted = iterative_insertion_sort($numbers, $iteration);
    //$numbers = insertion_sort($numbers, $iteration);
    
    if (isset($_GET['debug']))
    {
//        echo 'asdf';
        print '<pre>All-at-once: ' . join(', ', insertion_sort($numbers)) . "\n";
        print 'Step 0: ' . join(', ', numbers) . "\n";
        $i = 1;
        while ($i < count($numbers))
        {
            $numbers = iterative_insertion_sort($numbers, $i);
            print 'Step ' . $i . ': All-at-once: ' . join(', ', $numbers) . "\n";
            
            ++$i;
        }
    }
}

echo json_encode($partially_sorted);