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

function marriage_sort($input, &$steps)
{
    $end = count($input);

    while (true)
    {
        $skip = round(sqrt($end), 0) - 1;
//        echo "Skip: $skip\n";
        if ($skip <= 0) { break; }

        // Pick the best element in the first vN - 1.
        $bestPos = 0;
        $i = 1;
        while ($i < $skip)
        {
            if ($input[$i] > $input[$bestPos])
            {
                $bestPos = $i;
            }

            ++$i;
            ++$steps;
        }

        // Now pull out elements >= $input[$bestPos] and move to the end.
        $i = $skip;
        while ($i < $end)
        {
            if ($input[$i] >= $input[$bestPos])
            {
                swap($input, $i, $end - 1);
                --$end;
            }
            else
            {
                ++$i;
            }
            
            ++$steps;
        }

        // Finally, move our best pivot element to the end.
        swap($input, $bestPos, $end - 1);
    }

    return $input;
}

function iterative_marriage_sort($input, $i)
{
    $steps = 0;
    $end = count($input);

    if (true)
    {
        $skip = round(sqrt($end), 0) - 1;
//        echo "Skip: $skip\n";
        if ($skip <= 0) { break; }

        // Pick the best element in the first vN - 1.
        $bestPos = 0;
        $i = 1;
        while ($i < $skip)
        {
            if ($input[$i] > $input[$bestPos])
            {
                $bestPos = $i;
            }

            ++$i;
            ++$steps;
        }

        // Now pull out elements >= $input[$bestPos] and move to the end.
        $i = $skip;
        while ($i < $end)
        {
            if ($input[$i] >= $input[$bestPos])
            {
                swap($input, $i, $end - 1);
                --$end;
            }
            else
            {
                ++$i;
            }
            
            ++$steps;
        }

        // Finally, move our best pivot element to the end.
        swap($input, $bestPos, $end - 1);
    }

    return array('steps' => (int)($steps/2), 'data' => $input);
}
