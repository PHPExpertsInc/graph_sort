<?php

function quick_sort($input, &$steps)
{
    $length = count($input);
    if ($length < 2) return $input;
 
    $left = $right = array();
 
    reset($input);
    $pivot_key = key($input);
    $pivot = array_shift($input);
 
    for ($i = 0; $i < $length - 1; ++$i)
    {
        $v = $input[$i];
        $k = $i;

        if ($v < $pivot)
        {
            $left[$k] = $v;
        }
        else
        {
            $right[$k] = $v;
        }
        
        ++$steps;
    }

    return array_merge(quick_sort($left, $steps), array($pivot_key => $pivot), quick_sort($right, $steps));
}

// Non recursive version:
function iterative_quick_sort($input, $i)
{
    $steps = 0;
    
    $hash = md5(join(',', $input));
    if (is_null($pivots))
    {
        $pivots = array();
    }

    $unsorted = $input;
    $length = count($input);
/*
    do
    {
        $pivot_key = rand(0, $length - 1);
        ++$steps;
    }
    while (isset($pivots[$pivot_key]));
    $pivots[$pivot_key] = true;
*/


    // NOTE: Manually finding the pivot is a necessary evil of the
    //       iteractive approach, so we are not counting its steps.
    $a = 0;
    do
    {
        $pivot = $a;
        ++$a;
    }
    while ((int)$unsorted[$a] <= (int)$unsorted[$a + 1]);

    $pivot_key = $a + 1;
    $pivot = $input[$pivot_key];
    
    if (isset($_GET['debug']))
    {
        echo "<div>Pivot key: $pivot_key | Pivot: $pivot </div>\n";
    }

    // Remove pivot
    unset($unsorted[$pivot_key]);

    $left = $right = array();
    $right[] = $pivot;
    foreach ($unsorted as $value)
    {
        if ($value == -50)
        {
    //        echo "<h1>-50 found!!</h1>\n";
        }
        if ((int)$value < (int)$pivot)
        {
            $left[] = $value;
        }
        else
        {
            $right[] = $value;
        }
        
        ++$steps;
    }
    
    // NOTE: recursive bubble sort is 2x as efficient, so we're going to correct it here.
    return array('steps' => (int)($steps / 2), 'data' => array_merge($left, $right));
}