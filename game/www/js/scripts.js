$(document).ready(function(){
	var interval, intervalP, index = 0, cols = [[1, 12],2,3];
	var height = 300, hearts = 1;;
	var number = 0, bool = 1, bool2 = 1, bool3 = 1, b = 0, finish = 1;
	var Time =  Math.floor(Math.random() * 1000 + 1500);
	var marginTopR, marginTopP, marginTopR2 = -4;
	function changePlayer(index){
		if(hearts < 4){
			bool = 1;
      		Time -= 100;
      		if(Time <= 100) Time = 100;
			var top = $(".player").css("marginTop");
			$(".player").hide();
			$("#player" + cols[index]).show();
			$(".player").css("marginTop", top);
		}
	}
	function MacroCollision(obj1,obj2){
	  if ((obj1 + 5 >= obj2 && obj1 <= obj2 + 20) || (obj1 - 5 <= obj2 && obj1 >= obj2 - 20)) return true;
	  return false;
	}
	// setTimeout(function(){
	// 	$("#rect2").css("display", "none");
	// 	console.log(45);
	// }, 1000);
	function move(id, time, from, to, start){
		interval = setInterval(function(){

      		$(id).animate({marginTop: from + "px"},Time + time);
      		$(id).animate({marginTop: to +"px"},Time + time);
      		bool2 = 0;
      		bool3 = 0;
      		if(index == 0) {
      			marginTopR = parseFloat($("#rect" + cols[index][0]).css("marginTop").substr(0, $("#rect" + cols[index]).css("marginTop").length - 2));
      			marginTopR2 = parseFloat($("#rect" + cols[index][1]).css("marginTop").substr(0, $("#rect" + cols[index]).css("marginTop").length - 2));
      		}
      		else {
      			marginTopR = parseFloat($("#rect" + cols[index]).css("marginTop").substr(0, $("#rect" + cols[index]).css("marginTop").length - 2));
      			marginTopR2 = -50;
      		}
      		marginTopP = parseFloat($("#player" + cols[index]).css("marginTop").substr(0, $("#player" + cols[index]).css("marginTop").length - 2));
      		if(MacroCollision (marginTopR, marginTopP) || MacroCollision (marginTopR2, marginTopP)){
      			bool2 = 1;
      		}
      		if((marginTopP + 20 >= 295 || marginTopP <= 5) && bool ) {bool3 = 1;}
      		if(marginTopP > 5 && marginTopP + 20 < 295) bool3 = 0;
      		if(bool2 && bool ){
      			bool2 = 0;
      			bool = 0;
      			number--;
      			$("#number").text(number + "");
      			$(".heart" + hearts).hide();
      			hearts++;
      			if(hearts >= 4) {$(".player").hide();$(".game-over").fadeIn(2000);}
      		}
      		if(bool3){
      			bool3 = 0;
      			bool = 0;
      			number++;
      			$("#number").text(number + "");
      		}
      	}, start, time*2);
	}
	move("#rect1", 100, height, 0, 100);
	move("#rect12", 300, 0, height, 1000);
	move("#rect2", 50, 0, height, 500);
	move("#rect3", 100, height, 0, 1000);
	intervalP = setInterval(function(){
  		$(".player").animate({marginTop: 0 + "px"},2500);
  		$(".player").animate({marginTop: 280 +"px"},2500);
  	}, 0, 4000);
	var m = [];
	$(".btn-left").click(function(){
		index -= 1;
		if(index < 0 ) index = 2;
  		changePlayer(index);
	});
	$(".btn-right").click(function(){
		index += 1;
		if(index > 2 ) index = 0;
  		changePlayer(index);
	});
	$(window).on("keydown",function(){
		var keyDown = event.keyCode;
		if(!m.includes(keyDown))
			m.push(keyDown);
		if(m.includes(37)){
			index -= 1;
			if(index < 0 ) index = 2;
		}
		else if(m.includes(39)){
			index += 1;
			if(index > 2 ) index = 0;
		}
  		changePlayer(index);
		$(window).bind("keyup",function(){
			var keyUp = event.keyCode;
			if(m.includes(keyUp)){
				var index = m.indexOf(keyUp);
				delete m[index];
			}
		});
	});
});