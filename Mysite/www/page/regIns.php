<?
	// sleep(1);
	$mysqli = connectToDb();

	$name = $_POST["name"];
	$surname = $_POST["surname"];
	$tel = $_POST["tel"];
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
	$r = $mysqli->query("SELECT `login` FROM `users`");
	printsql($r);
	if (!$c){
		$mysqli->query("INSERT INTO `users` (`name`, `surname`, `tel`, `login`, `password`) VALUES ('".$name."', '".$surname."', '".$tel."', '".$login."', '".md5($password)."')");
		$info = $mysqli->query("SELECT * FROM `users` WHERE login = '".$login."'");
		$info = $info->fetch_assoc();
		$_SESSION["user_login_in"] = 1;
		$_SESSION["user_id"] = $info["id"];
		$_SESSION["user_name"] = $info["name"];
		$_SESSION["user_surname"] = $info["surname"];
		$_SESSION["user_login"] = $info["login"];
		$_SESSION["user_tel"] = $info["tel"];
		$_SESSION["user_avatar"] = $info["avatar"];
		$_SESSION["user_is_logged"] = 1;
		echo true;

	}
	else 
		echo false;
	$mysqli->close();

?>