
$(document).ready(function () {

var $pagination = $('.select-page-number');
    var $lis = $pagination.find('a:not(.first, .last, .next, .previous)');
     $lis.filter('.paginate_button').hide();
    var idx = $lis.index($lis.filter('.paginate_active')) || 0;
    var total = $lis.filter('.paginate_button').length;
    var $toHighlight;
    if(idx - 2 < 0 ) $toHighlight = $lis.slice(idx, idx + 5);
    else if(idx + 3 > total) $toHighlight = $lis.slice(idx - 4, idx);
    else $toHighlight = $lis.slice(idx - 2, idx + 3);
    $toHighlight.addClass('showed')
    $lis.filter(".paginate_active").addClass('showed');
    $lis.filter('.showed').show();
    
});







