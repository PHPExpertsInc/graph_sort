<?php
/**
* User Directory
*   Copyright © 2008 Theodore R. Smith <theodore@phpexperts.pro>
* 
* The following code is licensed under a modified BSD License.
* All of the terms and conditions of the BSD License apply with one
* exception:
*
* 1. Every one who has not been a registered student of the "PHPExperts
*    From Beginner To Pro" course (http://www.phpexperts.pro/) is forbidden
*    from modifing this code or using in an another project, either as a
*    deritvative work or stand-alone.
*
* BSD License: http://www.opensource.org/licenses/bsd-license.php
**/

$algorithm = filter_input(INPUT_GET, 'algorithm', FILTER_SANITIZE_STRING);
$encodedNumbers = filter_input(INPUT_GET, 'numbers', FILTER_SANITIZE_STRING);
$numbers = json_decode($encodedNumbers);
$iteration = filter_input(INPUT_GET, 'i', FILTER_SANITIZE_NUMBER_INT);

if (isset($_GET['debug']))
{
    echo 'Original: ' . join(', ', $numbers);
}

//  Make sure the view file does not contain any inappropriate characters.
//  This is *vitally* important, as otherwise hackers would be able to arbitrarily
//  view any file on the system that your PHP process has access to, which would be bad.
if (preg_match('/[^\w\d._-]/', $algorithm) !== 0)
{
    trigger_error('Invalid algorithm name.', E_USER_ERROR);
}

$filename = "sorts/{$algorithm}_sort.algorithm.php";
if (file_exists($filename))
{
    require $filename;
    
    $sorter = "{$algorithm}_sort";
    $iterative_sorter = "iterative_{$algorithm}_sort";
    $partially_sorted = $iterative_sorter($numbers, $iteration);
    //$numbers = insertion_sort($numbers, $iteration);

    if (isset($_GET['debug']))
    {
        $steps = $total_steps = 0;
//        echo 'asdf';
        $sorted = $sorter($numbers, $steps);
        print '<div>All-at-once: (' . $steps . ') ' . join(', ', $sorted) . "</div>\n";
        print '<div>Step 0: ' . join(', ', $numbers) . "</div>\n";
        $i = 1;
        while ($numbers !== $sorted && $i <= 1000)
        {
            $numbers = $results = $iterative_sorter($numbers, $i);
            $steps = '?';
            if (isset($results['data']))
            {
                $numbers = $results['data'];
                $steps = $results['steps'];
                $total_steps += $steps;
            }

            print '<div>Iteration ' . $i . ': Steps: ' . $steps . ' (' . $total_steps . ') ['  . join(', ', $numbers) . "]</div>\n";
            
            ++$i;
        }
    }
}

echo json_encode($partially_sorted);