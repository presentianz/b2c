function tabcontent(i){
	$(".tab-contents").css("display","none");
	$("#tab-content"+i).css("display","block");
	$(".product-tabs").removeClass("active");
	$("#product-tab"+i).addClass("active");
}
function productpic(i){
	$(".product-pics").removeClass("active");
	$("#product-pic"+i).addClass("active");
	$(".product-pictures").css("display","none");
	$("#product-picture"+i).css("display","block");
}
$(document).ready(function()
{
	$("#product-picture1").mlens( { 		
	  imgSrc: $("#product-pictures1").attr("data-big"), 		
	  lensShape: "circle", 		
	  lensSize: 180, 		
	  borderSize: 4, 		
	  borderColor: "#fff" 
	});
	$("#product-picture2").mlens( { 		
	  imgSrc: $("#product-pictures1").attr("data-big"), 		
	  lensShape: "circle", 		
	  lensSize: 180, 		
	  borderSize: 4, 		
	  borderColor: "#fff" 
	});
	$("#product-picture3").mlens( { 		
	  imgSrc: $("#product-pictures1").attr("data-big"), 		
	  lensShape: "circle", 		
	  lensSize: 180, 		
	  borderSize: 4, 		
	  borderColor: "#fff" 
	});
});