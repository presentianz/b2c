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


(function () {

        $('.btn-pay').click(function() {
        $('.pop-cart').css('display','block');
        });


        $('.btn-confirm').click(function () {
            $this = $(this);
        var productId = $this.attr("data-id");
        $.ajax({
            url: "{{ path('order_generation') }}",
            method: "GET",
            data: {
                id : productId,
            },
            dataType: "json"
        })
        .done(function (rep) {
            console.log(rep);
            if (rep.granted) {
                alert("成功！");
                window.location.replace("{{ path('order_confirm') }}"+'?id='+rep.id);
                
            }
            else {
                alert("。。");
            }
        })
        });
    })();







