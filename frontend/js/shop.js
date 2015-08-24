
var total; var curt = 0;
$(document).ready(function() {

	$('#myCarousel').carousel();

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

	$('#gototop').click(function(){
         window.scrollTo(0,0);
	}); 
});

function imageLoaded(){ 
	curt++; 
	if(curt==total){ 
		$("#index").css("display","block"); 
	}
}




