<?php

function insertion_sort($input)
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
        }
        while ($done === false);

        $input[$j + 1] = $value;
    }

    return $input;
}

function iterative_insertion_sort($input, $i)
{
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
        }
        while ($done === false);

        $input[$j + 1] = $value;
    }

    return $input;
}
