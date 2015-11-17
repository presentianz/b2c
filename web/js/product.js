function tabcontent(i) {
    $(".tab-contents").addClass("hide");
    $("#tab-content" + i).removeClass("hide");
    $(".product-tabs").removeClass("active");
    $("#product-tab" + i).addClass("active");
}
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
        if (value !== "" || value !== null || value !== undefined) {
            if ($this.hasClass("number-input-up")) {
                if ( value <= 99 ) {
                   $(".number-input-down").css("display", "block");
                   var newVal = parseFloat(value) + 1;
               } 
           } 
           else if ($this.hasClass("number-input-down")) {
            if (value > 1) {
                var newVal = parseFloat(value) - 1;
                $this.css("display", "block");
            } else {
                $this.css("display", "none");
                newVal = 1;
            }
        }
        $("#" + $this.attr("data-id")).val(newVal);
    }else {
        alert("(:！");

    }


})



    $('#add-cart-button').click(function (e) {
        e.preventDefault();
        $this = $(this);
        $("#loading").css("display", "block");
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
                window.location.reload();
                 setTimeout(function() {
                    $("#loading").css("display", "none");
                },2000);
                 
            }
            else {
                alert("添加失败！");
            }
        })

    });
})();