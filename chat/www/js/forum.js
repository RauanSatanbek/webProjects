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
		if(question){
			$.ajax({
				url:"../page/addAndGetForum.php",
				type:"post",
				data:({bool:1,question:question}),
				success:function(data){
					getMessage();
					c = 1;
				}
			});
		}
		
		 $("#question").val("");
	});


// load message
	var c = 1;
	function getMessage(){
		$.ajax({
			url:"../page/addAndGetForum.php",
			type:"post",
			data:({bool:2}),
			dataType:"json",
			success:function(data){
				$(".bodyD").html("");
				for (var i = 0; i < data.length; i++){
					var writer = "me";
					if (i%2 == 0) writer = "other";
					var avatar = data[i][0];
					var name = data[i][1];
					var question = data[i][2];
					var time = data[i][3];
					var user_avatar = data[i][4];
					$(".bodyD").prepend('<div class = "forumD '+writer+'"><div class = "infoQuestion"><div class = "infoUserForum"><p class = "name">'+name+'</p><p class = "time">'+time+'</p></div><div class = "messageForum">'+question+'</div><div class = "openComment"><p class = "openAndClose open" id = "'+(i + 1)+'">Ответить</p></div></div></div>');

				}
				if(c == 1){
					var text = $(".bodyD").html();
					$("#bodyDTest").html(text);
					var len = $("#bodyDTest").css("height").length;
					var height = $("#bodyDTest").css("height").substr(0, len - 2);
					$(".bodyD").scrollTop(height + 10000000);
					c++;
				}
				// getMessage();
			}
		});
		
		
	}
	getMessage();
	setInterval(getMessage,500);
	
});