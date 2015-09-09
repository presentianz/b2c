// JavaScript Document

$(document).ready(function() {	
	$(".nav-all").mouseover(function(){
  		onSecondDelay(callback);
	});	
	$(".nav-all").mousemove(function(){
  		onSecondDelay(callback);
	});	
	$(".nav-all").mouseout(function(){
		clearTimeout(timer);
	});
	$(".nav-list").mouseover(function(){
  		clearTimeout(timer2);
	});	
	$(".nav-list").mousemove(function(){
  		clearTimeout(timer2);
	});	
	$(".nav-list").mouseout(function(){
		onSecondDelay2(callback2);
	});
});

var timer = null;
function callback() {
    $(".nav-list").css("display","block");
}
function onSecondDelay(callback) {
    clearTimeout(timer);
    timer = setTimeout(callback, 200);
}
var timer2 = null;
function callback2() {
    $(".nav-list").css("display","none");
}
function onSecondDelay2(callback2) {
    clearTimeout(timer2);
    timer2 = setTimeout(callback2, 500);
}




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