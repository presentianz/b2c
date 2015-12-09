

$(document).ready(function () {

$(".user-order-hover").click(function() {
  //  alert($(this).attr('id'));
    var id = $(this).attr('id');
    $("#order_content_" + id).toggleClass("hide");
});

$("#1").hover(function() {
   $("#1 div.idupload-image-remove").toggleClass("hide");
}); 

$("#2").hover(function() {
   $("#2 div.idupload-image-remove").toggleClass("hide");
});



    
});







