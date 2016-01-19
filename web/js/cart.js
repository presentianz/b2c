(function (){


$('.cart-action-button').click(function (e) {
    e.preventDefault();
    $this = $(this);
    var value =$("#" + $this.attr("data-id")).val();;
    if (value !== "" || value !== null || value !== undefined) {
        if ($this.hasClass("number-input-up")) {
            if ( value <= 99 ) {
               $(".number-input-down").css("display", "block");
               var newVal = parseFloat(value) + 1;
           } 
       } 
       else if ($this.hasClass("number-input-down")) {
        if (value > 1) {
            var newVal = parseFloat(value) - 1;
            $this.css("display", "block");
        } else {
            $this.css("display", "none");
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
            $("#" + $this.attr("data-id")).val(newVal);
            var price = $("#oneprice_" + $this.attr("data-id")).html();
            var newPrice = Math.round(Number(price) * parseInt(newVal) * 100)/100;
            $("#allprice_" + $this.attr("data-id")).html("<strong>" + newPrice + "</strong>");
            var total = Number($("#totalprice").html().slice(1));
            if ($this.hasClass("number-input-up")) {
               var newtotal = Math.round((total + Number(price))*100)/100;
               console.log(newtotal);
            } else if ($this.hasClass("number-input-down")) {
              var newtotal =  Math.round((total - Number(price))*100)/100;
            }

            $("#totalprice").html("$" + newtotal);
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
