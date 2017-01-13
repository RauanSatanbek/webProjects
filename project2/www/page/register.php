<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../css/all.css">
	<link rel="stylesheet" href="../css/register.css">
	<script src = "../js/jquery-1.12.1.min.js"></script>
</head>
<script src = "../js/reg.js">
</script>
<body>
	<style>
		span{
			color:#F08080;
			font-size: 14px;
		}
	</style>
	<div id = "registerForm">
		<form  class = "form">
			<input type="text" id = "name" class = "input" placeholder = "Имя*">
			<span id = "e_n"></span> <br>

			<input type="text" id = "surname"  class = "input" placeholder = "Фамилия*"> 
			<span id = "e_s"></span><br>

			<!-- <input type="tel" maxlength="12" id = "tel"  class = "input" placeholder = "Телефон*"> 
			<span id = "e_t"></span><br> -->
			
			<input type="text" id = "login2" class = "input"  placeholder = "Логин*"> 
			<span id = "e_l"></span><br>

			<input type="password" id = "password1"  class = "input" placeholder = "Пароль*"> 
			<span id = "e_p1"></span><br>

			<input type="password" id = "password2"  class = "input" placeholder = "Потверждение пароля*"> 
			<span id = "e_p2"></span><br>

			
			<input type="button" value = "Зарегистрироваться" class ="button" id = "sendReg" >
		</form>
		<center><p id = "infoReg"></p></center>
	</div>
</body>
</html>