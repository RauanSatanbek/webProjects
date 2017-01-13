var r;
$(document).ready(function(){
	function inspectionLog(){
		var ID = $("#IDLog").val();
		var password =$("#passwordLog").val();
		var c = $("#type").get(0);
		var type = c.options[c.selectedIndex].value;
		$.ajax({
			url:"../page/logAndRegIns.php",
			type:"POST",
			data:{bool:"1",ID:ID, password: password, type:type},
			dataType:"html",
			// beforeSend:function (){
			// 	$("#info").text("Ожидание данных");
			// 	$("#loading").attr("src", "../img/loading3.gif");
			// 	$("#loading").show();
			// },
			success: function(data){
				// $("#loading").hide();
				if(data){
					$("#infoLog").css("color", '#98FB98');
					$("#infoLog").text("Вы успешно вошли в систему");
					document.location.replace("../page/index.php");
				}
				else{
					$("#infoLog").css("color", '#F08080');
					$("#infoLog").text("Вы ввели неверный ID или пароль, проверьте правильность ввода");
				}
			}
		});
		// }
	}

	function inspectionReg(){

		var name = $.trim($("#name").val());
		var tel = $.trim($("#tel").val());
		var nameF = $.trim($("#nameF").val());
		var tel2 = $.trim($("#tel2").val());
		var nameM = $.trim($("#nameM").val());
		var tel3 = $.trim($("#tel3").val());
		var address = $.trim($("#address").val());
		var c = $("#schools").get(0);
		var school = c.options[c.selectedIndex].value;
		var children = $.trim($("#children").val());
		var c = $("#Subject").get(0);
		var subject = c.options[c.selectedIndex].value;
		// console.log(subject);
		var id = $.trim($("#ID").val());
		var password1 =$.trim($("#password1").val());
		var password2 = $.trim($("#password2").val());
		var contract = $( ".contract:checked" ).val();
		// Проверка ошибок
		var e_n = "";
		var e_t = "";

		var e_nf = "";
		var e_t2 = "";

		var e_nm = "";
		var e_t3 = "";

		var e_a = "";
		var e_s = "";
		var e_ch = "";
		var e_id = "";

		var e_p1 = "";
		var e_p2 = "";

		var e_co = "";
		var e = false;
		if(contract == undefined){
			e = true;
			e_co = "Выберите одну из двух.";
		}
		if(name == ""){
			e = true;
			e_n = "Это строка не должна быть пустым.";
		}
		if(tel.length != 11){
			e = true;
			e_t = "Введите коректный телефон номер.";
		}

		if(nameF == ""){
			e = true;
			e_nf = "Это строка не должна быть пустым.";
		}

		if(tel2.length != 11){
			e = true;
			e_t2 = "Введите коректный телефон номер.";
		}

		if(nameM == ""){
			e = true;
			e_nm = "Это строка не должна быть пустым.";
		}

		if(tel3.length != 11){
			e = true;
			e_t3 = "Введите коректный телефон номер.";
		}
		if(address == ""){
			e = true;
			e_a = "Это строка не должна быть пустым.";
		}
		if(school == ""){
			e = true;
			e_s = "Это строка не должна быть пустым.";
		}
		if(children == ""){
			e = true;
			e_ch = "Это строка не должна быть пустым.";
		}

		$("#e_n").text(e_n);
		$("#e_t").text(e_t);

		$("#e_nf").text(e_nf);
		$("#e_t2").text(e_t2);

		$("#e_nm").text(e_nm);
		$("#e_t3").text(e_t3);

		$("#e_a").text(e_a);
		$("#e_s").text(e_s);
		$("#e_ch").text(e_ch);
		$("#e_co").text(e_co);

		if (!e){
			var all = name+ ":" +tel+ ":" +nameF+ ":" +tel2+ ":" +nameM+ ":" +tel3+ ":" +address + ":" +school +":" + subject+":" +children + ":" + contract;
			// console.log(all);
			$.ajax({
				url: "../page/logAndRegIns.php",
				type: "POST",
				data:{bool:2,all:all},
				dataType: "html",
				// beforeSend:function (){
				// 	$("#info").text("Ожидание данных...");
				// },
				success: function(data){
					// console.log(data);
					if (data == 1){
						$("#infoReg").css("color", '#B03F35');
						$("#infoReg").text("Такой ID уже существует!");
					}
					else {
						data = data.split(":");
						$("#userId").text(data[0]);
						$("#userPassword").text(data[1]);
						$(".successReg").text(data[2]);
						$(".successRegText").text("Оқушыны тіркеу сәтті өтті. Жоғарыдағы ID және Пороль оқушыға сайтқа кіруге керекті мәліметтер. Осы мәліметтенрді оқушыға беріңіз.");
						$(".TurnOfIdDiv").slideUp(1000);
						$(".userIsLogined").slideDown(1000);
					}
				}
			});
		}
	}


	$('#register').click(function(){
		$("#hide").slideDown(1);
		$("#loginForm").hide();
		$("#registerForm").show();
	});

	$('#login').click(function(){
		$("#hide").slideDown(1);
		$("#loginForm").show();
		$("#registerForm").hide();
	});

	$('#logout').click(function(){
		$.ajax({
			url: "../page/logAndRegIns.php",
			type: "post", 
			data: {bool:3},
			dataType: "html",
			success: function(data){
				if(data == 1) document.location.replace("../page/index.php");
			}
		});
	});
	$("#sendLog").bind("click", inspectionLog);
	$("#sendReg").on("click", inspectionReg);
});