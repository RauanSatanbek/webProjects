$(document).ready(function(){
	// $(".dialog").delegate(".open", "click", function(){
	// 		// --------------------------
	// 			$(".answers").slideUp(400);
	// 			$('.close').hide();
	// 			$('.open').show();
	// 			// loadComment();
	// 		// --------------------------
	// 		$(this).next().next().slideDown(800);
	// 		$(this).next().show();
	// 		$(this).hide();
	// 		var id = $(this).get(0).id;
	// 		$.ajax({
	// 			url:"forumD.php",
	// 			type:"post",
	// 			data:({questionId:id}),
	// 			dataType:"html",
	// 			success:function(data){
	// 				console.log(data);
	// 			}
	// 		});
	// });
	var bool = 0;
	$(".dialog").delegate(".answer", "click", function(){
		$(".sendMessage").get(0).id = $(this).get(0).id;
		$(".message").focus();
		bool = 1;
	});

	message.onfocus = function(){
		// $(this).css({
		// 	background: "#444",
		// 	color: "#fff"
		// });
	}
	$(".sendMessage").click(function(){
		var message = $(".message").val();
		var to;
		if (bool == 1) {to = $(".sendMessage").get(0).id;bool = 0;}
		else to = 0;
		if(message){
			$.ajax({
				url:"../page/addAndGetForum.php",
				type:"post",
				data:({bool:1,message:message,to:to}),
				success:function(data){
					getMessage();
					c = 1;
				}
			});
		}
		 $(".message").val("");
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
					var from = data[i][0];
					var name = data[i][1];
					var message = data[i][2];
					var date = data[i][3];
					var user = data[i][4];
					if (user != from) writer = "other";
					$(".bodyD").prepend('<div class = "forumD '+writer+'"><div class = "infoQuestion"><div class = "infoUserForum"><p class = "name">'+name+'</p><p class = "time">'+date+'</p></div><div class = "messageForum">'+message+'</div><div class = "openComment"><p class = "answer" id = "'+from+'">Ответить</p></div></div></div>');

				}
				
			}
		});
		
		
	}
	getMessage();
	setInterval(getMessage,500);
	
});