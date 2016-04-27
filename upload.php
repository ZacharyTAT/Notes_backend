<?php

	$json = $_POST['notes'];
	
	$uid = $_POST['uid'];
	
	//print_r($json);
	//echo "--------<br/>";
	//echo $uid;
	
	//var_dump(json_decode($notes));

	if (empty($uid)) {
		echo -1;
		return;
	}
		
	$notes = json_decode($json);
	
	//print_r($notes);
	
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
	
	//echo "arr = ------<br/>";
	
	//print_r($arr);
	echo save($arr, $uid);

	
	function save($notes, $uid) {
		
		require_once 'conn.php';
		
		//先删除所有该账号下的数据
		$conn->uidRst("delete from note where uid=$uid");
		//echo "after delete count=$count";
		//echo "\n";
		//var_dump($notes);
		//存入数据
		$count = 0;
		
		foreach ($notes as $note) {
			$id = $note['id'];
			$title = $note['title'];
			$content = $note['content'];
			$stick = $note['stick'];
			$lock = $note['lock'];
			$datetime = $note['datetime'];
			
			//存入数据库
			$sql = "insert note values($id, '$title', '$content', $stick, $lock, $datetime, $uid)";
		
			$count += $conn->uidRst($sql);
		}
		
		return $count;
	}
?>







