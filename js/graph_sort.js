function iterationLoaded(algorithm)
{
    if (viewed_iteration < length)
    {
        $('#' + algorithm + '_next').attr("disabled", false);
    }
    //$('div#' + algorithm + '_box').scrollTo($('div#' + algorithm + '_box').width() * viewed_iteration, 0);
}

function doIteration(algorithm)
{
    ++insert_iteration;
    var li;
    // 1. Get the partially-sorted numbers.
    //alert('sent: ' + numbers);
    jQuery.getJSON('sorter.php?algorithm=insertion&numbers=' + $.toJSON(numbers) + '&i=' + (insert_iteration - 1), function(json)
    { 
        numbers = json;
        //alert('returned: ' + json);
        var jsonString = String(json);
        $('ul#' + algorithm + '_sort_steps').append('<li>' +
                                          '<div class="numbers">' + jsonString.replace(/,/g, ', ') + '</div>' + 
                                          '   <img onload="iterationLoaded(\'' + algorithm + '\')" width="700" height="230" src="graph_sort.php?numbers=' + $.toJSON(json) + '"/>' + 
                                          '</li>');
    
    });
}

$(document).ready(function()
{ 
    jQuery('.iteration-prev').bind('click', function()
    {
        var algorithm = $(this).attr('id').substr(0, $(this).attr('id').indexOf('_'));

        --viewed_iteration;
        $('#' + algorithm + '_sort_iteration').text('Iteration: ' + viewed_iteration);
        $('div#' + algorithm + '_box').scrollTo($('div#' + algorithm + '_box').width() * (viewed_iteration - 1), 0);

        $('#' + algorithm + '_next').attr("disabled", false);
        if (viewed_iteration == 1)
        {
            $('#' + algorithm + '_prev').attr("disabled", true);
        }
        return false;
    });

    jQuery('.iteration-next').bind('click', function()
    {
        var algorithm = $(this).attr('id').substr(0, $(this).attr('id').indexOf('_'));
        //alert(algorithm);

        ++viewed_iteration;
        $('#' + algorithm + '_prev').attr("disabled", false);
        if (viewed_iteration > insert_iteration)
        {
            $('#' + algorithm + '_next').attr("disabled", true);
            $('ul#' + algorithm + '_sort_steps').width((insert_iteration + 1) * $('div#' + algorithm + '_box').width());
            $('div#' + algorithm + '_box').scrollTo($('div#' + algorithm + '_box').width() * viewed_iteration, 0);
            doIteration(algorithm);
        }
        else
        {
            $('div#' + algorithm + '_box').scrollTo($('div#' + algorithm + '_box').width() * (viewed_iteration - 1), 0);
        }

        $('#' + algorithm + '_sort_iteration').text('Iteration: ' + viewed_iteration);

        return false;
    });

});
