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