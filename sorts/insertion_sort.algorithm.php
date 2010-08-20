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

function insertion_sort($input, &$steps)
{
    $length = count($input);
    for ($i = 1; $i < $length; ++$i)
    {
        $value = $input[$i];
        $j = $i - 1;
        $done = false;
        do
        {
            if ($input[$j] > $value)
            {
                $input[$j + 1] = $input[$j];
                --$j;
                if ($j < 0)
                {
                    $done = true;
                }
            }
            else
            {
                $done = true;
            }
            
            ++$steps;
        }
        while ($done === false);

        $input[$j + 1] = $value;
    }

    return $input;
}

function iterative_insertion_sort($input, $i)
{
    $steps = 0;
    $length = count($input);
    if ($i < $length)
    {
        $value = $input[$i];
        $j = $i - 1;
        $done = false;
        do
        {
            if ($input[$j] > $value)
            {
                $input[$j + 1] = $input[$j];
                --$j;
                if ($j < 0)
                {
                    $done = true;
                }
            }
            else
            {
                $done = true;
            }

            ++$steps;
        }
        while ($done === false);

        $input[$j + 1] = $value;
    }

    return array('steps' => $steps, 'data' => $input);
}
