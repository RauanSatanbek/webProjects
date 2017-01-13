<?php
	session_start();
	include("db.php");
	if($_POST["bool"] == 1){
		$m = array("name"=>$_POST["name"],"surname"=>$_POST["surname"]);
		$n = array("name","surname");
		$s = "";
		foreach($m as $key=>$i){
			if(!empty($i))
				$s .= "`$key` = '$i',";
		}
		$s = substr($s,0,-1);
		$mysqli->query("UPDATE `users` SET ".$s." WHERE `id` = '".$_SESSION["user_id"]."'");
		for($i = 0; $i < count($n); $i++){
			if(!empty($_POST[$n[$i]])){
				$_SESSION["user_" . $n[$i]] = $_POST[$n[$i]];
			}
		}
		echo $_SESSION['user_id'];
	}

	$mysqli->close();
?>