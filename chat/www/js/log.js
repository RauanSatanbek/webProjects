$(document).ready(function(){
	// $("#menu").css("color", "red");
	$("#sendLog").bind("click", inspectionLog);
});
function inspectionLog(){
	var login = $("#login1").val();
	var password =$("#password").val();
	// Проверка ошибок

	// var e_l = "";
	// var e_p = "";
	// var e = false;
	// if(login == ""){
	// 	e = true;
	// 	e_l = "Логин не должен быть пустым*";
	// }
	// if(password == "" ){
	// 	e = true;
	// 	e_p = "Введите пороль*";
	// }
	// $("#e_l").text(e_l);
	// $("#e_p1").text(e_p);

	// if(!e){
		$.ajax({
			url:"../page/logAndRegIns.php",
			type:"POST",
			data:{bool:"1",login:login, password: password},
			dataType:"html",
			// beforeSend:function (){
			// 	$("#info").text("Ожидание данных");
			// 	$("#loading").attr("src", "../img/loading3.gif");
			// 	$("#loading").show();
			// },
			success: function(data){
				$("#loading").hide();
				if(data){
					$("#infoLog").css("color", '#98FB98');
					// $("#menu").show();
					document.location.replace("../page/main.php");
					$("#infoLog").text("Вы успешно вошли в систему");
				}
				else{
					$("#infoLog").css("color", '#F08080');
					$("#infoLog").text("Вы ввели неверный логин или пароль, проверьте правильность ввода");
				}
			}
		});
	// }
}