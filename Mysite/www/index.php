<?
	session_start();
	date_default_timezone_set('Asia/Almaty'); 

include("resource/imports.php");
	$_SESSION["like"] = 0;
		// unset( $_SESSION["userId"]);
?>
<script>
	$(document).ready(function(){
		$("#profile").on("click", function(){
				var removeAtherProfile = true;
				console.log(1230);
				$.ajax({
					url:"profile.php",
					type:"POST",
					dataType:"html",
					data:({removeAtherProfile:removeAtherProfile}),
					success:function(){
						console.log(123);
						document.location.replace("profile.php");
					}
				});
		});
	});
</script>
<?php
if($_SERVER["REQUEST_URI"] == "/"){
	$Page = "index.php";
	$Module = "index.php";
	} else {
		$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
		$path = explode("/",trim($path, "/"));
		$Page = array_shift($path);
		$Module = array_shift($path);
		if(!empty($Module)){
			$Param = array();
			for($i = 0; $i < count($path); $i++){
				$Param[$path[$i]] = $path[++$i];
			}
		}
	}
	if($Page == "index.php") include("page/index.php");
	else if($Page == "registration.php")include("page/registration.php");
	else if($Page == "login.php")include("page/login.php");
	else if($Page == "main.php")include("page/main.php");
	else if($Page == "logout.php") include("profile/logout.php");
	else if($Page == "news.php") include("page/news.php");
	else if($Page == "writeNews.php") include("page/writeNews.php");
	else if($Page == "allUsers.php") include("page/allUsers.php");
	else if($Page == "forum.php") include("page/forum.php");
	else if($Page == "profile.php") include("profile/profile.php");
	else if($Page == "message.php") include("page/message.php");
	else if($Page == "dialog.php") include("page/dialog.php");
	else if($Page == "test.php") include("test.php");
	// else if($Page == "module" and $Module == "test.php") include("module/test.php");

	function head($title){
		// $_SESSION["user_login_in"] = 2;
		// Если user не зарегистрирован
			$reklama = '<div id = "reklama"><img src="img/reklama/reklama1.jpg" alt="" class = "reklama"><img src="img/reklama/reklama2.jpg" alt="" class = "reklama"></div></div>';
			if($_SESSION["user_login_in"] != 1){
				$html = '<ul>
							<li><a href="registration.php" title = "Зарегистрироваться на сайт">Регистрация</a></li>
							<li><a href="login.php" title = "Вход на сайт">Вход</a></li>
						</ul>';
				$menu = '<div class = "menu" id = "menu">';
				// $menu = "";		
				}
		// Если user  зарегистрирован
			else if($_SESSION["user_login_in"] == 1){
				$html = '<ul>
						<li><a title = "Профиль" id = "profile">Профиль</a></li>
						<li><a href="profile/logout.php" title = "Выйти">Выйти</a></li>
					</ul>';
				$menu = '
						<div class = "menu" id = "menu">
							<ul >
								<!--<li><a href = "profile.php">Моя Страница</a></li>-->
								<li><a href = "allUsers.php">Все пользователи</a></li>
								<li><a href = "dialog.php">Мои Сообщения</a></li>
								<!--<li><a>Мои Фотографии</a></li>-->
							</ul>
						'."<br>";
			}

	return ('<!DOCTYPE html>
			<html lang="en">
			<head>
				<meta charset="UTF-8">
				<title>'.$title.'</title>
			</head>
			<style>

				</style>
				
			<body id = "body">
				<div id = "showImg"><img src="" alt="" width = "700" height = "auto"></div>
				<header>
					<span class = "left">
						<ul class="ul1">
							<li><a href="index.php" title = "На главную">Главная</a>
								<!-- <ul class="nav-sub">
									<li><a href="">События</a></li>
									<li><a href="">Спорт</a></li>
									<li><a href="">О бизнесе</a></li>
									<li><a href="">Контакты</a></li>
								</ul> -->
							</li>
							<li><a href="news.php" title = "Новости">Новости</a></li>
							<li><a href="forum.php" title = "Форум">Форум</a></li>
							<!-- <li><h2 class = "Name">125 Білім беру орталығы</h2></li> -->
						</ul>
					</span>
					<span class = "right">
						'.$html.'
					</span>
						<!-- <input type="search" placeholder = "Поиск" class = "search"> -->
				</header>
				<div class = "body">' . $menu . $reklama);
	}

	// function menu(){
	// 	return ('<div class = "body">
	// 		<div class = "menu" id = "menu">
	// 			<ul >
	// 				<li><a href = "module/test.php">Моя Страница</a></li>
	// 				<li><a>Мои Друзья</a></li>
	// 				<li><a>Мои Фотографии</a></li>
	// 			</ul>
	// 		</div>');
	// }
	function allInfo(){
		return("<div class = 'allInfo'>");
	}
	function foot(){
		return("</div>
				</div>
				<footer>
					Все права защищены &copy; ".date("Y")."
				</footer>
			</body>
			</html>");
	}

	function nowTime(){
		date_default_timezone_set('Asia/Almaty'); 
		echo date('H:i:s') . "\n";
	}
	// Невозможно зайти через адресную строку если user зашол ...
	// function ULogin($p){
	// 	if ($p <= 0 and $_SESSION["user_login_in"] != $p){
	// 		header("Location: page/index.php");
	// 	}

	// 	else if ($_SESSION["user_login_in"] == $p){
	// 		header("Location: page/index.php");
	// 	}
	// }


	function getAllFromDb($r){
		$result = array();
		while(($row = $r->fetch_assoc()) != false){
			$result[] = $row;
		}
		return $result;
	}
	//Проверяем если User не зашол на сайт то не пускаем его на некоторые страницы
	function isLogin(){
		if(!$_SESSION["user_is_logged"]){
			exit ("Это страница вам недоступно , чтобы зайти на эту страницу либо <a href='registration.php' class = 'isLoginTagA'>зарегистрируйтесь</a> либо выполните <a href='login.php' class = 'isLoginTagA'>вход</a>");
		}
	}

// add Image in folder
	function addImg($img, $path, $name){
			$tmp_name = $img["tmp_name"];
			$type = substr($img["type"],6);
			$size = $img["size"];
			if($type == "jpeg" || $type == "jpg" || $type == "png"){
				  $path = $path . $name ."." . $type; 
					move_uploaded_file($tmp_name, $path);
					$imgName = $name . "." . $type;
	 			} 
	 		else $imgName = "";

	 		return $imgName;
			// print_r($img);
			// echo "<br>" . $path;
			
			}
	// Базада сурет бар болса шыгарамыз жок болса шыгармаймыз
		function setImage($img, $path){
			if(!empty($img)) $img = "<img src = '../".$path."".$img."'  id = 'imgNews' width = '450' height = 'auto' class = 'showImg'></img>";
			else $img = "";
			return $img;
		}
	function connectToDb(){
		$host = "localhost";
		$root = "root";
		$password = "";
		$nameDb = "users";
		$mysqli = new mysqli($host,$root,$password, $nameDb);
		$mysqli->query("SET NAMES 'utf8'");
		return $mysqli;
	}
 ?>
