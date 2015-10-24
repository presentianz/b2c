(function (){
    $('.cart-action-button').click(function (e) {
        e.preventDefault();
        $this = $(this);
        $("#loading").css("display", "block");
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
            if ($this.attr("class") == "number-input number-input-up cart-action-button") {
                if (rep.granted) {
                    var $n = $("#" + $this.attr("data-id"));
                    $n.val(Number($n.val()) + 1);
                }
                else {
                    alert(': (');
                }
            }
            else if ($this.attr("class") == "number-input number-input-down cart-action-button") {
                if (rep.granted) {
                    var $n = $("#" + $this.attr("data-id"));
                    $n.val(Number($n.val()) - 1);
                }
                else {
                    alert(': (');
                }
            }
            else {
                if (rep.granted) {
                    location.reload(true);
                }
                else {
                    alert(": (");
                }
            }
            $("#loading").css("display", "none");
        })
    })
})();

function selectAll(source) {
  var checkboxes = document.getElementsByName('product-id[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}