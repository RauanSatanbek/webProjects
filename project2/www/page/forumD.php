<?php
	include("functions.php");
	if(isset($_POST["questionId"])){
		$_SESSION["questionId"] = $_POST["questionId"];
		exit($_SESSION["questionId"]);
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
	$(".dialog").delegate(".open", "click", function(){
			// --------------------------
				$(".answers").slideUp(400);
				$('.close').hide();
				$('.open').show();
				// loadComment();
			// --------------------------
			$(this).next().next().slideDown(800);
			$(this).next().show();
			$(this).hide();
			var id = $(this).get(0).id;
			$.ajax({
				url:"forumD.php",
				type:"post",
				data:({questionId:id}),
				dataType:"html",
				success:function(data){
					console.log(data);
				}
			});
	});
	$(".dialog").delegate(".close", "click", function(){
		$(this).next().slideUp(800);
		$(this).prev().show();
		$(this).hide();
	});


	$("#sendQuestion").click(function(){
		var question = $("#question").val();
		$.ajax({
			url:"addAndGetForum.php",
			type:"post",
			data:({bool:1,question:question}),
			success:function(data){
				getMessage();
			}
		});
		
		 $("#question").val("");
	});


// load message
	var c = 1;
	function getMessage(){
		$.ajax({
			url:"addAndGetForum.php",
			type:"post",
			data:({bool:2}),
			dataType:"json",
			success:function(data){
				$(".bodyD").html("");
				for (var i = 0; i < data.length; i++){
					
					var avatar = data[i][0];
					var name = data[i][1];
					var question = data[i][2];
					var time = data[i][3];
					var user_avatar = data[i][4];
					$(".bodyD").prepend('<div class = "forumD"><div class = "userPhotoForum"><div class = "photoForum"><img src="../img/avatars/'+avatar+'" alt="" width="140" height="auto"></div></div><div class = "infoQuestion"><div class = "infoUserForum"><p class = "name">'+name+'</p><p class = "time">'+time+'</p></div><div class = "messageForum">'+question+'</div><div class = "openComment"><p class = "openAndClose open" id = "'+(i + 1)+'">Ответить</p><p class = "openAndClose close">Закрыть</p><div class = "answers"><header class = "commenthead"></header><div class = "commentWrite"><div id = "commentPhoto"><img src = "../img/avatars/'+user_avatar+'"  width = "110" height="auto" alt="" id = "userPhoto"></div><textarea name="" class="commentTextarea" placeholder = "Ваш ответ..."></textarea><button class = "commentButton" id = "commentButton"> Отправить </button></div><div class = "commentBody"></div></div></div></div></div></div>');

				}
				// if(c == 1){
				// 	var text = $(".bodyD").html();
				// 	$("#bodyDTest").html(text);
				// 	var len = $("#bodyDTest").css("height").length;
				// 	var height = $("#bodyDTest").css("height").substr(0, len - 2);
				// 	$(".bodyD").scrollTop(height + 1000000);
				// 	c++;
				// }
				// getMessage();
			}
		});
		
		
	}
	getMessage();
	// setInterval(getMessage,2000);
});
</script>
<style>
.button{
	width: 100px;
	margin-left: 120px;
	margin-top: 10px;
	margin-bottom: 10px;

}
</style>
<div class = "dialog">
	<div class = "headD"></div>
	<div class = "bodyD">
		

		
	</div>
	<div class = "footD">
		<textarea name="" id="question" class = "textarea1"></textarea>
		<button class = "button" id = "sendQuestion">Отправить</button>
	</div>
</div>	
<?
	sidebar_right();
	include("allUsers.php");
?>

<!-- <div class = "forumD">
	<div class = "userPhotoForum">
		<div class = "photoForum">
			<img src="../img/avatars/2.jpeg" alt="" width="140" height="auto">
		</div>
	</div>
	<div class = "infoQuestion">
		<div class = "infoUserForum">
			<p class = "name">Rauan Satanbek</p>
			<p class = "time">2016-05-31 17:53:43</p>
		</div>
		<div class = "messageForum">Lorem60 </div>
		<div class = "openComment">
			<p class = "openAndClose open">Ответить</p>
			<p class = "openAndClose close">Закрыть</p>
			<div id = "answers">
				<div class = "comment">
					<header class = "commenthead"></header>
					<div class = "commentWrite">
						<div id = "commentPhoto"></div>
						<textarea name="" class="commentTextarea" placeholder = "Ваш ответ..."></textarea>
						<button class = "commentButton" id = "commentButton"> Отправить </button>
					</div>
					<div class = "commentBody">

					</div>
				</div>
			</div>
		</div>
	</div>
</div> -->
