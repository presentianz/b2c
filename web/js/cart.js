(function (){


$('.cart-action-button').click(function (e) {
    e.preventDefault();
    $this = $(this);
    var value =$("#" + $this.attr("data-id")).text();
    if (value !== "" || value !== null || value !== undefined) {
        if ($this.hasClass("number-input-up")) {
            if ( value < 99 ) {
                   newVal = parseFloat(value) + 1;
                   $(".number-input i").css("color", "#000");
               } else {
                    newVal = 99;
                    $this.children().css("color", "#eee");
               } 
       } 
       else if ($this.hasClass("number-input-down")) {
        if (value > 1) {
                newVal = parseFloat(value) - 1;
                $(".number-input i").css("color", "#000");
            } else {
                $this.children().css("color", "#eee");
                newVal = 1;
            }
    }
    $.ajax({
        url: $this.attr("data-path"),
        method: "POST",
        data: {
            id : $this.attr("data-id"),
            action : $this.attr("data-action"),
            no : $this.attr("data-no")
        },
        dataType: "json"
    })
    .done(function (rep) {
        if (rep.granted) {
            $("#" + $this.attr("data-id")).text(newVal);
            var price = $("#oneprice_" + $this.attr("data-id")).text();
            var newPrice = Math.round(Number(price) * parseInt(newVal) * 100)/100;
            $("#allprice_" + $this.attr("data-id")).html("<strong>" + newPrice + "</strong>");
            var total = Number($("#totalprice").text());
            if(total != NaN) {
            if ($this.hasClass("number-input-up")) {
               var newtotal = Math.round((total + Number(price))*100)/100;
                } else if ($this.hasClass("number-input-down")) {
              var newtotal =  Math.round((total - Number(price))*100)/100;
              if (newtotal < 0 ) newtotal = 0.00;
            } 
          }
           $("#totalprice").text(newtotal);

           
        }
        else {
            location.reload(true);
            alert(": (");
        }

    })
    } else {
    alert(": (");
}
})


   $('.cart-remove-button').click(function (e) {
        e.preventDefault();
        $this = $(this);
        var productId = $this.attr("data-id");
        $.ajax({
            url: $this.attr("data-path"),
            method: "POST",
            data: {
                id : productId,
                action : "rm"
            },
            dataType: "json"
        })
        .done(function (rep) {
            if (rep.granted) {
               location.reload(true);
            }
            else {
                alert("添加失败！");
            }
        })

    });



     $(".submit-pay").prop('disabled', true);
     $("input[name='product-id[]']").click(function() {
        if($(this).prop('checked')) {
           $(".submit-pay").prop('disabled', false);
           $(".submit-pay").removeClass("disabled");
        } else {
            $(".submit-pay").prop('disabled', true);
           $(".submit-pay").addClass("disabled");
        }
     });

})();

function selectAll(source) {
  var checkboxes = document.getElementsByName('product-id[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
    if(checkboxes[i].checked) {
           $(".submit-pay").prop('disabled', false);
           $(".submit-pay").removeClass("disabled");
        } else {
            $(".submit-pay").prop('disabled', true);
           $(".submit-pay").addClass("disabled");
        }
}
}
