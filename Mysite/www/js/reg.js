var r;
$(document).ready(function(){
	$("#sendReg").on("click", inspectionReg);
	r = Math.round((Math.random() * (99999 - 10001)) + 10001);
	$("#captcha").text(r);

	$("#sendLoginReg").on("click", function(){
		document.location.replace("../login.php");
	});

});

function inspectionReg(){
	var name = $("#name").val();
	var surname = $("#surname").val();
	var tel = $("#tel").val();
	var login = $("#login").val();
	var password1 =$("#password1").val();
	var password2 = $("#password2").val();
	var captcha = $("#inputCaptcha").val();
	// Проверка ошибок
	var e_n = "";
	var e_s = "";
	var e_t = "";
	var e_l = "";
	var e_p1 = "";
	var e_p2 = "";
	var e_c = "";
	var e = false;
	if(name == ""){
		e = true;
		e_n = "Имя не должно быть пустым*";
	}

	if(surname == ""){
		e = true;
		e_s = "Фамилия не должно быть пустым*";
	}

	if(tel.length != 11){
		e = true;
		e_t = "Введите коректный телефон номер*";
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

	if(r != captcha){
		e = true;
		e_c = "Неверно введен код с картинки*";
	}

	$("#e_n").text(e_n);
	$("#e_s").text(e_s);
	$("#e_t").text(e_t);
	$("#e_l").text(e_l);
	$("#e_p1").text(e_p1);
	$("#e_p2").text(e_p2);
	$("#e_captcha").text(e_c);

	if (!e){
		$.ajax({
			url: "../page/regIns.php",
			type: "POST",
			data:({name:name,surname:surname,tel:tel,login:login,password:password1}),
			dataType: "html",
			beforeSend:function (){
				$("#info").text("Ожидание данных...");
			},
			success: function(data){
				if (data){
					$("#info").css("color", 'green');
					$("#info").text("Вы успешно вошли в систему");
					document.location.replace("../index.php");
				}
				else {
					$("#info").css("color", 'red');
					$("#info").text("такой логин уже существует");
				}
			}
		});
	}
}