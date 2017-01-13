<?
	echo head("Регистрация на сайте");
	echo allInfo();
?>
	<div id = "info" style = "color:red"></div>
	<div class = 'block'>
	<h2>Регистрация</h2>
	<form action="" id = 'form' >
		<label>Имя*</label><br>
		<input type="text" id = 'name' class = "input">
		<span id = "e_n"></span> <br>

		<label>Фамилия*</label><br>
		<input type="text" id = 'surname'  class = "input"> 
		<span id = "e_s"></span><br>

		<label>Телефон*</label><br>
		<input type="tel" maxlength="12" id = 'tel'  class = "input"> 
		<span id = "e_t"></span><br>
		
		<label>Логин*</label><br>
		<input type="text" id = 'login' class = "input" maxlength="15" pattern = "[A-Za-z-0-9]{5,15}" title = "Не менее 5 и неболее 15 латынских символов или цифр"> 
		<span id = "e_l"></span><br>

		<label>Пароль*</label><br>
		<input type="password" id = 'password1'  class = "input"> 
		<span id = "e_p1"></span><br>

		<label>Потверждение пароля*</label><br>
		<input type="password" id = 'password2'  class = "input"> 
		<span id = "e_p2"></span><br>

		<label>Какой код на картинке? *</label><br>
		<input type="text"  class = "captcha" id = "inputCaptcha">
		<div id = "captcha" class = "captcha"></div>
		<span id = "e_captcha"></span><br>
		<input type="button" value = '  Зарегистрироваться  ' class = 'button' id = 'sendReg' >
		<input type="button" value = '  Вход  ' class = 'button' id = 'sendLoginReg' ><br>
	</form>
	</div>
 <?echo foot();?>

