$(document).ready(function () {

        $('#gototop').click(function () {
            window.scrollTo(0, 0);
        });


    $('#myCarousel').carousel();

        $('.nav-all').click(function () {
            $('#siderbar').toggleClass('show-siderbar');
        });

         $('.save').click(function () {
                $("#top-address").css("display", "none");
                $(".bg-mask").css("display", "none");
                $("body").css("overflow","auto");
                });
});



$(function() {
    $("img.lazy").lazyload({
        effect : "fadeIn"
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


// function popup(i) {
//     var e; 
//     if(i === 1) e= "popup-address";
//     if(i === 2) e= "popup-login";   
//     if(i === 3) e= "popup-cart";          

//     $("#"+e).css("display", "block");
//     $("body").css("overflow","hidden");   
//     $("#"+e).load(e+".html", function() {

//              //new or edit address

//              $("input[name=province]").blur(function (e) {
//                 console.log("provice");
//                 var e = $("input[name=province]").val();
//                 if (e == "") {
//                     wrong("input[name=province]");
//                 }
//                 else {
//                     correct("input[name=province]");
//                 }
//             });

//              $("input[name=city]").blur(function (e) {
//                  var e = $("input[name=city]").val();
//                  if (e == "") {
//                     wrong("input[name=city]");
//                 }
//                 else {
//                     correct("input[name=city]");
//                 }
//             });

//              $("input[name=name]").blur(function (e) {
//                  var e = $("input[name=name]").val();
//                  if (e == "") {
//                     wrong("input[name=name]");
//                 }
//                 else {
//                     correct("input[name=name]");
//                 }
//             });

//              $("input[name=phone]").blur(function (e) {
//                  var e = $("input[name=phone]").val();
//                  if (e == "") {
//                     wrong("input[name=phone]");
//                 }
//                 else {
//                     correct("input[name=phone]");
//                 }
//             });

//              $("textarea[name=address]").blur(function (e) {
//                  var e = $("textarea[name=address]").val();
//                  if (e == "") {
//                     wrong("textarea[name=address]");
//                 }
//                 else {
//                     correct("textarea[name=address]");
//                 }
//             });

//              $('.save').click(function () {
//                 $("#"+e).css("display", "none");
//                 $("body").css("overflow","auto");  
//                 });

//                 $('#'+e +' .content > a').on("click", function (e) {
//                     var currentAttrValue = jQuery(this).attr('href');
//                     $(currentAttrValue + '.part').addClass('active').siblings().removeClass('active');
//                     e.preventDefault();

//             });
//          });

// }


















