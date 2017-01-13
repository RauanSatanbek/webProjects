var r = 0,
	l = 0;
$(document).ready(function(){
	$("#Login").click(function(){
		if(l%2 == 0) {$("#loginForm").fadeIn(1000); r = 0;}
		else $("#loginForm").fadeOut(1000);
		$("#registerForm").fadeOut(500);
		l++;
	});
	$("#Register").click(function(){
		if(r%2 == 0) {$("#registerForm").fadeIn(1000); l = 0;}
		else $("#registerForm").fadeOut(1000);
		$("#loginForm").fadeOut(500);
		r++;
	});
});