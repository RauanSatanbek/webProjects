<?php
	session_start();
	include("db.php");
	if( $_POST["bool"] == 1 ){
		$tema = $_POST["tema"];
		$number = $_POST["number"];
		$name = $_SESSION["user_name"] . " " . $_SESSION["user_surname"];
		$mysqli->query("INSERT INTO `chats`(`user`, `tema`, `number`) VALUES ('$name', '$tema', '$number')");
		$mysqli->close();
	}
	else if($_POST["bool"] == 2){
		$result = $mysqli->query("SELECT * FROM `chats` ORDER BY `id` DESC");
		$c = $result->num_rows;
		$m = array();
		for($i = 0; $i < $c; $i++){
			$row = $result->fetch_assoc();
			$user = $row["user"];
			$tema = $row["tema"];
			$number = $row["number"];
			$users = $row["users"];
			$n = array($user, $tema, $number, $users);
			$m[] = $n;
		}
		echo json_encode($m);
}
?>