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

	 $("#num-up").click(function(){
        var $n = $("#qty");
        $n.val( Number($n.val())+1); 
    });
	 $("#num-down").click(function(){
        var $n = $("#qty");
        $n.val( Number($n.val())-1); 
    });
	
});