$(document).ready(function(){
	$(".checkboxClick").click(function(){
		if($(this).next().css("color") == "rgb(136, 136, 136)")$(this).next().css("color", "#0092DB");
		else $(this).next().css("color", "#888");
	});
	$(".span-check1").click(function(){
		$(".span-check1").css("color", "#888");
		$(this).next().children("span").css("color", "#0092DB");
	});
	$(".span-check2").click(function(){

		$(".span-check2").css("color", "#888");
		$(this).next().children("span").css("color", "#0092DB");
	});
});