$(document).ready(function(){
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
		var message = $("#message").val();
		console.log(message);
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
				console.log(data);
				$(".chat-body").html("");
				for (var i = 0; i < data.length; i++){
					var writer = "me";
					var from = data[i][0];
					var name = data[i][1];
					var message = data[i][2];
					var date = data[i][3];
					var user = data[i][4];
					if (user != from) writer = "other";
					$(".chat-body").prepend('<div class = "forumD '+writer+'"><div class = "infoQuestion"><div class = "infoUserForum"><p class = "name">'+name+'</p><p class = "time">'+date+'</p></div><div class = "messageForum"><p>'+message+'</p></div><div class = "openComment"><p class = "answer" id = "'+from+'">Ответить</p></div></div></div>');
				}
				if(c == 1){
					var text = $(".chat-body").html();
					$("#bodyDTest").html(text);
					var len = $("#bodyDTest").css("height").length;
					var height = $("#bodyDTest").css("height").substr(0, len - 2);
					$(".chat-body").scrollTop(height + 10000000);
					c++;
				}
			}
		});
	}
	getMessage();
	setInterval(getMessage,2000);
	
});