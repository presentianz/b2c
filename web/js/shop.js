$(document).ready(function () {

    $('#myCarousel').carousel();
    $('#gototop').click(function () { $('html, body').animate({
        scrollTop: 0
    }, 800); });


    var $pagination = $('.select-page-number');
    var $lis = $pagination.find('a:not(#prev, #next, .i-next, .i-prev)');
    $lis.filter('.page').hide();
    var idx = $lis.index($lis.filter('.active')) || 0;
    var total = $lis.filter('.page').length;
    var $toHighlight;
    if(idx - 2 < 0 ) $toHighlight = $lis.slice(idx, idx + 5);
    else if(idx + 3 > total) $toHighlight = $lis.slice(idx - 4, idx);
    else $toHighlight = $lis.slice(idx - 2, idx + 3);
    $toHighlight.addClass('show')
    $lis.filter(".active").addClass('show');
    $lis.filter('.show').show();
    

    var $prev = $("#next").click(function () {
        var idx = $lis.index($lis.filter('.show:first')) || 0;
        var start =  idx - 5;
        var $toHighlight = $lis.slice(start, start + 5);
        if ($toHighlight.length == 0) {
            $prev.hide();
            return;
        }           
        $next.show();

        $lis.filter('.show').removeClass('show').hide();
        $toHighlight.show().addClass('show')
    });

    
    var $next = $("#prev").click(function () {
        var idx = $lis.index($lis.filter('.show:last')) || 0;      
        var $toHighlight = $lis.slice(idx + 1, idx + 6);
        if ($toHighlight.length == 0) {
            $prev.show();
            return;
        }
        
        $next.show();        
        $lis.filter('.show').removeClass('show').hide();
        $toHighlight.show().addClass('show')
    });

    
}); // close jquery


$(function() {
    $("img.lazy").lazyload({
        failure_limit : 99999, 
        effect : "fadeIn",
        threshold : 10
    });

});

$(function() {
    $(".hover-action").hover(function(e) {
    e.preventDefault();
    $this = $(this);
    //  $.ajax({
    //     url: $this.attr("data-path"),
    //     method: "GET",
    //     data: {
    //         id : $this.attr("id"),
    //         action : $this.attr("data-action"),
    //     },
    //     dataType: "json"
    // })
    //  .done(function (rep) {
    //      console.log("seccuss");
    //  });
 });

    $('.cart-remove-button').click(function (e) {
        e.preventDefault();
        $this = $(this);
         $("#loading").css("display", "block");
        $.ajax({
            url: $this.attr("data-path"),
            method: "POST",
            data: {
                id : $this.attr("data-id"),
                action : $this.attr("data-action"),
                no : $this.attr("data-no")
            },
            dataType: "json"
        })
        .done(function (rep) {
            if (rep.granted) {
                 $("#loading").css("display", "none");
                 $("#"+ $this.attr("data-id")).css("display","none");
                alert("removed");
            }
            else {
                $("#"+ $this.attr("data-id")).css("display","block");
                location.reload(true);
                alert(": (");
            }
        })
})
});
















