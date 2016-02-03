 (function () {
        $('.btn-pay').click(function() {
        $('.bg-mask').css('display','block');
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


         $("input[name='region']").blur(function (e) {
            alert("hehe");

         });
    })();










