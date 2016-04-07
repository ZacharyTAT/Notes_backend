<?php
	
	echo login();

	function login(){
		require_once 'conn.php';
		
		$username = $_POST['username'];
		
		$password = $_POST['password'];
		
		$sql = "select * from account where username='$username'";
		
		$res = $conn->getRowsNum($sql);
		
		if ($res <= 0) return -1; //用户名不存在
		
		$sql = "select * from account where username='$username' and password=md5('$password')";
		
		$res = $conn->getRowsNum($sql);
		
		if ($res <= 0) return 0; //密码错误
		
		return 1; //登录成功
	}


?>