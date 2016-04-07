<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Welcome</title>
<script type="text/javascript" src = "xmlhttprequest.js"></script>
<script type="text/javascript">

function $(id) {
	return document.getElementById(id);
}

window.onload = function () {
	
	$("register_btn").onclick = function () {
		var username = $("reg_username").value;
		var password = $("reg_password").value;
		var password_rpt = $("reg_password_rpt").value;
		
		var postStr = "username=" + username + "&password=" + password + "&password_rpt=" + password_rpt;
		
		var url = './register.php';
		
		alert(postStr);
		
		xmlhttp.open('post',url,true);
		xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4){
				if(xmlhttp.status == 200){
					alert(xmlhttp.responseText);
				}
			}
		};
		//发送请求
		xmlhttp.send(postStr);

	};
	
	$("login_btn").onclick = function () {
		
		var username = $("lg_username").value;
		var password = $("lg_password").value;
		
		var postStr = "username=" + username + "&password=" + password;
		
		var url = './login.php';
		
		alert(postStr);
		
		xmlhttp.open('post',url,true);
		xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4){
				if(xmlhttp.status == 200){
					alert(xmlhttp.responseText);
				}
			}
		};
		//发送请求
		xmlhttp.send(postStr);
	};
};


</script>
</head>
<body>
<h3>register</h3>
<hr/>
<span>username:</span><input type = "text" id = "reg_username" /><br/>
<span>password:</span><input type = "password" id = "reg_password" /><br/>
<span>password_rpt:</span><input type = "password" id = "reg_password_rpt" /><br/>
<input type = "button" value = "register" id = "register_btn" />

<h3>login</h3>
<hr/>
<span>username:</span><input type = "text" id = "lg_username" /><br/>
<span>password:</span><input type = "password" id = "lg_password" /><br/>
<input type = "button" value = "login" id = "login_btn" /><br/><br/>
</body>
</html>