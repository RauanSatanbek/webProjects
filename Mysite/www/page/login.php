<?
	echo head("Вход на сайт");
	echo allInfo();

?>
<script src = "../js/login.js"></script>
<div class = 'block'>
<h2>Вход</h2>
	<form action="" id = 'form' >	
		<label>Логин*</label><br>
		<input type="text" id = 'login' class = "input"> 
		<span id = "e_l"></span><br>

		<label>Пароль*</label><br>
		<input type="password" id = 'password'  class = "input"> 
		<span id = "e_p1"></span><br>
		
		<label>Какой код на картинке? *</label><br>
		<input type="text"  class = "captcha" id = "inputCaptcha"> <div id = "captcha" class = "captcha"></div>
		<span id = "e_captcha"></span><br>

		<input type="button" value = '  Войти  ' class = 'button' id = 'sendLog' ><input type="button" value = '  Регистрация  ' class = 'button' id = 'sendRegLogin' ><br>
	</form>

</div>
	<center id = "center">
		<div class = "infoImg" id = "info" style = "color:#333"></div>
		<img class = "infoImg" height="16" width="16" alt="" id = "loading" style = "display:none;">
	</center>
 <?echo foot();?>


