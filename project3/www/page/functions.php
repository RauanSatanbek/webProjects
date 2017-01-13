<?php
	session_start();
	date_default_timezone_set('Asia/Almaty'); 
	include("../resource/imports.php");
	function register(){
		return '<style>
			
		</style>
		<div id = "registerForm">
			<form  class = "form">
				<input type="text" id = "name" class = "input" placeholder = "Имя*">
				<span id = "e_n" class = "span"></span> <br>

				<input type="text" id = "surname"  class = "input" placeholder = "Фамилия*"> 
				<span id = "e_s" class = "span"></span><br>

				<!-- <input type="tel" maxlength="12" id = "tel"  class = "input" placeholder = "Телефон*"> 
				<span id = "e_t" class = "span"></span><br> -->
				
				<input type="text" id = "login2" class = "input"  placeholder = "Логин*"> 
				<span id = "e_l" class = "span"></span><br>

				<input type="password" id = "password1"  class = "input" placeholder = "Пароль*"> 
				<span id = "e_p1" class = "span"></span><br>

				<input type="password" id = "password2"  class = "input" placeholder = "Потверждение пароля*"> 
				<span id = "e_p2" class = "span"></span><br>

				
				<input type="button" value = "Зарегистрироваться" class ="button" id = "sendReg" >
			</form>
			<center><p id = "infoReg"></p></center>
		</div>';
	}

	function login(){
		return '<div id = "loginForm">
			<form class = "form">
				<input type="text" id = "login1" class = "input" placeholder = "Логин*"><br>
				<input type="password" id = "password" class = "input" placeholder = "Пароль*"><br>
				<input type="button" value = "Вход" id = "sendLog" class = "button">
			</form>
			<center><p id = "infoLog"></p></center>
			</div>';
	}
	function head($title){
		if($_SESSION["user_is_logged"] == 1){
			$profile = '<li><a class = "a a1 ap"  title = "Профиль"  id = "Profile">Профиль</a></li>';
		} else {
			$profile = '<li><a class = "a a1 ar"  title = "Зарегистрироваться на сайт" id = "Register">Регистрация</a></li>
					<li><a class = "a a1 al"  title = "Вход на сайт"  id = "Login">Вход</a></li>';
		}
		echo '<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<title>'.$title.'</title>
			
		</head>

		<script>
			
		</script>
		<body>
		<div class = "wrapper">
			<header>
				<ul class="nav">
					<li><a class = "a a1 am" href = "main.php" title = "На главную">Главная</a>
						<ul class="nav-sub">
							<li><a href="">События</a></li>
							<li><a href="">Спорт</a></li>
							<li><a href="">О бизнесе</a></li>
							<li><a href="">Контакты</a></li>
						</ul>
					</li>
					<li><a class = "a a1 an"  title = "Новости">Новости</a>
						<ul class="nav-sub">
							<li><a href="">События</a></li>
							<li><a href="">Спорт</a></li>
							<li><a href="">О бизнесе</a></li>
							<li><a href="">Контакты</a></li>
						</ul>
					</li>
					<li><a class = "a a1 af" href="forum.php" title = "Форум">Форум</a></li>'.$profile.'
					<!-- <li><h2 class = "Name">125 Білім беру орталығы</h2></li> -->
					
					<!-- <li><input type="search" id = "search" placeholder = "Search"></li> -->
					
					<!-- <li><p>
						<?
							// if(isset($_SESSION["user_surname"])){
							// 	echo $_SESSION["user_surname"];
							// }
						?>
					</p></li> -->
				</ul>
			</header>' . register() . login();
	}
	function sidebar_left(){
		echo '<div class = "middle">
		<aside class = "sidebar-left">';
	}
	function container(){
		echo '</aside>
		<div class = "container">
			<main class = "main">';
	}

	function sidebar_right(){
		echo '</main>
			</div>
			<aside class = "sidebar-right">';
	}
	function footer(){
		echo '</aside>
		</div><footer></footer>
		</div>';
	}

?>