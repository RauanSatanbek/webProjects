<?
	include("functions.php");
	include("db.php");
	$result = $mysqli->query("SELECT * FROM `users")->fetch_assoc();
	echo 465;
	if($_SESSION["user_is_logged"] == 1){
		$name = $_SESSION["user_name"] . " " . $_SESSION["user_surname"];
		$name = '<p class = "p">'.$name.'</p><hr>';
		$log = "";
	} else {
		$name = "";
		$log = '<li id = "login">Вход</li>
		<li id = "register">Регистрация</li>';
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../css/main.css">
</head>
<body>
	<div id = "body">
		<header>
			<ul>
				<li id = "main">Главная</li>
				<?echo $log;?>
			</ul>
		</header>
		<div class = "middle">
			<?
				echo register();
				echo login();
			?>
			<? echo $name;?>
			<p class = "p" id = "chats">Чаты</p>
			<p class = "p cp" id = "p1" >&#9650</p>
			<div class = "chats">
				<table id = "table">
					
				</table>
			</div>
			<hr>
			<p class = "p" id = "creat">Создать чат</p>
			<p class = "p cp" id = "p2" >&#9660</p>
			<div class = "creatchat">
				<input type="text" id = "tema" class = "input input2" placeholder = "Тема*">
				<select name="" id="number">
					<option value="5">5</option>
					<option value="10">10</option>
					<option value="15">15</option>
					<option value="20">20</option>
				</select>
				<p class = "p3">Число людей</p>
				<input type="button" value = "Создать" class ="button"  id = "creatchat">
			</div>
			<hr>
		</div>
		<footer></footer>
	</div>
</body>
</html>