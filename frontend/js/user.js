
$(document).ready(function () {

    $('#user-page .tab').on("click", function (e) {
        var currentAttrValue = jQuery(this).attr('href');
        $(currentAttrValue).fadeIn(400).addClass('active').siblings().css("display", "none");
        e.preventDefault();
    });

    

    $('#add-address').click(function () {
        $("#popup-address").css("display", "block");

    });


    $("#popup-address").load("pop-address.html", function() {
       $('.save').click(function () {
        $("#popup-address").css("display", "none");

    });

       $('#popup-address .content > a').on("click", function (e) {
        var currentAttrValue = jQuery(this).attr('href');
        $(currentAttrValue + '.part').addClass('active').siblings().removeClass('active');
        e.preventDefault();
    });
   });
    



});







