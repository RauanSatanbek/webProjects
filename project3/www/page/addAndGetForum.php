<?php
	session_start();
	date_default_timezone_set('Asia/Almaty'); 
	include("db.php");
	if($_POST["bool"] == 1){
		$question = htmlspecialchars($_POST["question"]);
		$mysqli->query("INSERT INTO `forum`(`subject`, `user`, `question`, `time`) VALUES ('".$_SESSION['subject_id']."','".$_SESSION['user_id']."', '".$question."', '".date("y:m:d - H:i:s")."')");
		$mysqli->close();
		echo $_SESSION['subject_id'] . " " . $_SESSION['user_id'];
	}
	// $_POST["bool"] = 2;
	else if($_POST["bool"] == 2){
		$result = $mysqli->query("SELECT * FROM `forum` WHERE `subject` = '3' ORDER BY `id` DESC");

		$m = array();
		$user_avatar = $_SESSION["user_avatar"];
		$index = 0;
		while(($row = $result->fetch_assoc()) != false){
			$user = $row["user"];
			$result2 = $mysqli->query("SELECT * FROM `users` WHERE `id` = '".$user."'")->fetch_assoc();
			$name = $result2["name"] . " " .$result2["surname"];
			$avatar = $result2["avatar"];
			$question = $row["question"];
			$time = $row["time"];
			$n = array($avatar, $name, $question, $time, $user_avatar);
			$m[] = $n;
		}
		echo json_encode($m);
		$mysqli->close();
	}
	
?>

