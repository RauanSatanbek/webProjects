<?
	include("functions.php");
	// include("db.php");
	// $result = $mysqli->query("SELECT * FROM `users")->fetch_assoc();
	// echo $result["name"];
	// if($_SESSION["user_is_logged"] == 1){
	// 	$name = $_SESSION["user_name"] . " " . $_SESSION["user_surname"];
	// 	$name = '<p class = "p">'.$name.'</p><hr>';
	// 	$log = "";
	// } else {
	// 	$name = "";
	// 	$log = '<td><p  class = "navP" id = "login">Вход</p></td>
	// 	<td><p  class = "navP" id = "register">Регистрация</p></td>';
	// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src = "../js/jquery-1.12.1.min.js"></script>
	<script src = "../js/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="../css/register.css">
	<script src = "../js/reg.js"></script>
	<script src = "../js/log.js"></script>
	<link rel="stylesheet" href="../css/dialog.css">
	<link rel="stylesheet" href="../css/main.css">
	<script src = "../js/groupChat.js"></script>
</head>
<body>
	<style>
		
	</style>
	<div class="container">
		<div class="middle">
			<header>
				<table>
					<tr>
						<td><p class = "navP" id ="main">Главная</p></td>
						<?=$log?>
					</tr>
				</table>
			</header>
			<?
				echo register();
				echo login();
			?>
			<div class="body">
				<div class = "dialog">
					<div class = "headD"></div>
					<div class = "bodyD"></div>
					<div id = "bodyDTest"></div>
					<div class = "footD">
						<textarea name="" id="message" class = "textarea1 message"></textarea>
						<input type = "button" id="0" class = "sendMessage" value = "Отправить">
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>