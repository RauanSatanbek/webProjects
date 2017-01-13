<?php
	session_start();
	date_default_timezone_set('Asia/Almaty'); 
	include("db.php");
	if($_POST["bool"] == 1){
		$message = htmlspecialchars($_POST["message"]);
		$to = $_POST["to"];
		$mysqli->query("INSERT INTO `groupchat`(`from`, `to`, `group`, `message`, `date`) VALUES ('".$_SESSION['user_id']."','".$to."', '".$_SESSION["groupId"]."','".$message."', '".date("y:m:d - H:i:s")."')");
		$mysqli->close();
		echo $message;
	}
	// $_POST["bool"] = 2;
	else if($_POST["bool"] == 2){
		$result = $mysqli->query("SELECT * FROM `groupchat` WHERE `group` = '".$_SESSION["groupId"]."' ORDER BY `id` DESC");
		$m = array();
		$index = 0;
		while(($row = $result->fetch_assoc()) != false){
			$from = $row["from"];
			$to = $row["to"];
			$result2 = $mysqli->query("SELECT * FROM `users` WHERE `id` = '".$from."'")->fetch_assoc();
			$result3 = $mysqli->query("SELECT * FROM `users` WHERE `id` = '".$to."'")->fetch_assoc();
			if($to != 0 && $to != $_SESSION['user_id']) $toName = ' <i class="fa fa-long-arrow-right" aria-hidden="true"></i> ' . $result3["name"];
			else $toName = $result2["name"];
			$name = $toName ;
			$message = $row["message"];
			$date = $row["date"];
			$n = array($from, $name, $message, $date,$_SESSION['user_id']);
			$m[] = $n;
		}
		echo json_encode($m);
		$mysqli->close();
	}
	
?>

