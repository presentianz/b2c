(function (){

    $("input[class='qty']").blur(function (e) {
        e.preventDefault();
        $this = $(this);
        var value = $("#"+ $this.attr("id")).val();
        if (value !== "" || value !== null || value !== undefined) {
           $.ajax({
            //need to fix backend
            url: $this.attr("data-path"),
            method: "POST",
            data: {
                id : $this.attr("id"),
                action : $this.attr("data-action"),
                no : value
            },
            dataType: "json"
        })
           .done(function (rep) {

               if (rep.granted) {
                console.log("seccuss");
                
                var price = $("#price_" + $this.attr("id")).html();
                console.log(price);
                var newPrice = Math.round(Number(price) * parseInt(value) * 100)/100;
                console.log(newPrice);
                $("#allprice_" + $this.attr("id")).html("<strong>" + newPrice + "</strong>");

            }
        })

       } else {
        alert(": (");
    }

});

$('.cart-action-button').click(function (e) {
    e.preventDefault();
    $this = $(this);
    var value =$("#" + $this.attr("data-id")).val();
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
            var price = $("#price_" + $this.attr("data-id")).html();
            var newPrice = Math.round(Number(price) * parseInt(newVal) * 100)/100;
            $("#allprice_" + $this.attr("data-id")).html("<strong>" + newPrice + "</strong>");
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

})();

function selectAll(source) {
  var checkboxes = document.getElementsByName('product-id[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
}
}