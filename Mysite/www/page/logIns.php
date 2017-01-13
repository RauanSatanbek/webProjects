<?
	session_start();
	sleep(2);
	$login = $_POST["login"];
	$password = $_POST["password"];
	$bool = false;
	// function printsql ($r){
	// 	global $bool;
	// 	while(($row = $r->fetch_assoc()) != false){
	// 		if($row["password"] == md5("rauan")){
	// 			$bool = true;
	// 			break;}
	// 	}
	// }
	$mysqli = new mysqli("localhost", "root", "", "project");
	$mysqli->query("SET NAMES 'utf8'");
	$r = $mysqli->query("SELECT `login` , `password` FROM `users` WHERE login = '".$login."'");
	$r = $r->fetch_assoc();

	if($r["password"] == md5($password)){
		$bool = true;
	}

	// else{
	// 	echo $password . "  no";
	// }
	$info = $mysqli->query("SELECT * FROM `users` WHERE login = '".$login."'");
	$info = $info->fetch_assoc();
	if(empty($r) or !$bool){
		echo false;
	}
	else{;
		$_SESSION["user_login_in"] = 1;
		$_SESSION["user_id"] = $info["id"];
		$_SESSION["user_name"] = $info["name"];
		$_SESSION["user_surname"] = $info["surname"];
		$_SESSION["user_tel"] = $info["tel"];
		$_SESSION["user_login"] = $info["login"];
		$_SESSION["user_is_logged"] = 1;
		echo $_SESSION["user_name"];
	}
	$mysqli->close();
?>