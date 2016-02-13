

$(document).ready(function () {

var $pagination = $('.select-page-number');
    var $lis = $pagination.find('a:not(.first, .last, .next, .previous)');
     $lis.filter('.paginate_button').hide();
    var idx = $lis.index($lis.filter('.paginate_active')) || 0;
    var total = $lis.filter('.paginate_button').length;
    var $toHighlight;
    if(idx <= 0 ) {
        $toHighlight = $lis.slice(idx, idx + 5);
        $pagination.find('a.first').filter('.paginate_button').hide();
        $pagination.find('a.previous').filter('.paginate_button').hide();        
    } 
    else if(idx == 1 ) $toHighlight = $lis.slice(idx - 1, idx + 4);
    else if(idx + 2 == total) $toHighlight = $lis.slice(idx -3, idx + 2 );
    else if(idx + 1 >= total) {
        $toHighlight = $lis.slice(idx - 4, idx + 3 );
        $pagination.find('a.next').filter('.paginate_button').hide();
        $pagination.find('a.last').filter('.paginate_button').hide();   
    } 
    else $toHighlight = $lis.slice(idx - 2, idx + 3);  
    $toHighlight.addClass('showed')
    $lis.filter(".paginate_active").addClass('showed');
    $lis.filter('.showed').show();
    
});







