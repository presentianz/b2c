

$(document).ready(function () {

$('.cropme').simpleCropper();

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

$(".order-cancel").click(function(){
	$('.bg-mask').css('display','block');
    $('.pop-cart').css('display','block');
});



    
});







