<?php
	session_start();
	$to = $_SESSION["toUserId"];
	$from = $_SESSION["user_id"];
	include("db.php");

// add message in db
	if($_POST["bool"] == 1){
		$message = $_POST["message"];
		$mysqli->query("INSERT INTO `dialog`(`to`, `from`, `message`, `time`) VALUES ('$to','$from','$message','".date("Y:m:d H:i:s")."')");
		$mysqli->close();
		echo $to . " " . $from;
	}
// get message from db
	if($_POST["bool"] == 2){
		$result = $mysqli->query("SELECT `name`, `surname` FROM `users` WHERE `id` = '$to'")->fetch_assoc();
		$fromName = $_SESSION["user_name"]. " " .$_SESSION["user_surname"];
		$toName = $result["name"]. " " .$result["surname"];
		$result = $mysqli->query("SELECT * FROM `dialog` WHERE `to` = '$to' AND `from` = '$from' OR `to` = '$from' AND `from` = '$to'");
		$m = array();
		while(($row = $result->fetch_assoc()) != false){
			if ($row["from"] == $from) {$name = $fromName;$class = "me";}
			else {$name = $toName;$class = "other";}
			$message = $row["message"];
			$time = $row["time"];
			$n = array($name,$message,$time,$class);
			$m[] = $n;
		}
		echo json_encode($m);
		$mysqli->close();
	}
?>