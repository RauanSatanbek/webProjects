var r;
$(document).ready(function(){
	function modalShow(data, html, text, id){
		$('.modal-show').fadeIn(200);
		if (data == 1){
			$("#" + id).html(html);
			$("#text").css("color", '#449d44');
			$("#text").text(text);
		}
		else {
			$("#" + id).html(html);
			$("#text").css("color", '#c9302c');
			$("#text").text(text);
		}
		setTimeout(function(){$('.modal-show').fadeOut(200);},10000);
	}
	function inspectionReg(){
		var name = $("#name").val();
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
			e_n = "Имя не должно быть пустым!";
		}
		if(login == ""){
			e = true;
			e_l = "Логин не должен быть пустым!";
		}
		if(password1 == "" ){
			e = true;
			e_p1 = "Введите пороль.";
		}
		if(password1 != password2){
			e = true;
			e_p2 = "Пароль не совпадают, попробуйте снова.";
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
				data:({bool:2,name:name,login:login,password:password1}),
				dataType: "html",
				beforeSend:function (){
					$("#sendReg").html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
				},
				success: function(data){
					if (data == 1){
						modalShow(data, 'Регистрация', "Поздравляем! Вы успешно зарегистрировались!", 'sendReg');
						document.location.replace("../page/index.php");
					}
					else {
						modalShow(data, 'Регистрация', "Такой логин уже существует", 'sendReg');
						$("#text").css("color", '#c9302c');
					}
				}
			});
		}
	}

	function inspectionLog(){
		var login = $("#login1").val();
		var password =$("#password").val();
		$.ajax({
			url:"../page/logAndRegIns.php",
			type:"POST",
			data:{bool:1,login:login, password: password},
			dataType:"html",
			beforeSend:function (){
				$("#sendLog").html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
			},
			success: function(data){
				if (data == 1){
					modalShow(data, 'Вход', "Вы успешно вошли в систему", 'sendLog');
					document.location.replace("../page/index.php");
				}
				else {
					modalShow(data, 'Вход', "Вы ввели неверный логин или пароль, проверьте правильность вводат", 'sendLog');
				}
			}
		});
	}
	function logout(){
		$.ajax({
			url:"../page/logAndRegIns.php",
			type:"POST",
			data:{bool:3},
			success: function(){
				document.location.replace("../page/index.php");
			}
		});
	}
	$("#sendReg").on("click", inspectionReg);
	$("#sendLog").bind("click", inspectionLog);
	$("#logout").bind("click", logout);
});
