var total;var curt = 0;
$(document).ready(function() {
    //$("body").fadeIn(400);

	$('#myCarousel').carousel()
	$('#newProductCar').carousel()

	/* Home page item price animation */
	$('.thumbnail').mouseenter(function() {
  		$(this).children('.zoomTool').fadeIn();
	});

	$('.thumbnail').mouseleave(function() {
		$(this).children('.zoomTool').fadeOut();
	});

 
	total = $("#index img").length; 
	$("#index img").each(function(){
		var image = new Image(); 
		image.src = $(this).attr('src'); 
		if (image.complete){ 
			imageLoaded(); 
		} else{ 
			image.onload = imageLoaded;
		} 
	}); 
});

function imageLoaded(){ 
	curt++; 
	if(curt==total){ 
		$("#index").css("display","block"); 
	}
}


