<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src = "../js/jquery-1.12.1.min.js"></script>
	<script>
		$(document).ready(function(){
			$(document).mousemove(function(e){
				var x = e.pageX;
				var y = e.pageY;
				$(".div").css("margin", (y - 60) + "px " + (x - 70) + "px");
			})
		});
	</script>
	<style>
		.div{
			width: 150px;
			height: 150px;
			border-radius: 50%;
			box-shadow: 0 0 30px rgba(0,0,0,.5);
		}
	</style>
</head>
<body>
	<div class = "div"></div>
</body>
</html>