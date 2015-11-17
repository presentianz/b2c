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

    $("#bookmarkme").click(function(e) {
        e.preventDefault();
        try
        {
            window.external.addFavorite(location.href,document.title);
        }
        catch (e)
        {
            try
            {
                window.sidebar.addPanel(location.href,document.title,"");
            }
            catch (e)
            {
                alert("抱歉，您所使用的浏览器无法完成此操作。\n\n加入收藏失败，请使用Ctrl+D进行添加");
            }
        }
    });
});

$(function() {
    $(".cart-wrapper").hover(function(e) {
    e.preventDefault();
    $this = $(this);
     $.ajax({
        url: $this.attr("data-path"),
        method: "GET",
        dataType: "json"
    })
     .done(function (rep) {
        var num = 0;
        var total = 0;
        console.log(rep);
        if(rep !== "none" ) {
         $.each(rep, function(id, value){
           $("#name_" + id).html(value.name);
           $("#count_" + id).html("x" + value.count);
           $("#price_" + id + " strong").html("$" + value.price_discounted);
           num = num + Number(value.count);
           total = Math.round((total + parseInt(value.count) * Number(value.price_discounted))*100)/100;
         });
         $("#total-number").html(num);
          $("#total").html('$' +total);
         
     } else {
        $(".total").html("您的购物车为空！");
     }
     $(".cart-list").show();
     })
 }, function(e) {
    e.preventDefault();
    $(".cart-list").hide();

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
                 window.location.reload();
                 setTimeout(function() {
                    $("#loading").css("display", "none");
                },2000);
                 
            }
            else {
                location.reload(true);
                alert(": (");
            }
        })
})
});
















