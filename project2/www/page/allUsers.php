<?
	session_start();
	if(isset($_POST["toUserId"])){
		$_SESSION["toUserId"] = $_POST["toUserId"];
		exit();
	}
?>
<div class = "headRight"><p>Все пользователи</p></div>
<div class = "bodyRight">
	<?php

		include("db.php");
		$result = $mysqli->query("SELECT * FROM `users` WHERE `id` != '".$_SESSION['user_id']."'");
		$num = $result->num_rows;
		$hr = "";
		$c = 1;
		while(($row = $result->fetch_assoc()) != false){
			if($c < $num) $hr = "<hr>";
			else $hr = "";
			$name = $row["name"];
			$surname = $row["surname"];
			$avatar = $row["avatar"];
			$id = $row["id"];
			$name = $name . " " . $surname;
			$c++;
			echo '<div class = "allUsers">
				<div class = "userPhoto"><img src = "../img/avatars/'.$avatar.'" width = "110" height="auto" alt="" id = "userPhoto"></div>
				<div class = "userInfo">
					<p><a class = "au a" id = "'.$id.'">'.$name.'</a></p>
					<p><a class = "a awm" id = "'.$id.'">Написать сообщение</a></p>
				</div>
			</div>' . $hr;
		}
	?>
</div>