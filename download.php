<?php
require_once 'conn.php';


header("content-type:text/json");

	$uid = $_GET['uid'];
	
	$sql = "select * from note where uid=$uid";
	
	$notes = $conn->getRowsArray($sql);
	
	echo json_encode($notes);
?>