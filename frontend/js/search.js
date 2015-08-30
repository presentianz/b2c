// JavaScript Document
$(document).ready(function() {	
	$(".pros-grid").find(".pro-line").removeClass("col-xs-12");
	$(".pros-grid").find(".pro-line").addClass("col-xs-3");
		
	$(".pros-list").find(".pro-line").removeClass("col-xs-3");
	$(".pros-list").find(".pro-line").addClass("col-xs-12");
});

function pagegrid(){
	$(".search-pros").removeClass("pros-list");	
	$(".search-pros").addClass("pros-grid");
	$(".pros-grid").find(".pro-line").removeClass("col-xs-12");
	$(".pros-grid").find(".pro-line").addClass("col-xs-3");
}

function pagelist(){
	$(".search-pros").removeClass("pros-grid");	
	$(".search-pros").addClass("pros-list");
	$(".pros-list").find(".pro-line").removeClass("col-xs-3");
	$(".pros-list").find(".pro-line").addClass("col-xs-12");
}