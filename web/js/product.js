function tabcontent(i) {
    $(".tab-contents").css("display", "none");
    $("#tab-content" + i).css("display", "block");
    $(".product-tabs").removeClass("active");
    $("#product-tab" + i).addClass("active");
}
function productpic(i) {
    $(".product-pics").removeClass("active");
    $("#product-pic" + i).addClass("active");
    $(".product-pictures").css("display", "none");
    $("#product-picture" + i).css("display", "block");
}
$(document).ready(function ()
{

    $('#collect').click(function() {
        $("#loading").css("display", "block");
        });

    
});

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
            if (rep.granted) {
                alert("添加成功！");
            }
            else {
                alert("添加失败！");
            }
        })
    });
})();