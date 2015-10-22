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
    
    $("#number-up").click(function (e) {
        e.preventDefault();
        $this = $(this);
        var productId = $this.attr("data-id");
        var $n = $("#" + productId);
        $n.val(Number($n.val()) + 1);
    });

    $("#number-down").click(function (e) {
        e.preventDefault();
        $this = $(this);
        var productId = $this.attr("data-id");
        var $n = $("#" + productId);
        $n.val(Number($n.val()) - 1);
    });

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
            console.log( rep );
           $("#loading").css("display", "none");
            if (rep.granted) {
                alert("添加成功！");
            }
            else {
                alert("添加失败！");
            }
        })
    });
})();