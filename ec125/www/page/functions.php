<?php
	date_default_timezone_set('Asia/Almaty'); 
	function isLogin(){
		if($_SESSION["user_is_logged"] != 1){
			exit ("Это страница вам недоступно , чтобы зайти на эту страницу  выполните <a href='index.php' id = 'loginA'>вход</a>");
		}
	}
	function profile1(){
		// if($_SESSION["type"] != 1) exit(header("Location: index.php"));
	}
	function profile2(){
		// if($_SESSION["type"] != 2) exit(header("Location: index.php"));
	}
	function profile3(){
		// if($_SESSION["type"] != 3) exit(header("Location: index.php"));
	}
	function profile4(){
		// if($_SESSION["type"] != 4) exit(header("Location: index.php"));
	}
	function profile5(){
		// if($_SESSION["type"] != 5) exit(header("Location: index.php"));
	}
	function profile6(){
		// if($_SESSION["type"] != 6) exit(header("Location: index.php"));
	}
?>