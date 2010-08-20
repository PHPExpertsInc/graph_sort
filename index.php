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

// Initialize random data.
$encodedNumbers = filter_input(INPUT_GET, 'numbers', FILTER_SANITIZE_STRING);
$length = filter_input(INPUT_GET, 'length', FILTER_SANITIZE_NUMBER_INT);

if ($length == '')
{
    $length = 10;
}

if ($encodedNumbers == '')
{
    $randomNumbers = array();
    for ($a = 0; $a <= $length; ++$a)
    {
        $randomNumbers[] = rand(-50, 200);
    }
}
else
{
    $randomNumbers = json_decode($encodedNumbers);
}

/** DEBUG 
header('Content-Type: text/plain');
print_r($randomNumbers);
exit;
**/

$encodedNumbers = json_encode($randomNumbers);

function constructSortWidget($algorithm, $description)
{
    global $randomNumbers, $encodedNumbers;
?>
        <h3><?php echo ucfirst($algorithm); ?> Sort</h3>
        <p class="description"><?php echo nl2br($description); ?></p>
        <div id="<?php echo $algorithm; ?>_sort_iteration">Iteration: 1<br/>Steps: 0</div>
        <div class="sortgraphs" id="<?php echo $algorithm; ?>_box">
            <ul class="sortgraphs" id="<?php echo $algorithm; ?>_sort_steps">
                <li>
                    <div class="numbers"><?php echo join(', ', $randomNumbers); ?></div>
                    <img alt="graph of numbers" width="700" height="230" src="graph_sort.php?numbers=<?php echo $encodedNumbers; ?>"/>
                </li>
            </ul>
        </div>
        <div class="controls">
            <div class="prev"><button class="iteration-prev" id="<?php echo $algorithm; ?>_prev" disabled="disabled">&laquo; Prev</button></div>
            <div class="next"><button class="iteration-next" id="<?php echo $algorithm; ?>_next">Next &raquo;</button></div>
        </div>
<?php
}

?>
<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
    <head>
        <title>Graph Sort | PHPExperts.pro</title>
        <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="js/jquery.scrollTo-min.js"></script>
        <script type="text/javascript" src="js/jquery.json-2.2.min.js"></script>
        <script type="text/javascript" src="js/graph_sort.js"></script>
        <script type="text/javascript">
var numbers = jQuery.parseJSON('<?php echo json_encode($randomNumbers); ?>');
var length = <?php echo count($randomNumbers); ?>;
        </script>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
    </head>
    <body>
        <h1>Graph Sort</h1>
        <h2>Visualizing sorting algorithms</h2>
        <p>This app helps you <strong>*see*</strong> how a sort algorithm works, step by step.</p>
<?php
    echo constructSortWidget('bubble', 'Bubble Sort is considered one of the least efficient sorting algorithms.  All it does is compare each element, one at a time, with every other element, and if that is bigger than the comparison, it swaps them. It has a performance rating of O(n<sup>2</sup>), meaning that if you have 100 elements, it will take 10,000 (100*100) steps to sort them.');
    echo constructSortWidget('insertion', 'Insertion Sort is a moderately efficient sorting algorithm. If the data is partially sorted, it can be quite fast. If it is totally random, it can take up to O(n<sup>2</sup>) but averages O(n<sup>1.5</sup>).  On average, it would take 1,000 - 2,800 passes to sort 100 elements.');    echo constructSortWidget('quick', 'QuickSort is one of the most efficient sorting algorithm.  It averages O(n * log n).  On average, it would take 500 - 1,000 passes to sort 100 elements.');
    echo constructSortWidget('marriage', 'Marriage Sort is a highly efficient indeterminate sorting algorithm.  It is indeterminate because a fully sorted array is never guaranteed. Like real life, elements search, one by one, for "better" (higher valued) elements, stopping once they get a good one and no much better ones are seen over the horizon.  At its worse, it is O(n<sup>1.5</sup>) but it can achieve much better results far faster than even quicksort, independently of how random the elements are.  On average, it would take 200 - 700 passes to get a 75% sorted array.  Using an algorithm that works well with semi-sorted arrays (such as Insertion Sort) will then provide fully sorted arrays at just over the efficiency of QuickSort.  However, Marriage Sort is by far one of the best algorithms yet invented when the number and/or values of elements are dynamic (adding and subtracting).');
?>
        <p style="margin-top: 50px">
            <a href="http://validator.w3.org/check?uri=referer"><img
                src="http://www.w3.org/Icons/valid-xhtml10"
                alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>
        </p>  
    </body>
</html>