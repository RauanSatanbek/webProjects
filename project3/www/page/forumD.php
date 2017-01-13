<?php
	include("functions.php");
	if(isset($_POST["questionId"])){
		$_SESSION["questionId"] = $_POST["questionId"];
		exit($_SESSION["questionId"]);
	}
	include("../resource/imports.php");
	include("db.php");
?>	
<style>
	.af{
		background: #445;
	}
	.button{
		width: 100px;
		margin-left: 120px;
		margin-top: 10px;
		margin-bottom: 10px;

	}
</style><div id = "bodyDTest"></div>
<div class = "dialog">
	<div class = "headD"></div>
	<div class = "bodyD">
		

		
	</div>

	<div class = "footD">
		<textarea name="" id="question" class = "textarea1"></textarea>
		<button class = "button" id = "sendQuestion">Отправить</button>
	</div>
</div>


<!-- <div class = "forumD other">
	<div class = "infoQuestion">
		<div class = "infoUserForum">
			<p class = "name">'+name+'</p>
			<p class = "time">'+time+'</p>
		</div>
		<div class = "messageForum">'+question+'</div>
		<div class = "openComment">
			<p class = "openAndClose open" id = "'+(i + 1)+'">Ответить</p>
		</div>
	</div>
</div> -->

