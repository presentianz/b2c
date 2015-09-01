
$(document).ready(function() {

	$('#myCarousel').carousel();

	$('#gototop').click(function(){
         window.scrollTo(0,0);
	}); 

    $('.user .user-left li > a').on("click", function(e) {
    var currentAttrValue = jQuery(this).attr('href');
    $('.user-content ' + currentAttrValue).fadeIn(400).siblings().hide();
    $(this).parent('li').addClass('active').siblings().removeClass('active');
    e.preventDefault();
    });

     $('.order').on("click", function(e) {
    var currentAttrValue = jQuery(this).attr('href');
    $(currentAttrValue).fadeIn(400).siblings().hide();
    $('.order-detail').addClass('active').siblings().removeClass('active');
    e.preventDefault();
    });

      $('#tab5 .row > a').on("click", function(e) {
    var currentAttrValue = jQuery(this).attr('href');
    $(currentAttrValue + '.part').addClass('active').siblings().removeClass('active');
    e.preventDefault();
    });

      $( "button.open" ).click(function() {
      $(".row.open").toggle( "slow" );
});



});







