<?php

// Initialize random data.
$encodedNumbers = filter_input(INPUT_GET, 'numbers', FILTER_SANITIZE_STRING);
if ($encodedNumbers == '')
{
    $randomNumbers = array();
    for ($a = 0; $a <= 10; ++$a)
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

function constructSortWidget($algorithm, $label)
{
    global $randomNumbers, $encodedNumbers;
?>
        <h3><?php echo $label; ?> Sort</h3>
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
    echo constructSortWidget('bubble', 'Bubble');
    echo constructSortWidget('insertion', 'Insertion');
    echo constructSortWidget('quick', 'Quick');
    echo constructSortWidget('marriage', 'Marriage');
?>
        <p style="margin-top: 50px">
            <a href="http://validator.w3.org/check?uri=referer"><img
                src="http://www.w3.org/Icons/valid-xhtml10"
                alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>
        </p>  
    </body>
</html>