var index = 1;
var name;
var bool = true;
var timer;
$(document).ready(function (){
	// Картинка изменяется авто...
		timer = setInterval(function(){
			if(bool){
				index++;
				if(20 < index)
					index = 1;
				$("#img21").attr("src", "../img/gallery/"+index+".jpg");
			}
		}, 3000);
		$("#img21, #rightImg, #leftImg").on("mouseenter", function(){
			bool = false;
			// clearInterval(timer);
			name = Number($("#img21").attr("src").substr(15,1));
		});

		$("#img21, #rightImg, #leftImg").on("mouseleave", function(){
			bool = true;
		});
		// Картинка изменяется в ручную
			$("#leftImg").on("click", function(){
				name--;
				if(name < 1)
					name = 20;
					
				$("#img21").attr("src", "../img/gallery/"+name+".jpg");
				index = name;
			});
			$("#rightImg").on("click", function(){
				name++;
				if(20 < name)
					name = 1;
				$("#img21").attr("src", "../img/gallery/"+name+".jpg");
				index = name;
				console.log(name);
			});


	////////////////////////

	// 	var left = Number($("#rightImg").css("marginLeft").substr(0,$("#rightImg").css("marginLeft").length - 2)),
	// 	down = Number($("#rightImg").css("marginTop").substr(0,$("#rightImg").css("marginTop").length - 2)),	
	// 	m = [],
	// 	speed = 10,
	// 	jump = 200,
	// 	time = 2000;
	// $(window).bind("keydown",function(){
	// 	var keyDown = event.keyCode;
	// 	if(!m.includes(keyDown))
	// 		m.push(keyDown);
	// 	if(m.includes(68))
	// 		left+=speed;
	// 	if(m.includes(83))
	// 		down+=speed;
	// 	if(m.includes(87))
	// 		down-=speed;
	// 	if(m.includes(65))
	// 		left-=speed;
	// 	if(m.includes(32)){
	// 		down -= jump;
	// 		$("#rightImg").animate({paddingTop:down + "px"},time);
	// 		console.log($("#rightImg").css("paddingTop"));
	// 		down += jump;
	// 		$("#rightImg").animate({marginTop:down + "px"},time);
	// 	}

	// 	// if(down >= 500)
	// 	// 	down = 500;
	// 	$("#rightImg").css({
	// 		"marginTop": down + ".px",
	// 		"marginLeft": left + ".px"
	// 	});

	// 	$(window).bind("keyup",function(){
	// 		var keyUp = event.keyCode;
	// 		if(m.includes(keyUp)){
	// 			var index = m.indexOf(keyUp);
	// 			delete m[index];
	// 		}
	// 	});
	
	// });
});