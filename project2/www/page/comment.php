<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src = "../js/jquery-1.12.1.min.js"></script>
		<link rel="stylesheet" href="../css/comment.css">
		<script src = "../js/comment.js"></script>

</head>

<body>
	<div class = "comment">
		<header class = "commenthead"></header>
		<div class = "commentWrite">
			<div id = "commentPhoto"><img src = "../img/avatars/2.jpeg"  width = "110" height="auto" alt="" id = "userPhoto"></div>
			<textarea name="" class="commentTextarea" placeholder = "Ваш ответ..."></textarea>
			<button class = "commentButton" id = "commentButton"> Отправить </button>
		</div>
		<div class = "commentBody">

		</div>
	</div>
</body>
</html>
