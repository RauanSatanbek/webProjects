<?php
	if(isset($_POST["text"])){
		$mysqli = new mysqli("localhost", "root", "", "users");
		$mysqli->query("SET NAMES 'utf8'");
		$row = $mysqli->query("SELECT * FROM `users` WHERE `name` LIKE'%".$_POST["text"]."%' ORDER BY `name` DESC");
		// echo $row["name"] . " " . $row["surname"];
		$m = array();
		while(($r = $row->fetch_assoc()) != false){
			$m[] = $r;
		}
		echo json_encode($m);
		$mysqli->close();
	}
	else {
		echo "";
	}
?>