<?php

	echo register();

	function register() {
		require_once 'conn.php';
		
		$username = $_POST['username'];
		
		$password = $_POST['password'];
		
		$sql = "select * from account where username='$username'";
		
		$res = $conn->getRowsNum($sql);
		
		if ($res > 0) return -1; //账号已存在
		
		//账号合法，开始注册
		
		$sql = "insert account(username, password) values('$username', md5('$password'))";
		
		$conn->uidRst($sql);
		
		return 1; //注册成功
	}

	
?>