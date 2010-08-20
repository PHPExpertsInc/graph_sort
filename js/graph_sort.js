var insert_iteration;
var view_iteration;
var total_steps;
var unsorted;

function iterationLoaded(algorithm)
{
    if (view_iteration[algorithm] < length)
    {
        $('#' + algorithm + '_next').attr("disabled", false);
    }
    //$('div#' + algorithm + '_box').scrollTo($('div#' + algorithm + '_box').width() * view_iteration, 0);
}

function doIteration(algorithm)
{
    ++insert_iteration[algorithm];
    var li;
    // 1. Get the partially-sorted numbers.
    //alert('sent: ' + numbers);
    jQuery.getJSON('sorter.php?algorithm=' + algorithm + '&numbers=' + $.toJSON(unsorted[algorithm]) + '&i=' + (insert_iteration[algorithm] - 1), function(json)
    { 
        unsorted[algorithm] = json.data;
         //$('#' + algorithm + '_next').attr("disabled", true);
        //alert('returned: ' + json);
        //alert('View Iteration: ' + total_steps[algorithm][1]);
        total_steps[algorithm][view_iteration[algorithm]] = json.steps + total_steps[algorithm][view_iteration[algorithm] - 1];
//        alert('Total steps: ' + total_steps[algorithm][view_iteration[algorithm]]);
        var jsonString = String(json.data);
        $('ul#' + algorithm + '_sort_steps').append('<li>' +
                                          '<div class="numbers">' + jsonString.replace(/,/g, ', ') + '</div>' + 
                                          '   <img onload="iterationLoaded(\'' + algorithm + '\')" width="700" height="230" src="graph_sort.php?numbers=' + $.toJSON(unsorted[algorithm]) + '"/>' + 
                                          '</li>');
        $('#' + algorithm + '_sort_iteration').html('Iteration: ' + view_iteration[algorithm] + '  <br/>Steps: ' + total_steps[algorithm][view_iteration[algorithm]]);
    
    });
}

$(document).ready(function()
{ 
    jQuery('.iteration-prev').bind('click', function()
    {
        var algorithm = $(this).attr('id').substr(0, $(this).attr('id').indexOf('_'));

        --view_iteration[algorithm];
        $('#' + algorithm + '_sort_iteration').html('Iteration: ' + view_iteration[algorithm] + '<br/>Steps: ' + total_steps[algorithm][view_iteration[algorithm]]);
        $('div#' + algorithm + '_box').scrollTo($('div#' + algorithm + '_box').width() * (view_iteration[algorithm] - 1), 0);

        $('#' + algorithm + '_next').attr("disabled", false);
        if (view_iteration[algorithm] == 1)
        {
            $('#' + algorithm + '_prev').attr("disabled", true);
        }
        return false;
    });

    jQuery('.iteration-next').bind('click', function()
    {
        var algorithm = $(this).attr('id').substr(0, $(this).attr('id').indexOf('_'));
        //alert(algorithm);
        
        if (insert_iteration == null)
        {
            unsorted = new Array();
            insert_iteration = new Array();
            view_iteration = new Array();
            total_steps = new Array();
        }
        
        if (!(algorithm in insert_iteration))
        {
            unsorted[algorithm] = numbers;
            insert_iteration[algorithm] = 1;
            view_iteration[algorithm] = 1;
            total_steps[algorithm] = new Array();
            total_steps[algorithm][1] = 0;
        }

        ++view_iteration[algorithm];
        $('#' + algorithm + '_sort_iteration').html('Iteration: ' + view_iteration[algorithm] + '<br/>Steps: ' + total_steps[algorithm][view_iteration[algorithm]]);

        $('#' + algorithm + '_prev').attr("disabled", false);
        if (view_iteration[algorithm] > insert_iteration[algorithm])
        {
            $('ul#' + algorithm + '_sort_steps').width((insert_iteration[algorithm] + 1) * $('div#' + algorithm + '_box').width());
            $('div#' + algorithm + '_box').scrollTo($('div#' + algorithm + '_box').width() * view_iteration[algorithm], 0);
            doIteration(algorithm);
        }
        else
        {
            $('div#' + algorithm + '_box').scrollTo($('div#' + algorithm + '_box').width() * (view_iteration[algorithm] - 1), 0);
        }
        
        if (false && view_iteration[algorithm] == length)
        {
            alert('boo');
            $('#' + algorithm + '_next').attr("disabled", true);
        }

        return false;
    });

});
