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
















