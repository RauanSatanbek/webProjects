<?php
	session_start();
	include("db.php");
	if($_POST["bool"] == 1){
		$login = $_POST["login"];
		$password = md5($_POST["password"]);
		$row = $mysqli->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
		$row = $row->fetch_assoc();
		// echo $row["login"];
		if($row["login"] != false){
			$info = $mysqli->query("SELECT * FROM `users` WHERE login = '".$login."'");
			$info = $info->fetch_assoc();
			$_SESSION["user_id"] = $info["id"];
			$_SESSION["user_name"] = $info["name"];
			$_SESSION["user_avatar"] = $info["avatar"];
			$_SESSION["user_login"] = $info["login"];
			$_SESSION["user_is_logged"] = 1;
			echo 1;
		} else {
			echo 2;
		}
	}

	else if($_POST["bool"] == 2){
		$name = $_POST["name"];
		$login = $_POST["login"];
		$password = $_POST["password"];
		$c = false;
		$r = $mysqli->query("SELECT `login` FROM `users` WHERE login = '$login'")->fetch_assoc();
		if (!empty($r["login"])) $c = true;
		if (!$c){
			$mysqli->query("INSERT INTO `users` (`name`,   `login`, `password`) VALUES ('".$name."', '".$login."', '".md5($password)."')");
			$info = $mysqli->query("SELECT * FROM `users` WHERE login = '".$login."'");
			$info = $info->fetch_assoc();
			$_SESSION["user_id"] = $info["id"];
			$_SESSION["user_name"] = $info["name"];
			$_SESSION["user_login"] = $info["login"];
			$_SESSION["user_avatar"] = $info["avatar"];
			$_SESSION["user_is_logged"] = 1;
			echo 1;
		}
		else echo 2;
		}
	else if($_POST["bool"] == 3){
		session_destroy();
		// unset($_SESSION["user_is_logged"]);
		// unset($_SESSION["user_id"]);
		// unset($_SESSION["user_name"]);
		// unset($_SESSION["user_login"]);
		// unset($_SESSION["user_avatar"]);
	}
	$mysqli->close();
?>