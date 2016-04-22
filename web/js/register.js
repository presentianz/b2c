function CharMode(iN) {
    if (iN >= 48 && iN <= 57) //数字    
        return 1;
    if (iN >= 65 && iN <= 90) //大写字母    
        return 2;
    if (iN >= 97 && iN <= 122) //小写    
        return 4;
    else
        return 8; //特殊字符    
}
function bitTotal(num) {
    modes = 0;
    for (i = 0; i < 4; i++) {
        if (num & 1)
            modes++;
        num >>>= 1;
    }
    return modes;
}

var flag1 = flag2 = flag3 = flag4 = flag5 = false;

$(document).ready(function () {
    $("input[name='fos_user_registration_form[email]']").blur(function (e) {
        var regular_expression = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        
        var email_address = $("input[name='fos_user_registration_form[email]']").val();

        var regexp_result = regular_expression.test(email_address);

        if (regexp_result == false) {
            flag1 = false;
            $("input[name='fos_user_registration_form[email]']").parent().find(".error").find("h6").html("邮箱格式不正确");
            wrong("input[name='fos_user_registration_form[email]']");
            isemail_fomart_ok = false;
        } else {
            isemail_fomart_ok = true;
            flag1 = true;
            correct("input[name='fos_user_registration_form[email]']");
        }
        window.location.href = Routing.generate("user_register_check");
        //$("input[name='fos_user_registration_form[email]']").parent().find(".error").find("h6").html(email_address);	
    });

    $("input[name='fos_user_registration_form[username]']").blur(function (e) {
        var username = $("input[name='fos_user_registration_form[username]']").val();
        if (username == "") {
            flag2 = false;
            wrong("input[name='fos_user_registration_form[username]']");
        } else {
            flag2 = true;
            correct("input[name='fos_user_registration_form[username]']");
        }
        //$("input[name='fos_user_registration_form[username]']").parent().find(".error").find("h6").html("用户名已经注册过");
    });

    $("input[name='fos_user_registration_form[plainPassword][first]']").blur(function (e) { 
        var psd1 = $("input[name='fos_user_registration_form[plainPassword][first]']").val();  
        var reg = /^\S{6,20}$/;
        var result = reg.test(psd1);
        if (psd1 == "") {
            flag3 = false;
            wrong("input[name='fos_user_registration_form[plainPassword][first]']");
            $(".security-level").find("span").removeClass("orange red green");
        } 


        if (result == false) {
            flag3 = false;
            $("input[name='fos_user_registration_form[plainPassword][first]']").parent().find(".error").find("h6").html("密码需要至少6个字节");
            wrong("input[name='fos_user_registration_form[plainPassword][first]']");
        } else {
            flag3 = true;
            correct("input[name='fos_user_registration_form[plainPassword][first]']");
            Modes = 0;
            for (i = 0; i < psd1.length; i++) {
                //测试每一个字符的类别并统计一共有多少种模式.    
                Modes |= CharMode(psd1.charCodeAt(i));
            }
            switch (bitTotal(Modes)) {
                case 1:
                $(".security-level").find("span").removeClass("orange red green");
                if (psd1.length >= 15) {
                    $(".block2").addClass("orange");
                    $(".block1").addClass("orange");
                }
                else {
                    $(".block1").addClass("red");
                }
                break;
                case 2:
                $(".security-level").find("span").removeClass("orange red green");
                $(".block2").addClass("orange");
                $(".block1").addClass("orange");
                break;
                default:
                $(".security-level").find("span").removeClass("orange red green");
                $(".block3").addClass("green");
                $(".block2").addClass("green");
                $(".block1").addClass("green");
                break;
            }
        }

    });

$("input[name='fos_user_registration_form[plainPassword][second]']").blur(function (e) {
    var psd1 = $("input[name='fos_user_registration_form[plainPassword][first]']").val();
    var psd2 = $("input[name='fos_user_registration_form[plainPassword][second]']").val();
    if (psd2 == "") {
        flag4 = false;
        wrong("input[name='fos_user_registration_form[plainPassword][second]']");
    }else {
        if (psd1 != psd2) {
            flag4 = false;
            wrong("input[name='fos_user_registration_form[plainPassword][second]']");
            $("input[name='fos_user_registration_form[plainPassword][second]']").parent().find(".error").find("h6").html("密码不匹配");
        } else {
            flag4 = true;
            correct("input[name='fos_user_registration_form[plainPassword][second]']");
        }
    }
});

$("input[id=checkinfo]").blur(function (e) {
    var checkinfo = document.getElementById("checkinfo");
    if(checkinfo.checked){
       flag5=true;
       correct("input[id=checkinfo]");
   }
   else {
    flag5=false;
    wrong("input[id=checkinfo]");
}
});


});



function correct(checking) {
    $(checking).parent().find(".check-icon").addClass("fa-check-circle");
    $(checking).parent().find(".check-icon").removeClass("fa-times-circle");
    $(checking).parent().find(".check-icon").css("display", "inline-block");
    $(checking).parent().find(".error").css("display", "none");

}
function wrong(checking) {
    $(checking).parent().find(".check-icon").removeClass("fa-check-circle");
    $(checking).parent().find(".check-icon").addClass("fa-times-circle");
    $(checking).parent().find(".check-icon").css("display", "inline-block");
    $(checking).parent().find(".error").css("display", "inline-block");

}


$("#register-form").submit(function (e) {
    console.log("register");
    if (flag1 && flag2 && flag3 && flag4){
        $("#bg-mask").css("display", "block");
        $("#loading").css("display", "block");
        window.location.href = Routing.generate("user_register_check");
    } else if (flag1 || flag2 || flag3 || flag4 || flag5) {

         //alert("register fail");
    }
});

function login() {
     $("#bg-mask").css("display", "none");
    $("#loading").css("display", "none");
    
    if (flag1 && flag3){
        alert("login success");
        $("#bg-mask").css("display", "block");
        $("#loading").css("display", "block");
        return true;
    } 
    else if($("input[name='fos_user_registration_form[email]']").val()==""){
        wrong("input[name='fos_user_registration_form[email]']");
        return false;
    }
    else if($("input[name='fos_user_registration_form[plainPassword][first]']").val()==""){
       wrong("input[name='fos_user_registration_form[plainPassword][first]']");
       return false;
   }      
   else{
   
    return false;
}

}





