<?php
	session_start();
	include("db.php");
	if($_POST["bool"] == "1"){
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
			$_SESSION["user_surname"] = $info["surname"];
			$_SESSION["user_avatar"] = $info["avatar"];
			// $_SESSION["user_tel"] = $info["tel"];
			$_SESSION["user_login"] = $info["login"];
			$_SESSION["user_is_logged"] = 1;
			echo "1";
		} else {
			echo "";
		}
	}

	else if($_POST["bool"] == "2"){
		$name = $_POST["name"];
		$surname = $_POST["surname"];
		// $tel = $_POST["tel"];
		$login = $_POST["login"];
		$password = $_POST["password"];
		$c = false;
		function printsql($r){
			global $login;
			global $c;
			while(($row = $r->fetch_assoc()) != false){
				$s = $row["login"];
				if ($login === $s)
					$c = true;
			}
		}
		$r = $mysqli->query("SELECT `login` FROM `users` WHERE login = '$login'")->fetch_assoc();
		// printsql($r);
		if (!empty($r["login"])) $c = true;
		if (!$c){
			$mysqli->query("INSERT INTO `users` (`name`, `surname`,  `login`, `password`) VALUES ('".$name."', '".$surname."', '".$login."', '".md5($password)."')");
			$info = $mysqli->query("SELECT * FROM `users` WHERE login = '".$login."'");
			$info = $info->fetch_assoc();
			$_SESSION["user_id"] = $info["id"];
			$_SESSION["user_name"] = $info["name"];
			$_SESSION["user_surname"] = $info["surname"];
			$_SESSION["user_login"] = $info["login"];
			$_SESSION["user_avatar"] = $info["avatar"];
			$_SESSION["user_is_logged"] = 1;
			echo "1";

		}
		else 
			echo "";
		}

	$mysqli->close();
?>