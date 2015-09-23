
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


function popup(i) {
    var e; 
    if(i === 1) e= "popup-address";
    if(i === 2) e= "popup-login";   
    if(i === 3) e= "popup-cart";          

    $("#"+e).css("display", "block");
    $("body").css("overflow","hidden");   
    $("#"+e).load(e+".html", function() {
     $('.save').click(function () {
        $("#"+e).css("display", "none");
         $("body").css("overflow","auto");  
    });

     $('#'+e +' .content > a').on("click", function (e) {
        var currentAttrValue = jQuery(this).attr('href');
        $(currentAttrValue + '.part').addClass('active').siblings().removeClass('active');
        e.preventDefault();
    });
 });

}














