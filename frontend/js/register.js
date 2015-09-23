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

var flag1 = flag2 = flag3 = flag4 = flag5=false;

$(document).ready(function () {
    $(".controls .error").css("display", "none");
    $(".controls .check-fa").css("display", "none");
    $("input[name=email]").blur(function (e) {
        var email = $("input[name=email]").val();
        if (email == "") {
            flag1 = false;
          //  $("input[name=email]").parent().find(".error").find("h6").html("邮箱不能为空");
            wrong("input[name=email]");
        }
        else {
            console.log("worng email");
            var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
            var result = reg.test(email);
            if (result == false) {

                flag1 = false;
                $("input[name=email]").parent().find(".error").find("h6").html("邮箱格式不正确");
                wrong("input[name=email]");
            }
            else {
                flag1 = true;
                correct("input[name=email]");
            }
        }
        //$("input[name=email]").parent().find(".error").find("h6").html("邮箱已经注册过");	
    });

    $("input[name=username]").blur(function (e) {
         var username = $("input[name=username]").val();
        if (username == "") {
            flag2 = false;
          //  $("input[name=username]").parent().find(".error").find("h6").html("用户名不能为空");
            wrong("input[name=username]");
        }
        else {
            flag2 = true;
            correct("input[name=username]");
        }
        //$("input[name=username]").parent().find(".error").find("h6").html("用户名已经注册过");
    });

    $("input[name=psd1]").blur(function (e) { 
     var psd1 = $("input[name=psd1]").val();  
        var reg = /^[\w]{6,20}$/;
        var result = reg.test(psd1);
        if (psd1 == "") {
            flag3 = false;
        //  $("input[name=psd1]").parent().find(".error").find("h6").html("密码不能为空");
            wrong("input[name=psd1]");
        }
        else if (result == false) {
            flag3 = false;
           $("input[name=psd1]").parent().find(".error").find("h6").html("密码需要至少6个字节");
            wrong("input[name=psd1]");
        }
        else {
            flag3 = true;
            correct("input[name=psd1]");
            Modes = 0;
            for (i = 0; i < psd1.length; i++) {
                //测试每一个字符的类别并统计一共有多少种模式.    
                Modes |= CharMode(psd1.charCodeAt(i));
            }
            switch (bitTotal(Modes)) {
                case 1:
                    $(".security-level").find("span").removeClass("active");
                    if (psd1.length >= 15)
                        $(".block2").addClass("active");
                    else
                        $(".block1").addClass("active");
                    break;
                case 2:
                    $(".security-level").find("span").removeClass("active");
                    $(".block2").addClass("active");
                    break;
                default:
                    $(".security-level").find("span").removeClass("active");
                    $(".block3").addClass("active");
                    break;
            }
        }

    });

    $("input[name=psd2]").blur(function (e) {
         var psd1 = $("input[name=psd1]").val();
        var psd2 = $("input[name=psd2]").val();

        if (psd2 == "") {
            flag4 = false;
           // $("input[name=psd2]").parent().find(".error").find("h6").html("确认密码不能为空");
            wrong("input[name=psd2]");
        }
        else {
            if (psd1 != psd2) {
                flag4 = false;
                wrong("input[name=psd2]");
                $("input[name=psd2]").parent().find(".error").find("h6").html("密码不匹配");
            }
            else {
                flag4 = true;
                correct("input[name=psd2]");
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
    $(checking).parent().find(".check-fa").addClass("fa-check-circle");
    $(checking).parent().find(".check-fa").removeClass("fa-times-circle");
    $(checking).parent().find(".check-fa").css("display", "inline-block");
    $(checking).parent().find(".error").css("display", "none");

}
function wrong(checking) {
    $(checking).parent().find(".check-fa").removeClass("fa-check-circle");
    $(checking).parent().find(".check-fa").addClass("fa-times-circle");
    $(checking).parent().find(".check-fa").css("display", "inline-block");
    $(checking).parent().find(".error").css("display", "inline-block");

}


function reigster() {
    if (flag1 && flag2 && flag3 && flag4 && flag5) {
          console.log("success to regiseter");
        return true;
    }     
    else if($("input[name=email]").val()==""){
        console.log("fail to regiseter");
        wrong("input[name=email]");
        return false;
    }
      else if($("input[name=username]").val()==""){
        console.log("fail to regiseter");
         wrong("input[name=username]");
        return false;
    }
      else if($("input[name=psd1]").val()==""){
        console.log("fail to regiseter");
         wrong("input[name=psd1]");
        return false;
    }
      else if($("input[name=psd2]").val()==""){
        console.log("fail to regiseter");
         wrong("input[name=psd2]");
        return false;
    }

    else {
        console.log("fail to regiseter");
        return false;
    }

        
}

function login() {
    if (flag1 && flag3){
        console.log("success to login");
        location.href="index.html";
        return true;
    }
         
    else{
        console.log("fail to login");
        return false;
    }
         
}





