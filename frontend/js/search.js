// JavaScript Document

$(document).ready(function() {	
	$(".nav-all").mouseenter(function(){
  		$(".nav-list").slideDown(1000);
	});	
	$(".nav-list").mouseleave(function(){
		$(".nav-list").slideUp(1000);
	});
});


function changeselectbox(i){	
	if ($("#select-box"+i).hasClass("active")){
		if ($("#select-box"+i).find(".fa-long-arrow-up").css("display")=="none"){
			$("#select-box"+i).find(".fa-long-arrow-down").css("display","none");
			$("#select-box"+i).find(".fa-long-arrow-up").css("display","inline-block");
		}
		else{
			$("#select-box"+i).find(".fa-long-arrow-up").css("display","none");
			$("#select-box"+i).find(".fa-long-arrow-down").css("display","inline-block");
		}
	}
	$(".select-box-order").removeClass("active");
	$("#select-box"+i).addClass("active");
}