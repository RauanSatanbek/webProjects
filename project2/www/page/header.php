<?session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../css/headAndFoot.css">
	<link rel="stylesheet" href="../css/all.css">
	<script src = "../js/jquery-1.12.1.min.js"></script>
</head>

<script>
	
</script>
<body>
<div class = "wrapper">
	<header>
		<ul class="nav">
			<li><a title = "На главную">Главная</a>
				<ul class="nav-sub">
					<li><a href="">События</a></li>
					<li><a href="">Спорт</a></li>
					<li><a href="">О бизнесе</a></li>
					<li><a href="">Контакты</a></li>
				</ul>
			</li>
			<li><a  title = "Новости">Новости</a>
				<ul class="nav-sub">
					<li><a href="">События</a></li>
					<li><a href="">Спорт</a></li>
					<li><a href="">О бизнесе</a></li>
					<li><a href="">Контакты</a></li>
				</ul>
			</li>
			<li><a href="" title = "Форум">Форум</a></li>
			<!-- <li><h2 class = "Name">125 Білім беру орталығы</h2></li> -->
			<li><a  title = "Зарегистрироваться на сайт" id = "Register">Регистрация</a></li>
			<li><a  title = "Вход на сайт"  id = "Login">Вход</a></li>
			<!-- <li><input type="search" id = "search" placeholder = "Search"></li> -->
			<li><a href="profile.php" title = "Профиль"  id = "Login">Профиль</a></li>
			<!-- <li><p>
				<?
					// if(isset($_SESSION["user_surname"])){
					// 	echo $_SESSION["user_surname"];
					// }
				?>
			</p></li> -->
		</ul>
	</header>
	<?
		include("login.php");
		include("register.php");
	?>
	<div class = "middle">

		<aside class = "sidebar-left"></aside>
		<div class = "container">
			<main class = "main"></main>
		</div>
		<aside class = "sidebar-right"></aside>
	</div>
	<footer></footer>
</div>
</body>
</html>