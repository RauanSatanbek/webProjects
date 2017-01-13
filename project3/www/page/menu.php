<?
	session_start();
	if(isset($_POST["toUserId"])){
		$_SESSION["toUserId"] = $_POST["toUserId"];
		exit();
	}
?>

<style>
	.mP{
		padding-left: 10px;
		color:#334;
		width: 250px;
		height: 25px;
		line-height: 25px;
		margin-top:1px;
	}

	.mP:hover{
		transition:.7s;
		padding-left: 30px;
		cursor:pointer;
		background: #f0f0f0;
	}
	.mP a{
		text-decoration: none;

		color:#334;
	}
</style>

<script>
	$(document).ready(function(){
		$(".mP").click(function(){
			console.log(45);
		});
	});
</script>
<div class = "headRight"><p>Меню</p></div>
<div class = "bodyRight">
	<p class = "mP"><a href="profile.php" class = "a">Мая страница</a></p>
	<p class = "mP"><a href="messages.php" class = "a">Мой сообщение</a></p>
	<p class = "mP">Lorem ipsum.</p>
	<p class = "mP">Ea, corrupti!</p>
</div>