<?php

	$json = $_POST['notes'];
	
	$never_download = $_POST['never_download'];
	
	//var_dump(json_decode($notes));

	$notes = json_decode($json);
	
	//var_dump($notes);
	
	$count = 0;
	
	$arr = array();
	
	foreach ($notes as $note) {
		$arr[$count]["id"] = $note->id;
		$arr[$count]["title"] = $note->title;
		$arr[$count]["content"] = $note->content;
		$arr[$count]["stick"] = $note->stick;
		$arr[$count]["lock"] = $note->lock;
		$arr[$count]["datetime"] = $note->datetime;
		$count += 1;
	}
	
	echo save($arr, $never_download);
	
	function save($notes, $never_download) {
		
		require_once 'conn.php';
		
		$count = 0;
		
		$emptyTable = "note_cache";
		$table = "note";
		
		$res = $conn->getRowsNum("select * from $emptyTable");
		
		if ($res > 0) {
			$emptyTable = "note";
			$table = "note_cache";
		}
		
		$targetTable = $emptyTable;
		
		if ($never_download == "1") {
			$targetTable = $table;
		}
		
		//var_dump($notes);
		//存入数据
		foreach ($notes as $note) {
			$id = $note['id'];
			$title = $note['title'];
			$content = $note['content'];
			$stick = $note['stick'];
			$lock = $note['lock'];
			$datetime = $note['datetime'];
			
			//存入数据库
			$sql = "insert $targetTable values($id, '$title', '$content', $stick, $lock, $datetime)";
		
			$count += $conn->uidRst($sql);
		}
		
		//删除以前数据
		if ($never_download == "0") {
			$conn->uidRst("delete from $table");
		}
		return $count;
	}
?>







