<?php
	session_start();
	include("db.php");
		$to = $_SESSION["toUserId"];
		$from = $_SESSION["user_id"];
		$result = $mysqli->query("SELECT `name`, `surname` FROM `users` WHERE `id` = '2'")->fetch_assoc();
		print_r($result);
		$mysqli->close();
?>