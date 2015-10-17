$(document).ready(function () {
        $('#gototop').click(function () {
            window.scrollTo(0, 0);
        });

    $('#myCarousel').carousel();

    $(".number-input-up").click(function (e) {
    	e.preventDefault();
        $this = $(this);
        var productId = $this.attr("data-id");
        var $n = $("#" + productId);
        $n.val(Number($n.val()) + 1);
    });
    $(".number-input-down").click(function (e) {
    	e.preventDefault();
        $this = $(this);
        var productId = $this.attr("data-id");
        var $n = $("#" + productId);
        $n.val(Number($n.val()) - 1);
    });
});



$(function() {
    $("img.lazy").lazyload({
        failure_limit : 99999, 
        effect : "fadeIn",
        threshold : 10
    });
});
















