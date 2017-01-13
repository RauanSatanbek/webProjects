<?php
	session_start();

	if(isset($_SESSION["user_is_logged"]) && $_SESSION["user_is_logged"] == 1) $reg = '<li><a id = "logout"  >Выход</a></li>';
	else{
		$reg = '<li><a id = "login"  data-toggle="modal" data-target=".bs-example-modal-sm">Вход</a></li>
				<li><a id = "register"  data-toggle="modal" data-target=".bs-example-modal-md">Регистрация</a></li>';
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="../js/jquery-1.12.1.min.js"></script>
	<script src="../Bootstrap3/js/bootstrap.js"></script>
	<link href="../Bootstrap3/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="../font-awesome-4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/dialog.css">
	<script src = "../js/scripts.js"></script>
	<script src = "../js/reg.js"></script>
	<script src = "../js/groupChat.js"></script>
</head>
<body>
	<div class="modal-show">
		<p class="modal-show-close"><i class="fa fa-times" aria-hidden="true"></i></p>
		<div class="modal-show-body">
		 	<p id = "text"></p>
	    </div>
	</div>
	<div class="navbar navbar-fixed-top">
		<div class="container">
			<div class="navbar-header navbar-toggle" data-toggle = "collapse" data-target = "#collapse">
				<button class = "navbar-button">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse" id = "collapse">
				<ul class="nav navbar-nav">
					<li><a id = "main">Главная</a></li>
					<?echo $reg;?>
				</ul>
			<p class="user-name"><?=$_SESSION["user_name"]?></p>
			</div>
		</div>
	</div>
	<div class="container middle">
	<!-- <button type="button"  class="btn btn-primary"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></button> -->
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col">
				<p class="p">Создать</p> 
				<p class="p">Создать</p> 
				<p class="p">Создать</p> 
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1 col">
			<p class="p chat-chats">Чаты <span class = "chat-open" id = "1">&#9658</span></p>
			<div class="Hide">
				<table class="table">
					<tr>
						<th>#</th>
						<th>2s</th>
						<th>3s</th>
					</tr>
					<tr>
						<td>1</td>
						<td>2</td>
						<td>3</td>
					</tr>
					<tr>
						<td>4</td>
						<td>5</td>
						<td>6</td>
					</tr>
					<tr>
						<td>7</td>
						<td>8</td>
						<td>9</td>
					</tr>
				</table>
			</div>
			<p class="p chat-dialog">Диалог <span class = "chat-open" id = "1">&#9658</span></p>
				
				<!-- <form action="" class="form-inline">
					<div class="input-group">
						<input type=""  class="form-control">
						<div class="input-group-addon">12</div>
					</div>
				</form> -->
				<style>
					.name{border-bottom: 1px solid silver}
				</style>
				<!-- <div class = "dialog">
						<div class = "headD"></div>
						<div class = "bodyD"></div>
						<div id = "bodyDTest"></div>
						<div class = "footD">
							<textarea name="" id="message" class = "textarea1 message"></textarea>
							<input type = "button" id="0" class = "sendMessage" value = "Отправить">
						</div>
					</div> -->
				<div class="chat-block">
					<div class="chat-header"></div>
						<div id = "bodyDTest"></div>
					<div class="chat-body">
						<div class="chat-message message-me">
							<p class = "name">Rauan Satanbek</p>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi, id.</p>
						</div>
						<div class="chat-message message-other">
							<p class = "name">Rauan Satanbek</p>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo sit similique saepe earum doloremque? Asperiores accusantium accusamus, quasi at nam.</p>
						</div>
					</div>
					<div class="chat-footer">
						<form class="form-inline">
							<textarea class="chat-textarea" rows = "3"  id="message"></textarea>
							<button type = "button" class="btn btn-default chat-button">Отправить</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Регистрация &  Вход-->
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	  <div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></button>
	        <h3 class="modal-title" id="gridSystemModalLabel">Вход</h3>
	      </div>
	      <div class="modal-body">
	      	<form class="form-horizantal">
	      		<input type="text" class="form-control" placeholder = "Логин" id = "login1"><p></p>
	      		<input type="password" class="form-control" placeholder = "Пароль" id = "password"><p></p>
	      		<button type = "button" class="btn btn-primary button" id = "sendLog">Вход</button>
	      	</form>
	      </div>
	    </div>
	  </div>
	</div>

<div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></button>
				<h3 class="modal-title" id="gridSystemModalLabel">Регистрация</h3>
			</div>
			<div class="modal-body">
				<form class="form-horizantal">
					<input type="text" class="form-control" placeholder = "Имя фомилия" id = "name">
					<p class = "error" id = "e_n"></p>
					<input type="text" class="form-control" placeholder = "Логин" id = "login2">
					<p class = "error" id = "e_l"></p>
					<input type="password" class="form-control" placeholder = "Пароль" id = "password1">
					<p class = "error" id = "e_p1"></p>
					<input type="password" class="form-control" placeholder = "Повторите пороль" id = "password2">
					<p class = "error" id = "e_p2"></p>
					<button type = "button" class="btn btn-primary button" id = "sendReg">Регистрация</button>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>