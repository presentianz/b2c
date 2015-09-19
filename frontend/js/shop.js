
$(document).ready(function () {

    $("#header").load("header.html");
    $("#footer").load("footer.html", function () {
        $('#gototop').click(function () {
            window.scrollTo(0, 0);
        });
    });


    $('#myCarousel').carousel();

    $("#siderbar").load("siderbar.html", function () {
        $('.nav-all').click(function () {
            $('#siderbar').toggleClass('show-siderbar');
        });
    });


   
});














