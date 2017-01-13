<?php
	$host = "localhost";
	$user = "root";
	$password = "";
	$db = "project";

	$mysqli = new mysqli($host, $user, $password, $db);
	$mysqli->query("SET NAMES 'utf8'");
?>