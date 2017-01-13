<?php
	include("functions.php");
	include("../resource/imports.php");
	include("db.php");
	head("Диалоги");
	sidebar_left();
	include("menu.php");
	container();
?>
<script>
	$(document).ready(function(){});
</script>
<style>
	.blockMessage{
		width: 690px;
		height: 80px;
		overflow: hidden;
		/*background: #f0f0f0;*/
		/*margin:5px; */
	}
	.photoMessage{
		width: 80px;
		height: 80px;
		float: left;
		overflow: hidden;
	}
	.photoMessage2{
		margin-left: -15px;
		margin-top: -25px;
	}
	.nameMessage{
		width: 610px;
		height: 100px;
		float: right;
		padding-top: 20px;
		/*background: green;*/
	}
	.pMessage{
		margin-left: 10px;
		margin-top: 10px;
	}
</style>
<div class = "dialog">
	<div class = "headD"></div>
	<div class = "bodyD">
		<?php
			$from = $_SESSION["user_id"];
			$result = $mysqli->query("SELECT * FROM `dialog` WHERE `from` = '$from' OR `to` = '$from'");
			$m = array();
			while (($row = $result->fetch_assoc()) != false) {
				if($from != $row["from"] AND $from == $row["to"]) $m[] = $row["from"];
				else if($from != $row["to"] AND $from == $row["from"]) $m[] = $row["to"];
				
			}
			$m = array_unique($m);
			$num = count($m);
			$hr = "";
			$c = 1;
			foreach ($m as $key => $value) {
				$row = $mysqli->query("SELECT * FROM `users` WHERE `id` = '$value'")->fetch_assoc();
				$name = $row["name"];
				$surname = $row["surname"];
				$avatar = $row["avatar"];
				$id = $row["id"];
				$name = $name . " " . $surname;
				if($c < $num) $hr = "<hr>";
				else $hr = "";
				echo '<div class = "blockMessage">
						<div class = "photoMessage"><img src = "../img/avatars/'.$avatar.'" width = "130" height="auto" alt="" class = "photoMessage2"></div>
						<div class = "nameMessage">
							<p class = "pMessage"><a class = "au a" id = "'.$id.'">'.$name.'</a></p>
							<p class = "pMessage"><a class = "a awm" id = "'.$id.'">Написать сообщение</a></p>
						</div>
					</div>' . $hr;
				$c++;
			}
				

		?>
		
		
	</div>
</div>	
<?
	sidebar_right();
	include("allUsers.php");
?>