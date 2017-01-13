<?php
	include("functions.php");
	include("../resource/imports.php");
	include("db.php");
	head("Профиль");
	sidebar_left();
	include("menu.php");
	container();
?>	
<script>
	$(document).ready(function(){
		

		// send message
			$("#sendMessage").click(function(){
				var message = $("#message").val();
				$.ajax({
					url:"addAndGetMessage.php",
					type:"post",
					data:({bool:1,message:message})
				});
				 $("#message").val("");
			});
		// load message
			var c = 1;
			function getMessage(){
				$.ajax({
					url:"addAndGetMessage.php",
					type:"post",
					data:({bool:2}),
					dataType:"json",
					success:function(data){
						$(".bodyD").html("");
						for (var i = 0; i < data.length; i++){
							// console.log(data[i]);
							var name = data[i][0];
							var message = data[i][1];
							var time = data[i][2];
							var class1 = data[i][3];
							
							$(".bodyD").append('<div class = "message '+class1+'"><div class = "infoUserD"><p class = "name">'+name+'</p><p class = "time">'+time+'</p></div><div class = "messageD">'+message+'</div></div>');
							
						}
						if(c == 1){
							var text = $(".bodyD").html();
							$("#bodyDTest").html(text);
							var len = $("#bodyDTest").css("height").length;
							var height = $("#bodyDTest").css("height").substr(0, len - 2);
							$(".bodyD").scrollTop(height + 1000000);
							c++;
						}
					}
				});
				
				
			}
			getMessage();
			setInterval(getMessage,2000);

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

	<div id = "bodyDTest"></div>
	<div class = "footD">
		<textarea name="" id="message" class = "textarea1"></textarea>
		<button class = "button" id = "sendMessage">Отправить</button>
	</div>
</div>	
<?
	sidebar_right();
	include("allUsers.php");
?>