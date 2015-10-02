$(document).ready(function () {



$( ".address-content" ).on( "click", function() {
  $(this).addClass("active").siblings().removeClass('active');
});

$("#delivery-option").focus(function() {
	$(this).next("ul").css("display","block").children().click(function() {
		$(this).parent().css("display", "none");
	});
});

});







