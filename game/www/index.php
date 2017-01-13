<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Game</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="font-awesome-4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" href="Bootstrap3/css/bootstrap.css">
	<script src = "js/jquery-1.12.1.min.js"></script>
	<script src = "js/scripts.js"></script>
</head>
<body>
<div class="count"><p id="number">0</p></div>
<p class="hearts">
	<i class="fa fa-heart heart1" aria-hidden="true"></i>
	<i class="fa fa-heart heart2" aria-hidden="true"></i>
	<i class="fa fa-heart heart3" aria-hidden="true"></i>
</p>
<div class="container">
	<div class="row">
		<center	>
			<div class="cols">
			<button type = "button" class = "btn-left"><p><i class="fa fa-chevron-left" aria-hidden="true"></i></p></button>
				<div class="col col1">
					<div class="finish"></div>
					<div class="finish finish2"></div>
					<div class="rect" id = "rect1"></div>
					<div class="rect rect2" id = "rect12"></div>
					<div class="player" id = "player1"></div>
				</div>
				<div class="col col2">
					<div class="finish"></div>
					<div class="rect rect2" id = "rect2"></div>
					<div class="player" id = "player2"></div>
					<div class="finish finish2"></div>
				</div>
				<div class="col col3">
					<div class="finish"></div>
					<div class="rect" id = "rect3"></div>
					<div class="player"  id = "player3"></div>
					<div class="finish finish2"></div>
				</div>
		<button type = "button" class = "btn-right"><p><i class="fa fa-chevron-right" aria-hidden="true"></i></p></button>
			</div>
		</center>
		<footer>
			<p class = "foot-text"></p><p class="game-over">Game Over !!! </p>
		</footer>
		<p class="advice-text">Используйте эти клавиши <img src="img/keyboard.png" alt=""></p>
				
	</div>
</div>
</body>
</html>