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
    $randomNumbers = json_decode(base64_decode($encodedNumbers));
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
        <!--<script type="text/javascript" src="js/jquery-ui-1.8.4.custom.min.js"></script>-->
        <script type="text/javascript" src="js/jquery.scrollTo-min.js"></script>
        <script type="text/javascript" src="js/jquery.json-2.2.min.js"></script>
        <script type="text/javascript" src="js/jquery.base64-1.0.0.min.js"></script>        
        <!--<script type="text/javascript" src="js/jquery.jcarousel.min.js"></script>-->
        <script type="text/javascript">
var numbers = jQuery.parseJSON('<?php echo json_encode($randomNumbers); ?>');
var insert_iteration = 1;
var viewed_iteration = 1;
var g_carousel;

function iterationLoaded()
{
//    alert('yes!');
    $('#mycarousel-next').attr("disabled", false);
    $('div.sortgraphs').scrollTo($('div.sortgraphs').width() * viewed_iteration, 0);
 //   g_carousel.scroll(viewed_iteration);
//    $('#mycarousel').scroll();
//    g_carousel.next();
}

function doInsertionIteration()
{
    ++insert_iteration;
    var li;
    // 1. Get the partially-sorted numbers.
//    alert(numbers);
    jQuery.getJSON('sorter.php?algorithm=insertion&numbers=' + $.base64Encode($.toJSON(numbers)) + '&i=' + (insert_iteration), function(json)
    { 
        //$('#mycarousel').width((insert_iteration + 1) * $('#mycarousel').width());
        //alert('mycarousel: ' + $('#mycarousel').width());
//        $('#insertion_sort_steps').width(insert_iteration * $('#insertion_sort_steps').width());
        $('ul.sortgraphs').width(insert_iteration * $('div.sortgraphs').width());
        //alert('insertion_sort_steps: ' + $('#insertion_sort_steps').width());//        alert(json);
        //alert($.base64Encode($.toJSON(numbers)));
        var jsonString = String(json);
        alert("i: " + (insert_iteration) + ": " + json);
        $('#insertion_sort_steps').append('<li>' +
                                          '<div class="numbers">' + jsonString.replace(/,/g, ', ') + '</div>' + 
                                          '   <img onload="iterationLoaded()" width="700" height="230" src="graph_sort.php?numbers=' + $.base64Encode($.toJSON(json)) + '"/>' + 
                                          '</li>');
    
    });
}


$(document).ready(function() { 
/*
    jQuery("#mycarousel").jcarousel({
        scroll: 1,
        initCallback: mycarousel_initCallback,
        // This tells jCarousel NOT to autobuild prev/next buttons
        buttonNextHTML: null,
        buttonPrevHTML: null
    });
*/

    jQuery('#mycarousel-prev').bind('click', function() {
        --viewed_iteration;
        $('#insertion_sort_iteration').text('Iteration: ' + viewed_iteration);
        $('div.sortgraphs').scrollTo($('div.sortgraphs').width() * (viewed_iteration - 1), 0);
        return false;
    });

    jQuery('#mycarousel-next').bind('click', function() {
        ++viewed_iteration;
        if (viewed_iteration > insert_iteration)
        {
            $('#mycarousel-next').attr("disabled", true);
            doInsertionIteration();
            
        }
        else
        {
            $('div.sortgraphs').scrollTo($('div.sortgraphs').width() * viewed_iteration, 0);
        }
        $('#insertion_sort_iteration').text('Iteration: ' + viewed_iteration);

        return false;
    });

});
        </script>
        <style type="text/css">
div.sortgraphs
{
    width: 742px;
    overflow: auto;
}
ul.sortgraphs
{
    padding: 0;
    margin: 0;
    list-style-type: none;
    width: 750px;
}

ul.sortgraphs li
{
    padding: 0;
    margin: 0;
    text-indent: 0;
    border: 1px solid black; padding: 10px;
    width: 720px;
    float: left;
}

div.numbers { width: 720px; }

.jcarousel-control {
    margin-bottom: 10px;
    text-align: center;
}
 
.jcarousel-control a {
    font-size: 75%;
    text-decoration: none;
    padding: 0 5px;
    margin: 0 0 5px 0;
    border: 1px solid #fff;
    color: #eee;
    background-color: #4088b8;
    font-weight: bold;
}
 
.jcarousel-control a:focus,
.jcarousel-control a:active {
    outline: none;
}
 
.jcarousel-scroll {
    margin-top: 10px;
    text-align: center;
}
 
.jcarousel-scroll form {
    margin: 0;
    padding: 0;
}
 
.jcarousel-scroll select {
    font-size: 75%;
}
 
#mycarousel-next,
#mycarousel-prev {
    cursor: pointer;
    margin-bottom: -10px;
    text-decoration: underline;
    font-size: 11px;
}
        </style>
    </head>
    <body>
        <h1>Graph Sort</h1>
        <h2>Visualizing sorting algorithms</h2>
        <p>This app helps you <strong>*see*</strong> how a sort algorithm works, step by step.</p>
        <h3>Insertion Sort</h3>
        <div id="insertion_sort_iteration">Iteration: 1</div>
        <div class="sortgraphs" id="mycarousel">
<!--            <div class="jcarousel-control"> 
                <a href="#">1</a> 
                <a href="#">2</a> 
                <a href="#">3</a> 
                <a href="#">4</a> 
                <a href="#">5</a> 
                <a href="#">6</a> 
                <a href="#">7</a> 
                <a href="#">8</a> 
                <a href="#">9</a> 
                <a href="#">10</a> 
            </div> -->
            <ul class="sortgraphs" id="insertion_sort_steps">
                <li>
                    <div class="numbers"><?php echo join(', ', $randomNumbers); ?></div>
                    <img width="700" height="230" src="graph_sort.php?numbers=<?php echo $encodedNumbers; ?>"/>
                </li>
            </ul>
        </div>
        <div style="width: 740px">
            <div style="float: left"><button id="mycarousel-prev">&laquo; Prev</button></div>
            <div style="float: right"><button id="mycarousel-next">Next &raquo;</button></div>
        </div>
    </body>
</html>