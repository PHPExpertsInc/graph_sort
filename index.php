<?php

// Initialize random data.
$randomNumbers = array();
for ($a = 0; $a <= 50; ++$a)
{
    $randomNumbers[] = rand(-50, 200);
}

/** DEBUG 
header('Content-Type: text/plain');
print_r($randomNumbers);
exit;
**/

$encodedNumbers = base64_encode(json_encode($randomNumbers));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
    <head>
        <title>Graph Sort | PHPExperts.pro</title>
        <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="js/jquery.json-2.2.min.js"></script>
        <script type="text/javascript" src="js/jquery.base64-1.0.0.min.js"></script>
        <script type="text/javascript">
var numbers = jQuery.parseJSON('<?php echo json_encode($randomNumbers); ?>');
var insert_iteration = 0;
$(document).ready(function() { 
    $('#insertion_sort_steps').click(function()
    {
        ++insert_iteration;
        var li;
        // 1. Get the partially-sorted numbers.
        alert(numbers);
        jQuery.getJSON('sorter.php?algorithm=insertion&numbers=' + $.base64Encode($.toJSON(numbers)) + '&i=' + insert_iteration, function(json)
        { 
            alert(json);
            //alert($.base64Encode($.toJSON(numbers)));

            $('#insertion_sort_steps').prepend('<li>' +
                                               '   <div class="numbers">' + json + '</div>' +
                                               '   <img src="graph_sort.php?numbers=' + $.base64Encode($.toJSON(json)) + '"/>' + 
                                               '</li>');
        });

    });
});
        </script>
        <style type="text/css">
div.sortgraphs
{
    width: 742px;
    overflow: auto;
}
ol#insertion_sort_steps
{
    padding: 0;
    margin: 0;
    list-style-type: none;
    width: 750px;
}

ol#insertion_sort_steps li
{
    padding: 0;
    margin: 0;
    text-indent: 0;
    border: 1px solid black; padding: 10px;
    width: 720px;
    float: left;
}

div.numbers { width: 720px; }
        </style>
    </head>
    <body>
        <h1>Graph Sort</h1>
        <h2>Visualizing sorting algorithms</h2>
        <p>This app helps you <strong>*see*</strong> how a sort algorithm works, step by step.</p>
        <h3>Insertion Sort</h3>
        <div class="sortgraphs">
            <ol id="insertion_sort_steps" start="0">
                <li>
                    <div class="numbers">
                        Initial: <?php echo join(', ', $randomNumbers); ?><br/>
                    </div>
                    <img width="700" height="230" src="graph_sort.php?numbers=<?php echo $encodedNumbers; ?>"/>
                </li>
            </ol>
        </div>
    </body>
</html>