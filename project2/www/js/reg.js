var r;
$(document).ready(function(){
	$("#sendReg").on("click", inspectionReg);

});

function inspectionReg(){
	var name = $("#name").val();
	var surname = $("#surname").val();
	var login = $("#login2").val();
	var password1 =$("#password1").val();
	var password2 = $("#password2").val();
	// Проверка ошибок
	var e_n = "";
	var e_s = "";
	var e_l = "";
	var e_p1 = "";
	var e_p2 = "";
	var e = false;
	if(name == ""){
		e = true;
		e_n = "Имя не должно быть пустым*";
	}

	if(surname == ""){
		e = true;
		e_s = "Фамилия не должно быть пустым*";
	}
	if(login == ""){
		e = true;
		e_l = "Логин не должен быть пустым*";
	}
	if(password1 == "" ){
		e = true;
		e_p1 = "Введите пороль*";
	}
	if(password1 != password2){
		e = true;
		e_p2 = "Пароль не совпадают, попробуйте снова*";
	}

	$("#e_n").text(e_n);
	$("#e_s").text(e_s);
	$("#e_l").text(e_l);
	$("#e_p1").text(e_p1);
	$("#e_p2").text(e_p2);

	if (!e){
		$.ajax({
			url: "../page/logAndRegIns.php",
			type: "POST",
			data:({bool:"2",name:name,surname:surname,login:login,password:password1}),
			dataType: "html",
			// beforeSend:function (){
			// 	$("#info").text("Ожидание данных...");
			// },
			success: function(data){
				if (data){
					$("#infoReg").css("color", '#98FB98');
					$("#infoReg").text("Вы успешно вошли в систему");
					document.location.replace("../page/main.php");
				}
				else {
					$("#infoReg").css("color", '#F08080');
					$("#infoReg").text("такой логин уже существует");
				}
			}
		});
	}
}