<?php
	include("functions.php");
	if(isset($_POST["subject_id"])){
		$_SESSION["subject_id"] = $_POST["subject_id"];
	}
	include("../resource/imports.php");
	include("db.php");
	head("Форум");
	sidebar_left();
	include("menu.php");
	container();
?>
<style>
	.af{
		background: #445;
	}
</style>
<script>
	$(document).ready(function(){
		$(".subject").on("click", function(){
			var id = $(this).get(0).id;
			$.ajax({
				url:"forum.php",
				type:"post",
				data:({subject_id:id}),
				dataType:"html",
				success:function(data){
					document.location.replace("forumD.php");
				}
			});
		});
	});
</script>
<style>
	
</style>
<div class = "dialog">
	<div class = "headD"></div>
	<div class = "bodyD">
		<div class = "bodyF">
			<?php
				$m = array("Қазақ тілі","Орыс тілі","Математика","Қазақстан тарихы","Физика","Химия","География","Ағылшын тілі");
				for($i = 0; $i < count($m); $i++){
					echo "<p class = 'subject' id = '".($i + 1)."'>".$m[$i]."</p>";
				}
			?>
		</div>
	</div>
</div>	
<?
	sidebar_right();
	include("allUsers.php");
?>