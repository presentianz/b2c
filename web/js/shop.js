$(document).ready(function () {
        $('#gototop').click(function () {
            window.scrollTo(0, 0);
        });

    $('#myCarousel').carousel();
});



$(function() {
    $("img.lazy").lazyload({
        failure_limit : 99999, 
        effect : "fadeIn",
        threshold : 10
    });
});

$(document).ready(function () {
    var $pagination = $('.select-page-number');
    var $lis = $pagination.find('a:not(#prev, #next, .i-next, .i-prev)');
    $lis.filter(':lt(-6)').hide();
    $lis.filter(':gt(-5)').addClass('activee');

    
    var $next = $("#prev").click(function () {
        var idx = $lis.index($lis.filter('.activee:last')) || 0;
        
        var $toHighlight = $lis.slice(idx + 1, idx + 6);
        if ($toHighlight.length == 0) {
            $prev.show();
            return;
        }
        
        $next.show();        
        $lis.filter('.activee').removeClass('activee').hide();
        $toHighlight.show().addClass('activee')
    });
    
    var $prev = $("#next").click(function () {
        var idx = $lis.index($lis.filter('.activee:first')) || 0;
        
        var start = idx < 4 ? 0 : idx - 4;
        var $toHighlight = $lis.slice(start, start + 5);
        console.log($toHighlight);
        if ($toHighlight.length == 0) {
            $prev.hide();
            return;
        }      
        
        $next.show();

        $lis.filter('.activee').removeClass('activee').hide();
        $toHighlight.show().addClass('activee')
    });
    
}); // close jquery
















