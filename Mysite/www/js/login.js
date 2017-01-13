$(document).ready(function(){
	// $("#menu").css("color", "red");
	$("#sendLog").bind("click", inspectionLog);
	$("#sendRegLogin").on("click", function(){
		document.location.replace("../registration.php");
	});

	
});
function inspectionLog(){
	var login = $("#login").val();
	var password =$("#password").val();
	var captcha = $("#inputCaptcha").val();
	// Проверка ошибок

	var e_l = "";
	var e_p = "";
	var e_c = "";
	var e = false;
	if(login == ""){
		e = true;
		e_l = "Логин не должен быть пустым*";
	}
	if(password == "" ){
		e = true;
		e_p = "Введите пороль*";
	}

	if(r != captcha){
		e = true;
		e_c = "Неверно введен код с картинки*";
	}
	$("#e_l").text(e_l);
	$("#e_p1").text(e_p);
	$("#e_captcha").text(e_c);

	if(!e){
		$.ajax({
			url:"../page/logIns.php",
			type:"POST",
			data:{login:login, password: password},
			dataType:"html",
			beforeSend:function (){
				$("#info").text("Ожидание данных");
				$("#loading").attr("src", "../img/loading3.gif");
				$("#loading").show();
			},
			success: function(data){
				$("#loading").hide();
				if(data){
					console.log(data);
					$("#info").css("color", "green");
					// $("#menu").show();
					// document.location.replace("../index.php");
					$("#info").text("Вы успешно вошли в систему");
				}
				else{
					$("#info").css("color", "red");
					$("#info").text("Вы ввели неверный логин или пароль, проверьте правильность ввода");
				}
			}
		});
	}
}