$(document).ready(function () {

    $('#myCarousel').carousel();
    $('#brandslider').carousel();

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

    $("#more-brand").click( function(){
        $(".brand-list .side-content").toggleClass("brand-height");
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


//hover cart
$(function() {

    //    $('.add-review').click(function (e) {
    //     e.preventDefault();
    //     $this = $(this);
    //     var productId = $this.attr("id");
    //     console.log("+++++");
    //     $.ajax({
    //         url: $this.attr("data-path"),
    //         method: "POST",
    //         dataType: "json"
    //     })
    //     .done(function (rep) {
    //        // window.location.href=Routing.generate('product') + "/" + $this.attr("data-id");
           
    //     })

    // });

     $('.continue-shop').click(function() {
        $('.bg-mask').css('display','none');
        $('.pop-cart').css('display','none');
    });

    $(".cart-wrapper").hover(function(e) {
        e.preventDefault();
        $this = $(this);
        console.log("try");
        if($this.attr('data-hovered') == 'unhovered'){
            $this.attr('data-hovered','hovered');
            $.ajax({
                url: $this.attr("data-path"),
                method: "GET",
                dataType: "json"
            })
            .done(function (rep) {
                var num = 0;
                var total = 0;
                var innerHtml="";
                innerHtml += "<i class=\"cart-block-row\"></i>";
                if (rep !== 'none') {
                    $.each(rep, function(index, value) {
                        innerHtml += "<div class=\"item\">";
                        innerHtml += "<div class=\"cart-image\">";
                        innerHtml += "<img class=\"lazy\" src=\""+ assetsBaseDir + "\/img\/src\/" + value.imageLink + "\/poster\/" + value.poster +"\" alt=\"\">";
                        innerHtml += "<\/div>";
                        innerHtml += "<div class=\"nav-cart-content\">";
                        innerHtml += "<h5 id=\"name_"+index+"\">"+value.name+"<\/h5>";
                        innerHtml += "<span id=\"price_"+index+"\"><strong>$"+value.price_discounted+"<\/strong><\/span>";
                        innerHtml += "<span id=\""+index+"\">×"+value.count+"<\/span>";
                        innerHtml += "<span class=\"remove\"><a class=\"cart-remove-button\" data-path=\""+Routing.generate('cart_ajax_action')+"\" data-id=\""+index+"\" data-action=\"rm\" href=\"#\">删除<\/a><\/span>";
                        innerHtml += "<\/div>";
                        innerHtml += "<\/div>";
                        num += Number(value.count);
                        total = Math.round((total + parseInt(value.count) * Number(value.price_discounted))*100)/100;
                    });
                        innerHtml += "<div class=\"total\">";
                        innerHtml += "<span>共<strong id=\"total-number\">"+num+"<\/strong>件商品<\/span>";
                        innerHtml += "<span>共计<strong id=\"total\">$"+total+"<\/strong><\/span>";
                        innerHtml += "<\/div>";
                        innerHtml += "<form action=\""+Routing.generate('cart')+"\" method=\"get\" onsubmit=\"\">";
                        innerHtml += "<input type=\"submit\"  value=\"结算\">";
                        innerHtml += "<\/form>";
                    }
                    else {
                    innerHtml += "<div class=\"total\">";
                    innerHtml += "您的购物车为空！";
                    innerHtml += "<\/div>";
                    }

                    $('.cart-list').html(innerHtml);
                })
            }
            $(".cart-list").show();
            },
            function(e) {
                e.preventDefault();
                $(".cart-list").hide();
            });


    $("#history-view").hover(function(e) {
        e.preventDefault();
        $this = $(this);
        $("#history-view").css("background-color","#fff");
        if($this.attr('data-hovered') == 'unhovered'){
            $this.attr('data-hovered','hovered');
            $.ajax({
                url: Routing.generate('recent_view_ajax_get'),
                method: "POST",
                dataType: "json"
            })
            .done(function (rep) {
                var innerHtml="";
                if (rep !== 'none') {
                    innerHtml += "<div class=\"sub-list\">";
                    $.each(rep, function(index, value) {
                        innerHtml += "<a href=\""+Routing.generate('product',{id:value.id})+"\">";
                        innerHtml += "<div class=\"item\">";
                        innerHtml += "<div class=\"cart-image\">";
                        innerHtml += "<img class=\"lazy\" src=\""+ assetsBaseDir +"\/img\/src\/" + value.imageLink + "\/poster\/" + value.poster +"\" alt=\"\">";
                        innerHtml += "<\/div>";
                        innerHtml += "<div class=\"nav-cart-content\">";
                        innerHtml += "<div><h5 id=\"viewname_"+index+"\">"+value.name+"<\/h5><\/div>";
                        innerHtml += "<div><span id=\"viewprice_"+index+"\"><strong>$"+value.price_discounted+"<\/strong><\/span><\/div>";
                        innerHtml += "<\/div>";
                        innerHtml += "<\/div>";
                        innerHtml += "<\/a>";
                        innerHtml += "<hr style=\"margin:0;\">";
                        
                    });
                        innerHtml += "<\/div>";
                        innerHtml += "<div class=\"history-clear\">";
                        innerHtml += "<a href=\"#\"><h6>删除浏览记录<\/h6><\/a>";
                        innerHtml += "<\/div>";
                    }
                    else {
                    innerHtml += "<div class=\"total\">";
                    innerHtml += "您的浏览记录为空！";
                    innerHtml += "<\/div>";
                    }

                    $('.history-view').html(innerHtml);
                })
            }
            
        $(".history-view").show();
        },
        function(e) {
            e.preventDefault();
            $("#history-view").css("background","transparent");
            $(".history-view").hide();
        });

//cart delete
$('.cart-list').on('click', '.cart-remove-button', function (e) {
    e.preventDefault();
    $this = $(this);
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
                //price update...
                var number = Number($("#total-number").html());
                var newnumber = Number($("#" + $this.attr("data-id")).html().trim().slice(1));
                var restnumber = number - newnumber;
                var total = Number($("#total").html().trim().slice(1));
                var newprice = Number($("#price_" + $this.attr("data-id") + " strong").html().trim().slice(1)) * newnumber;
                var newtotal = Math.round((total - newprice)*100)/100;

                $("#total-number").html(restnumber);
                $("#total").html("$" + newtotal);
                $this.closest('.item').remove();

                if ($('.cart-list').find('.item').length == 0){
                    var innerHtml="";
                    innerHtml += "<i class=\"cart-block-row\"></i>";
                    innerHtml += "<div class=\"total\">";
                    innerHtml += "您的购物车为空！";
                    innerHtml += "<\/div>";
                    $('.cart-list').html(innerHtml);
                    $('.cart-wrapper').attr('data-hovered','unhovered');
                }
            }
            else {
                alert(": (");
            }
        })
    })

//recentview delete
    $('#history-view').on('click', '.history-clear a', function (e) {
        e.preventDefault();
        $this = $(this);
        $.ajax({
            url: Routing.generate('recent_viewed_action', { id:0,action:'delete' }),
            method: "POST",
            dataType: "json"
        })
        .done(function (rep) {
            if(rep == 'cleared') {
                var innerHtml = "<div class=\"cart-spinner\"><img src=\"/b2c/web/img/spinner.gif\"></div>";
                $('.history-view').html(innerHtml);
                $('#history-view').attr('data-hovered', 'unhovered');
                $("#history-view").css("background","transparent");
                $(".history-view").hide();
            }
        })
    })




});


















