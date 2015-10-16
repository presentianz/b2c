$(document).ready(function (){
            $('.delete-product-href').click(function (e) {
                e.preventDefault();
                $this = $(this);
                var productId = $this.attr("data-id");
                $.ajax({
                    url:"{{path('cart_ajax_action')",
                    method: "POST",
                    data: {
                        id : productId,
                        action : "rm"
                    },
                    dataType: "json"
                })
                .done(function (rep) {
                    console.log( rep );
                    if (rep.granted) {
                        location.reload(true);
                    }
                    else {
                        alert("删除失败");
                    }
                })
            })
        });