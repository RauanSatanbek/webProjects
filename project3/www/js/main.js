$(document).ready(function(){
	var r = 0;
	var l = 0;
	$("#register, #registerA").click(function(){
		l = 0;
		$("#login").css("background","#334");
		$("#loginForm").slideUp(1000);
		if(r%2 == 0) {$("#registerForm").slideDown(1000);r++;$("#register").css("background","#556");}
		else {$("#registerForm").slideUp(1000);r++;$("#register").css("background","#334");}
		
	});
	$("#login, #loginA").click(function(){
		r = 0;
		$("#register").css("background","#334");
		$("#registerForm").slideUp(1000);
		if(l%2 == 0) {$("#loginForm").slideDown(1000);l++;$("#login").css("background","#556");}
		else {$("#loginForm").slideUp(1000);l++;$("#login").css("background","#334");}
	});
	$("#main").click(function(){
		document.location.replace("../page/main.php");
		console.log(456);
	});
	// open || close
		var creat = 0;
		var p2 = 0;
		$("#creat").click(function(){
			if(creat%2 == 0){$(".creatchat").slideDown(1000); creat++;}
			else{$(".creatchat").slideUp(1000); creat++;}
			if(p2%2 == 0) $("#p2").html("&#9650");
			else $("#p2").html("&#9660");
			p2++;
		});
		var chats = 1;
		var p1 = 1;
		$("#chats").click(function(){
			if(chats%2 == 0){$(".chats").slideDown(1000); chats++;}
			else{$(".chats").slideUp(1000); chats++;}
			if(p1%2 == 0) $("#p1").html("&#9650");
			else $("#p1").html("&#9660");
			p1++;
		});
	// creat new chat
		$("#creatchat").click(function(){
			var c = $("#number").get(0);
			var number = c.options[c.selectedIndex].text;
			var tema = $("#tema").val();
			$("#tema").val("");
			$.ajax({
				url:"creatChat.php",
				type:"post",
				dataType:"html",
				data:({bool:1,number:number, tema:tema}),
				success:function(data){
					console.log(data);
				}
			});
		});
	// get chat
		function getChat(){
			$.ajax({
				url:"creatChat.php",
				type:"post",
				dataType:"json",
				data:({bool:2}),
				success:function(data){
					$("#table").html("");
					$("#table").append('<tr><th>#</th><th>Тема</th><th class = "number">Число людей</th><th id = "creator">Создатель</th></tr>');
					
					var len = data.length;
					for(var i = 0; i < len; i++){
						var user = data[i][0];
						var tema = data[i][1];
						var number = data[i][2];
						var users = data[i][3];
						$("#table").append('<tr><td>'+(i + 1)+'</td><td class = "tema" id = "'+(len-i)+'">'+tema+'</td><td class = "number">'+users+' / '+number+'</td><td id = "creator">'+user+'</td></tr>');
					}
				}
			});
		}
		getChat();
		setInterval(getChat, 500);
	// for forum
		$("#table").delegate(".tema", "click", function(){
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