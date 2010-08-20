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

// Standard inclusions   
include("lib/pChart/pData.class");
include("lib/pChart/pChart.class");

// Setting display_errors to false is needed so that warnings do not
// cause the image to become corrupt.
ini_set('display_errors', false);

$encodedNumbers = filter_input(INPUT_GET, 'numbers', FILTER_SANITIZE_STRING);
$randomNumbers = json_decode($encodedNumbers);

// Dataset definition 
$DataSet = new pData;
$DataSet->AddPoint($randomNumbers,"Serie1");
$DataSet->AddAllSeries();


// Initialise the graph
$Test = new pChart(700,230);
$Test->setGraphArea(50,30,680,200);
$Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);
$Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);
$Test->drawGraphArea(255,255,255,TRUE);
$Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2,TRUE);
$Test->drawGrid(1,TRUE,230,230,230,50);

// Draw the 0 line
$Test->drawTreshold(0,143,55,72,TRUE,TRUE);

// Draw the bar graph
$Test->drawBarGraph($DataSet->GetData(),$DataSet->GetDataDescription(),TRUE,80);

header('Content-Type: image/png');

// Finish the graph
//$Test->drawLegend(596,150,$DataSet->GetDataDescription(),255,255,255);
$Test->drawTitle(50,22,"Example 12",50,50,50,585);
$Test->Render();
