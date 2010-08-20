<?php
function swap(&$input, $pos1, $pos2)
{
    $chr = $input[$pos1];
    $input[$pos1] = $input[$pos2];
    $input[$pos2] = $chr;
}

function bubble_sort($input, &$steps)
{
    $length = count($input);

    for ($x = 0; $x < $length; ++$x)
    {
        for ($y = 0; $y < $length; ++$y)
        {
            if ($input[$x] < $input[$y])
            {
                swap($input, $x, $y);
            }
            
            ++$steps;
        }
    }

    return $input;
}

function iterative_bubble_sort($input, $i)
{
    $steps = 0;

    $length = count($input);

    if ($i < $length)
    {
        $x = $i;
        for ($y = 0; $y < $length; ++$y)
        {
            if ($input[$x] < $input[$y])
            {
                swap($input, $x, $y);
            }
            
            ++$steps;
        }
    }   

    return array('steps' => (int)($steps), 'data' => $input);
}