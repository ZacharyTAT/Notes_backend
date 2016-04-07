<?php

	echo register();

	function register() {
		require_once 'conn.php';
		
		$username = $_POST['username'];
		
		$password = $_POST['password'];
		
		$password_rpt = $_POST['password_rpt'];
		
		$sql = "select * from account where username='$username'";
		
		$res = $conn->getRowsNum($sql);
		
		if ($res > 0) return -1; //账号已存在
		
		if ($password != $password_rpt) return 0; //密码与确认密码不一致
		
		//账号合法，开始注册
		
		$sql = "insert account(username, password) values('$username', md5('$password'))";
		
		$conn->uidRst($sql);
		
		return 1; //注册成功
	}

	
?>