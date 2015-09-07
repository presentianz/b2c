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
                if (num & 1) modes++;  
                num >>>= 1;  
            }  
            return modes;  
        } 
var flag1=flag2=flag3=flag4=false;
$(document).ready(function() {
	$(".controls").find(".error").css("display","none");
	$(".controls").find(".check-fa").css("display","none");
	
	$("input[name=email]").blur(function(e) {
		var email=$("input[name=email]").val();
		if (email==""){
			flag1=false;
			$("input[name=email]").parent().find(".error").find("h6").html("邮箱不能为空");
			$("input[name=email]").parent().find(".check-fa").removeClass("fa-check-circle");
			$("input[name=email]").parent().find(".check-fa").addClass("fa-times-circle");
			$("input[name=email]").parent().find(".check-fa").css("display","inline-block");
			$("input[name=email]").parent().find(".error").css("display","inline-block");
		}
		else{
			var reg =/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
			var result=reg.test(email);
			if (result==false){
				flag1=false;
				$("input[name=email]").parent().find(".error").find("h6").html("邮箱格式不正确");
				$("input[name=email]").parent().find(".check-fa").removeClass("fa-check-circle");
				$("input[name=email]").parent().find(".check-fa").addClass("fa-times-circle");
				$("input[name=email]").parent().find(".check-fa").css("display","inline-block");
				$("input[name=email]").parent().find(".error").css("display","inline-block");
			}	
			else{
				flag1=true;
				$("input[name=email]").parent().find(".check-fa").addClass("fa-check-circle");
				$("input[name=email]").parent().find(".check-fa").removeClass("fa-times-circle");
				$("input[name=email]").parent().find(".check-fa").css("display","inline-block");
				$("input[name=email]").parent().find(".error").css("display","none");	
			}	
		}
		//$("input[name=email]").parent().find(".error").find("h6").html("邮箱已经注册过");	
	}); 
	
	$("input[name=username]").blur(function(e) {
		var username=$("input[name=username]").val();
		if (username==""){
			flag2=false;
			$("input[name=username]").parent().find(".error").find("h6").html("用户名不能为空");
			$("input[name=username]").parent().find(".check-fa").removeClass("fa-check-circle");
			$("input[name=username]").parent().find(".check-fa").addClass("fa-times-circle");
			$("input[name=username]").parent().find(".check-fa").css("display","inline-block");
			$("input[name=username]").parent().find(".error").css("display","inline-block");
		}	
		else{
			flag2=true;
			$("input[name=username]").parent().find(".check-fa").addClass("fa-check-circle");
			$("input[name=username]").parent().find(".check-fa").removeClass("fa-times-circle");
			$("input[name=username]").parent().find(".check-fa").css("display","inline-block");
			$("input[name=username]").parent().find(".error").css("display","none");	
		}
		//$("input[name=username]").parent().find(".error").find("h6").html("用户名已经注册过");
	}); 
	
	$("input[name=psd1]").blur(function(e) {
		var psd1=$("input[name=psd1]").val();
		var psd2=$("input[name=psd2]").val();
		var reg = /^[\w]{6,20}$/;
		var result=reg.test(psd1);
		if (result==false){
			flag3=false;
			$("input[name=psd1]").parent().find(".check-fa").removeClass("fa-check-circle");
			$("input[name=psd1]").parent().find(".check-fa").addClass("fa-times-circle");
			$("input[name=psd1]").parent().find(".check-fa").css("display","inline-block");
			$("input[name=psd1]").parent().find(".error").css("display","inline-block");
		}	
		else{
			flag3=true;
			$("input[name=psd1]").parent().find(".check-fa").addClass("fa-check-circle");
			$("input[name=psd1]").parent().find(".check-fa").removeClass("fa-times-circle");
			$("input[name=psd1]").parent().find(".check-fa").css("display","inline-block");
			$("input[name=psd1]").parent().find(".error").css("display","none");	
				Modes = 0;  
				for (i = 0; i < psd1.length; i++) {  
					//测试每一个字符的类别并统计一共有多少种模式.    
					Modes |= CharMode(psd1.charCodeAt(i));  
				} 
				switch (bitTotal(Modes)){
					case 1:
						$(".security-level").find("span").removeClass("active");
						if (psd1.length>=15) $(".block2").addClass("active");
						else $(".block1").addClass("active");
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
		if (psd2!=""){
				if (psd1!=psd2){
					flag4=false;
					$("input[name=psd2]").parent().find(".error").find("h6").html("密码不匹配");
					$("input[name=psd2]").parent().find(".check-fa").removeClass("fa-check-circle");
					$("input[name=psd2]").parent().find(".check-fa").addClass("fa-times-circle");
					$("input[name=psd2]").parent().find(".check-fa").css("display","inline-block");
					$("input[name=psd2]").parent().find(".error").css("display","inline-block");
				}
				else{
					flag4=true;
					$("input[name=psd2]").parent().find(".check-fa").addClass("fa-check-circle");
					$("input[name=psd2]").parent().find(".check-fa").removeClass("fa-times-circle");
					$("input[name=psd2]").parent().find(".check-fa").css("display","inline-block");
					$("input[name=psd2]").parent().find(".error").css("display","none");	
				}
		}
	}); 
	
	$("input[name=psd2]").blur(function(e) {
		var psd1=$("input[name=psd1]").val();
		var psd2=$("input[name=psd2]").val();
		if (psd2==""){
			flag4=false;
			$("input[name=psd2]").parent().find(".error").find("h6").html("确认密码不能为空");
			$("input[name=psd2]").parent().find(".check-fa").removeClass("fa-check-circle");
			$("input[name=psd2]").parent().find(".check-fa").addClass("fa-times-circle");
			$("input[name=psd2]").parent().find(".check-fa").css("display","inline-block");
			$("input[name=psd2]").parent().find(".error").css("display","inline-block");
		}
		else{
			if (psd1!=psd2){
				flag4=false;
				$("input[name=psd2]").parent().find(".error").find("h6").html("密码不匹配");
				$("input[name=psd2]").parent().find(".check-fa").removeClass("fa-check-circle");
				$("input[name=psd2]").parent().find(".check-fa").addClass("fa-times-circle");
				$("input[name=psd2]").parent().find(".check-fa").css("display","inline-block");
				$("input[name=psd2]").parent().find(".error").css("display","inline-block");
			}
			else{
				flag4=true;
				$("input[name=psd2]").parent().find(".check-fa").addClass("fa-check-circle");
				$("input[name=psd2]").parent().find(".check-fa").removeClass("fa-times-circle");
				$("input[name=psd2]").parent().find(".check-fa").css("display","inline-block");
				$("input[name=psd2]").parent().find(".error").css("display","none");	
			}	
		}
	});    

	
});
function mysubmit() {
	var checkbox = document.getElementById('checkinfo');
	if ((flag1&&flag2&&flag3&&flag4)&&(checkbox.checked)) return true
	else return false;
}





