
function productpic(i) {
    $(".product-pics").removeClass("active");
    $("#product-pic" + i).addClass("active");
    $(".product-pictures").addClass("hide");
    $("#product-picture" + i).removeClass("hide");
}

(function () {
    $('.number-input').click(function (e) {
        e.preventDefault();
        $this = $(this);
        var value =$("#" + $this.attr("data-id")).val();
         var newVal = null;
        if (value !== "" || value !== null || value !== undefined) {
            if ($this.hasClass("number-input-up")) {
                if ( value < 99 ) {
                   newVal = parseFloat(value) + 1;
                   $(".number-input i").css("color", "#000");
               } else {
                    newVal = 99;
                    $this.children().css("color", "#eee");
               } 
           } 
           else if ($this.hasClass("number-input-down")) {
            if (value > 1) {
                newVal = parseFloat(value) - 1;
                $(".number-input i").css("color", "#000");
            } else {
                $this.children().css("color", "#eee");
                newVal = 1;
            }
        }
        $("#" + $this.attr("data-id")).val(newVal);
    }else {
        alert("(:！");

    }


})

    $('.add-cart-button').click(function (e) {
        e.preventDefault();
        $this = $(this);
        var productId = $this.attr("data-id");
        $.ajax({
            url: $this.attr("data-path"),
            method: "POST",
            data: {
                id : productId,
                no: $('#123').val(),
                action : "+"
            },
            dataType: "json"
        })
        .done(function (rep) {
            if (rep.granted) {
                $('.cart-wrapper').attr('data-hovered','unhovered');
                $('.bg-mask').css('display','block');
                 $('.pop-cart').css('display','block');

            }
            else {
                alert("添加失败！");
            }
        })

    });


    $( document ).ready(function() {
        $.ajax({
            url: Routing.generate('recent_viewed_action', { action: 'add', id:$('.product-info').attr('data-product-id') }),
            method: "POST",
            dataType: "json"
        })
        .done(function (rep) {
            $('#history-view').attr('data-hovered','unhovered');
        });
    });
})();