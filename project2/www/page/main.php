<?php

	include("functions.php");
	if(isset($_POST["user"])){
		// for other users
		if($_POST["user"] == 2){
			$_SESSION["userId"] = $_POST["userId"];
			$_SESSION["profile"] = 2;
			exit();
		}
		//  for me
		else if($_POST["user"] == 1){
			$_SESSION["userId"] = $_SESSION["user_id"];
			$_SESSION["profile"] = 1;
			exit();
		}
	}
	include("../resource/imports.php");

	head("Главная");
	sidebar_left();
	include("menu.php");
	container();
	sidebar_right();

	include("allUsers.php");

?>

<script>
	$(document).ready(function(){
		$(".a").on("click", function(){
			$(this).css("background","#445");
			console.log($(this).css("marginLeft"));
		});
	});

</script>
<style> 
	.container{
		height: 550px;
	}
	.am{
		background: #445;
	}
	
</style>
<?footer();?>