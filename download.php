<?php
require_once 'conn.php';

header("content-type:text/json");
	
	$sql = "select * from note";
	
	$notes = $conn->getRowsArray($sql);
	
	if (empty($notes)) {
		$sql = "select * from note_cache";
		$notes = $conn->getRowsArray($sql);
	}
	
	echo json_encode($notes);
?>