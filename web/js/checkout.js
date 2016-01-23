
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


        // $('#select-location').change(function() {
        //    // $('.shipped-address').val(($(this).val());
        //     var address =$("#select-location option:selected").val();
        //     console.log(address);
        //     var loc = address.replace(/ /g,"+").split("+");
        //      $('.shipped-address').text(loc[0]);
        //       $('.shipped-name').text(loc[1]);
        //        $('.shipped-number').text(loc[2]);
        //         console.log(loc[1]);
        //         console.log(loc[2]);
        // });
    })();










