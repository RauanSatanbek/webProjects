<?php
	$host = "localhost";
	$user = "root";
	$password = "";
	$db = "ec125";

	$mysqli = new mysqli($host, $user, $password, $db);
	$mysqli->query("SET NAMES 'utf8'");
?>