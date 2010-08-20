function iterationLoaded()
{
    $('#mycarousel-next').attr("disabled", false);
    $('div.sortgraphs').scrollTo($('div.sortgraphs').width() * viewed_iteration, 0);
}

function doInsertionIteration()
{
    ++insert_iteration;
    var li;
    // 1. Get the partially-sorted numbers.
    //alert('sent: ' + numbers);
    jQuery.getJSON('sorter.php?algorithm=insertion&numbers=' + $.toJSON(numbers) + '&i=' + (insert_iteration - 1), function(json)
    { 
        numbers = json;
        //alert('returned: ' + json);
        $('ul.sortgraphs').width(insert_iteration * $('div.sortgraphs').width());
        var jsonString = String(json);
        $('#insertion_sort_steps').append('<li>' +
                                          '<div class="numbers">' + jsonString.replace(/,/g, ', ') + '</div>' + 
                                          '   <img onload="iterationLoaded()" width="700" height="230" src="graph_sort.php?numbers=' + $.toJSON(json) + '"/>' + 
                                          '</li>');
    
    });
}

$(document).ready(function() { 
    jQuery('.iteration-prev').bind('click', function() {
        --viewed_iteration;
        $('#insertion_sort_iteration').text('Iteration: ' + viewed_iteration);
        $('div.sortgraphs').scrollTo($('div.sortgraphs').width() * (viewed_iteration - 1), 0);
        
        if (viewed_iteration == 1)
        {
            $('#mycarousel-prev').attr("disabled", true);
        }
        return false;
    });

    jQuery('.iteration-next').bind('click', function() {
        //alert($(this).attr('algorithm'));
        ++viewed_iteration;
        $('#mycarousel-prev').attr("disabled", false);
        if (viewed_iteration > insert_iteration)
        {
            $('#mycarousel-next').attr("disabled", true);
            doInsertionIteration();
            
        }
        else
        {
            $('div.sortgraphs').scrollTo($('div.sortgraphs').width() * (viewed_iteration - 1), 0);
        }
        
        if (viewed_iteration == length)
        {
            $('#mycarousel-next').attr("disabled", true);
        }

        $('#insertion_sort_iteration').text('Iteration: ' + viewed_iteration);

        return false;
    });

});
