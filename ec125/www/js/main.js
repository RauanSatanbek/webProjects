$(document).ready(function(){
	var bool_img = false;
	// upload_image -----------------------------------------
		$("#news-saves").click(function(){
			var topic = $("#news-topic").val();
			var text = $("#news-text").val();
			$.ajax({
				url: "../page/upload.php",
				type: "post",
				data: {bool:1},
				dataType: "html",
				success: function(data){
					console.log(data);
					console.log(topic, text);
				}
			});
		});
	// upload_image -----------------------------------------
	$("#logo").click(function(){
		document.location.replace("../page/index.php");
	});
	window.onscroll = function() {
	  var scrolled = window.pageYOffset;
	  // console.log(scrolled);
	  if(scrolled < 66) $(".navbar").css("marginTop", (65 + scrolled * -1) + "px");
	  else $(".navbar").css("marginTop", "0px");
	}
	
	$('.up').click(function(){
		$("body, html").animate({scrollTop:0}, 1000);
	});
	$('.exit').click(function(){
		$("#hide").slideUp(1);
		$(".Opens").hide();
	});
	// ---------------------------------
	$("#Main").click(function(){
		$("html, body").animate({scrollTop:73},500);
	});

	$("#Subjects").click(function(){
		$("html, body").animate({scrollTop:643},500);
	});

	$("#Curses").click(function(){
		$("html, body").animate({scrollTop:1066},500);
	});

	$("#Dostezhenie").click(function(){
		$("html, body").animate({scrollTop:1607},500);
	});

	$("#Address").click(function(){
		$("html, body").animate({scrollTop:1834},500);
	});
	$("#YBT").click(function(){
		$("#hide").slideDown(1);
		$(".YBT").show();
	});
	$("#KTL").click(function(){
		$("#hide").slideDown(1);
		$(".KTL").show();
	});
	$("#MinCenter").click(function(){
		$("#hide").slideDown(1);
		$(".MinCenter").show();
	});

	var r = 0;
	var l = 0;
	$("#register").click(function(){
		l = 0;
		// $("#login").css("background","#334");
		$("#loginForm").slideUp(1000);
		
	});
	$("#login").click(function(){
		r = 0;
		$("#registerForm").slideUp(1000);
	});
	$("#main").click(function(){
		document.location.replace("../page/index.php");
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
	var c = 1;
	$(".AboutUs").click(function(){
		if (c % 2 == 0) {
			$("#aboutUs").html('Біз туралы <i class="fa fa-circle faBlue faBlueF" aria-hidden="true"></i>');
			$("#workStyle").html('Жұмыс тәсіліміз <i class="fa fa-circle-o faBlue faBlueS" aria-hidden="true">');
			$(".AboutUsDiv").slideDown(1000);
			$(".workStyleDiv").slideUp(1000);
			$(".allInfoAbout125P").text("Біз туралы");
			c++;
		}
		else {
			$("#workStyle").html('Жұмыс тәсіліміз <i class="fa fa-circle faBlue faBlueS" aria-hidden="true"></i>');
			$("#aboutUs").html('Біз туралы <i class="fa fa-circle-o faBlue faBlueF" aria-hidden="true">');
			$(".AboutUsDiv").slideUp(1000);
			$(".workStyleDiv").slideDown(1000);
			$(".allInfoAbout125P").text("Жұмыс тәсіліміз");
			c++;
		}
		$(".faBlueF").css('marginLeft', '48px');
	});
	$("html, body").animate({scrollTop:73},500);
});