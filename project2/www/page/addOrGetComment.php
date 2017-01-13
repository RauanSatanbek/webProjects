<?php
	session_start();
	date_default_timezone_set('Asia/Almaty'); 
	include("db.php");
	if($_POST["bool"] == "1"){
		$text = htmlspecialchars($_POST["text"]);
		$user = $_SESSION["user_id"];
		$mysqli->query("INSERT INTO `comment` (`user`, `comment`, `time`) VALUES ('$user', '$text', '".date("y:m:d - H:i:s")."')");
		$mysqli->close();
		echo 45;
		// echo $text;
	}
	else if($_POST["bool"] == "2"){
		$result = $mysqli->query("SELECT * FROM `comment`  ORDER BY `id` DESC");
		$m = array();
		$index = 0;
		while(($row = $result->fetch_assoc()) != false){
			$user = $row["user"];
			$r = $mysqli->query("SELECT * FROM `users` WHERE `id` = '$user'")->fetch_assoc();
			$name = $r["name"] . " " . $r["surname"];
			$avatar = $r["avatar"];
			$comment = $row["comment"];
			$time = $row["time"];
			$n = array($name, $comment, $time, $avatar);
			$m[] = $n;
		}
		echo json_encode($m);
		$mysqli->close();
	}
	
?>

