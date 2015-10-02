
$(document).ready(function () {

    $('#user-page .tab').on("click", function (e) {
        var currentAttrValue = jQuery(this).attr('href');
        $(currentAttrValue).fadeIn(400).addClass('active').siblings().css("display","none");
        e.preventDefault();
    });

    $('#edit-name').on("click", function() {
        $(this).removeClass("fa-edit").addClass("fa-remove");    
        $(".edit-name-2").removeClass("hide");
        $(".edit-name-1").addClass("hide");
    });
    $('#edit-email').on("click", function() {
        $(this).removeClass("fa-edit").addClass("fa-remove");    
        $(".edit-email-2").removeClass("hide");
        $(".edit-email-1").addClass("hide");
    });

    
});







