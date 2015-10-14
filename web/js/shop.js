$(document).ready(function () {

        $('#gototop').click(function () {
            window.scrollTo(0, 0);
        });


    $('#myCarousel').carousel();

        $('.nav-all').hover(
            function () {
            $('#siderbar').css('display',"block");
           });

         $('#siderbar').mouseleave(
            function () {
            $(this).css('display',"none");
           });

         $('.save').click(function () {
                $("#top-address").css("display", "none");
                $(".bg-mask").css("display", "none");
                $("body").css("overflow","auto");
                });
});



$(function() {
    $("img.lazy").lazyload({
        failure_limit : 99999, 
        effect : "fadeIn",
        threshold : 10
    });
});


function correct(checking) {
    $(checking).parent().find(".check-icon").addClass("fa-check-circle");
    $(checking).parent().find(".check-icon").removeClass("fa-times-circle");
    $(checking).parent().find(".check-icon").css("display", "inline-block");
    $(checking).parent().find(".error").css("display", "none");

}
function wrong(checking) {
    $(checking).parent().find(".check-icon").removeClass("fa-check-circle");
    $(checking).parent().find(".check-icon").addClass("fa-times-circle");
    $(checking).parent().find(".check-icon").css("display", "inline-block");
    $(checking).parent().find(".error").css("display", "inline-block");

}















