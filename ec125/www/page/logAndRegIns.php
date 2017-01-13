<?php
	session_start();
	include("db.php");
	if($_POST["bool"] == "1"){
		$userId = htmlspecialchars($_POST["ID"]);
		$password = htmlspecialchars($_POST["password"]);
		$type = $_POST["type"];

		for($i = 0; $i < 10; $i++){ $password = md5($password);}
		$row = $mysqli->query("SELECT * FROM `users` WHERE `userId` = '".$userId."' AND `password` = '".$password."'");
		$row = $row->fetch_assoc();
		if($row["userId"] != false){
			$info = $mysqli->query("SELECT * FROM `users` WHERE`userId` = '".$userId."'");
			$info = $info->fetch_assoc();
			if($type != $info['who']) exit("");
			else if($type == 1) $_SESSION["user_id"] = $info["id"];
			else if($type == 2) {
				// $result = $mysqli->query("SELECT `who`,`curator` FROM `users` WHERE `id` = '".$info["id"]."'")->fetch_assoc();
				// $_SESSION["user_id"] = $result["curator"];
				$_SESSION["user_id"] = $info["id"];
				$_SESSION["who"] = $info["who"];
				$_SESSION["name"] = $info["name"];
				$_SESSION["type"] = $info["type"];
			}
			$_SESSION["user_is_logged"] = 1;
			echo "1";
		} else {
			echo "";
		}
		$mysqli->close();
	}

    else if($_POST["bool"] == 2){
		$all = $_POST["all"];
		list($name, $tel, $nameF, $tel2, $nameM, $tel3, $address,$school,$subject,$children, $contract) = explode(":", $all);
		$name = htmlspecialchars($name);
		$tel = htmlspecialchars($tel);
		$nameF = htmlspecialchars($nameF);
		$tel2 = htmlspecialchars($tel2);
		$nameM = htmlspecialchars($nameM);
		$tel3 = htmlspecialchars($tel3);
		$address = htmlspecialchars($address);
		$subject = htmlspecialchars($subject);
		// while(true){
		// $userId = rand(1000000, 9999999);
		$result = $mysqli->query("SELECT `userId` FROM `users` ORDER BY `id` DESC")->fetch_assoc();
		$userId = (int)$result["userId"] + 1;
		// if($result['name'] == false) break;
		// }
		$password = $userId;
		$password2 = $password;
		$num = 0;

		for($i = 0; $i < 10; $i++) $password = md5($password);
		$c = false;
		$row = $mysqli->query("SELECT * FROM `users` WHERE `userId` = '".$userId."'")->fetch_assoc();
		if($row["userId"] == false){
				$mysqli->query("INSERT INTO `users`( `name`, `tel`, `nameF`, `tel2`, `nameM`, `tel3`, `address`, `subject`, `userId`, `password`, `contract`, `group`, `status`, `type`, `date`) VALUES('','','','','','','','','".$userId."','','".$contract."', '','1','1','0000-00-00')");
				$mysqli->query("UPDATE `users` SET `name`='".$name."', `tel` = '".$tel."', `nameF` = '".$nameF."',  `tel2` = '".$tel2."',  `nameM` = '".$nameM."', `tel3` = '".$tel3."',  `address` = '".$address."',`school` = '".$school."',`numberChildren` = '".$children."',`subject` = '".$subject."', `password` = '".$password."' ,`group` = '0', `status` = '".$num."', `date` = '".date("Y:m:d")."' WHERE `userId` = '" .$userId. "' ");
				// $info = $mysqli->query("SELECT * FROM `users` WHERE`userId` = '".$userId."'");
				// $info = $info->fetch_assoc();
				// $_SESSION["user_id"] = $info["id"];
				// $_SESSION["who"] = $info["who"];
				// $_SESSION["type"] = $info["type"];
				// $_SESSION["name"] = $info["name"];
				// $_SESSION["user_is_logged"] = 1;
				echo $userId . ":" . $password2 . ":" . $name;
		}
		else echo 1;

		$mysqli->close();
	}
	else if($_POST["bool"] == 3){
		unset($_SESSION["user_is_logged"]);
		unset($_SESSION["user_id"]);
		unset($_SESSION["who"]);
		session_destroy();
		echo 1;
	}
?>