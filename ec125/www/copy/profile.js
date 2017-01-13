$(document).ready(function(){
	google.charts.load('current', {packages: ['corechart', 'line']});
	function drawBasic(id, massive) {
	    var data = new google.visualization.DataTable();
	    data.addColumn('number', 'Апта');
	    data.addColumn('number', '%');
	    data.addRows(massive);
	    var options = {
		    chartArea:{width:'65%',height: '70%'},
		    vAxis: {ticks: [20,40,60,80,100]}
	    };
	    var chart = new google.visualization.LineChart(document.getElementById(id));
	    chart.draw(data, options);
	}
	// Edit user information
		$(".edit-user-info-p").click(function(){
			$(".Close").slideUp(500);
			$(".edit-user-info-div").slideDown(500);
		});
		$("#edit-search").on("keyup", function(){
			$("#edit-user-get-id").text("0");
			if($(".edit-contract:checked").val() != false) $(".edit-contract:checked").removeAttr("checked");
			var text = $(this).val();
			if(text != false){
				$.ajax({
					url: "queries.php",
					type:"post",
					data: {bool:42, text:text},
					dataType: "json",
					success: function(data){
						console.log(data);
						var id = data["id"],
							name = data["name"], 
							tel = data["tel"], 
							nameF = data["nameF"], 
							tel2 = data["tel2"],
							address = data["address"],
							nameM = data["nameM"],
							tel3 = data["tel3"],
							contract = parseInt(data["contract"]),
							group = parseInt(data["group"]) - 1,
							school = parseInt(data["school"]) - 1,
							subject = parseInt(data["subject"]) - 1;
						$("#edit-user-get-id").text(id);
						$("#edit-subjects").val(1 + subject);
						$("#edit-groups").val(1 + group);
						$("#edit-option-schools").val(1 + school);
						$("#edit-name").attr("placeholder", name);
						$("#edit-tel").attr("placeholder", tel);
						$("#edit-nameF").attr("placeholder", nameF);
						$("#edit-tel2").attr("placeholder", tel2);
						$("#edit-nameM").attr("placeholder", nameM);
						$("#edit-tel3").attr("placeholder", tel3);
						$("#edit-address").attr("placeholder", address);
						var c_0 ,c_1;
						if(contract == 1) {c_1 = 'checked = "checked"';c_0 = "";}
						else  {c_0 = 'checked = "checked"';c_1 = "";}
						$(".edit-radio").html('<div class="radio"><label><input type="radio" name="edit-contract" value="1" class = "edit-contract" id = "edit-contract-1" '+c_1+'> Ия</label></div><div class="radio"><label><input type="radio" name="edit-contract" value="0" class = "edit-contract" id = "edit-contract-0" '+c_0+'> Жоқ</label></div>');
						
					}
				});
			}
		});
	$("#edit-save").click(function(){
		var contract = $(".edit-contract:checked" ).val();
		var edit_ids = "";
		var m = ["#edit-name", "#edit-tel", "#edit-nameF", "#edit-tel2", "#edit-nameM", "#edit-tel3", "#edit-address"];

		edit_ids += $("#edit-user-get-id").text();
		for(var i = 0; i < m.length; i++){
			var text = $(m[i]).val();
			if(text == false) text = $(m[i]).attr("placeholder");
			edit_ids += ("]" +text);
		}
		var c = $("#edit-option-schools").get(0);
		edit_ids += ("]" + c.options[c.selectedIndex].value);
		c = $("#edit-subjects").get(0);
		edit_ids += ("]" + c.options[c.selectedIndex].value);
		c = $("#edit-groups").get(0);
		edit_ids += ("]" + c.options[c.selectedIndex].value);
		edit_ids += ("]" + contract);
		$.ajax({
			url: "queries.php",
			type:"post",
			data: {bool:43, edit_ids:edit_ids},
			dataType: "html",
			success: function(data){
				if(data == 1){
					Timeout();
					$(".span1").text("Успешно сохранено.");
					$(".span1").css("color","#00CD66");
					$(".errors").fadeIn(500);
				}
			}
		});
	});

	$(".blockLeft").delegate(".More", "click", function(){
		$(this).prev().slideToggle(500);
	});
	$(".blockLeft").delegate(".EDIT", "click", function(){
		$(this).prev().slideToggle(500);
	});
	
	// Топқа мұғалім тағайындау
	$(".setTeacher").click(function(){
		var groupId = $(this).get(0).id;
		$.ajax({
			url: "queries.php",
			type:"post",
			data:{bool:-1,groupId:groupId}
		});
		$(".NameUpdate").html('Cабақ беретін мұғалімдерді тағайындау <i class="fa fa-long-arrow-right" aria-hidden="true"></i> ' + $(this).text());
		$(".setTeacherDiv").slideDown(1000);
	});
	$(".ProFileP").click(function(){
		var id = $(this).get(0).id;
		$.ajax({
			url: "queries.php",
			type:"post",
			data:{bool:33, user_id: id},
			dataType:"json",
			success: function(data){
				var massive = [];
				massive[0] = [0,0]; 
				var results = data;
				if(results != false){
					for(var i = 0; i < results.length; i++){
					 	var results2 = results[i].split(";");
					 	var bal = results2[2].split(" ");
						var oTotal125 = parseInt(bal[1]);
						oTotal125 = parseFloat((oTotal125 * 100 / 125).toFixed(2));
						massive[i + 1] = [i + 1,oTotal125];
					}
				}
				google.charts.setOnLoadCallback(drawBasic("chart_div_profile1", massive));
				google.charts.setOnLoadCallback(drawBasic("chart_div_profile1", massive));
		}
	});
		$(".Close, .BagaClose").slideUp(1000);
		$(".proFileDiv, .minLeft,.minRight").slideDown(500);
	});
	$("#logo").click(function(){
		document.location.replace("../page/main.php");
	});
	function Timeout(){
		clearTimeout(time);
		var time = setTimeout(function(){
			$(".errors").fadeOut(500);
		},15000);
	}
	$("#exit").click(function(){
		$(".errors").fadeOut(500);
	});
	// include to profile me or others
	// $(".userName").click(function()
	// Оқушы жайлы мәлімет
		function showUserProfile(id){
			$.ajax({
				url: "queries.php",
				type:"post",
				data:{bool:24,id:id},
				dataType:"json",
				success: function(data){
					console.log(data);
					var massive = [];
					massive[0] = [0,0]; 
					$(".MainInfoAboutUser").html("");
					$(".ExtraInfoAboutUser").html("");
					var name = data[0];
					var key = data[1];
					var value = data[2];

					var key2 = data[4];
					var value2 = data[5];
					var bool = data[6];
					var id = data[7];
					var results = data[8];
					if(results != false){
						for(var i = 0; i < results.length; i++){
						 	var results2 = results[i].split(";");
						 	var bal = results2[2].split(" ");
							var oTotal125 = parseInt(bal[1]);
							oTotal125 = parseFloat((oTotal125 * 100 / 125).toFixed(2));
							massive[i + 1] = [i + 1,oTotal125];
						}
					}
					google.charts.setOnLoadCallback(drawBasic("chart_div", massive));
					// <img src="../img/avatars/'+data[3]+'" height="320" width="250" alt="" id = "UserAvatar">
					$("#UserAvatar").attr("src",'../img/avatars/'+data[3]+'');

					$(".blockLeft2").slideDown(1);
					$(".Close").slideUp(1000);
					// $("#UserAvatar").css("height","320px");
					$(".USERNAME").text(name);
					var m = [key[0], key[1], key[2], key[3], key[4], key[5]];
					var n = [value[0], value[1], value[2], value[3], value[4], value[5]];
					for(var i = 0; i < m.length; i++){ 
						$(".MainInfoAboutUser").append('<tr class="tr2"><td class="td2 td22 td2l td2r  tt2"><p class = "p2">'+m[i]+'</p></td><td class="td2 td22 td2l tt2"><p class = "p2">'+n[i]+'</p></td></tr>');
					}
					var m = [key[6], key[7], key[8], key[9], key[10], key[11]];
					var n = [value[6], value[7], value[8], value[9], value[10], value[11]];
					for(var i = 0; i < m.length; i++){ 
						$(".ExtraInfoAboutUser").append('<tr class="tr2"><td class="td2 td22 td2l td2r  tt2"><p class = "p2">'+m[i]+'</p></td><td class="td2 td22 td2l tt2"><p class = "p2">'+n[i]+'</p></td></tr>');
					}
					if(bool == 1){
						$(".EDIT").show();
						$(".EditInfoUser").html("");
						var m2 = [key2[0], key2[1], key2[2], key2[3], key2[4], key2[5], key2[6], key2[7]];
						var n2 = [value2[0], value2[1], value2[2], value2[3], value2[4], value2[5], value2[6], value2[7]];

						for(i = 0; i < m2.length; i++){ 
						$(".EditInfoUser").append('<tr class="tr2"><td class="td2 td22 td2l td2r tt2 tName"><p class = "p2">'+m2[i]+'</p></td><td class="td2 td22 td2l tt2 te3 tInfo"><p class = "p2" id = "editP'+(i + 1)+'">'+n2[i]+'</p><input type="text" id = "editI'+(i + 1)+'" class="write" value = "'+n2[i]+'"  ></td><td class="td2 td22 td2l tt2 tSave"><p class = "do1 edit2" id = "'+(i + 1)+ " " +id+'" title = "Сохранить изменения.">&#10004;</p></td></tr>');
						}
					} else $(".EDIT").hide();
					$(".minRight").slideDown(1000);
					$(".minLeft").slideDown(1000);
					google.charts.setOnLoadCallback(drawBasic("chart_div",massive));
				}

			});
		}	
		var c = 0;
		$(".Hide").delegate(".userName", "click", function(){
			var id = $(this).get(0).id.substr(2);
			//  get Info user
				showUserProfile(id);
			$(".Close").slideUp(1000);
		});
		$(".Hide").delegate(".userNameFound", "click", function(){
			var id = $(this).get(0).id.substr(2);
			//  get Info user
			showUserProfile(id);
		});
		// Группа статистикасы
			$(".groupsG").click(function(){
				var groupId = $(this).get(0).id;
				$.ajax({
					url: "queries.php",
					type: "post",
					data:{bool:26, groupId:groupId},
					dataType:"json",
					success: function(data){
						var massive = [];
						massive[0] = [0,0]; 
						if(data != false && data.length > 2){
							$("#groupsGText").html(data[data.length - 2] + " - " +data[data.length - 3] + ' тобы <span class = "open" id = "1">'+data[data.length - 1]+'</span>');
							var m = data[0].split("|");
							var len = m.length;
							for(var i = 0; i < len; i++){
								var n = m[i].split(":");
								var td = "";
								var oTotal125 = 0;
								var N = 0;
								for(var j = 3; j < n.length; j++){
									var b = n[j].split(" ");
									var id = b[0];
									var total125 = b[7];
									N++;
									oTotal125 += parseInt(total125);
								}
									oTotal125 = (oTotal125 / N).toFixed(2);
									oTotal125 = parseFloat((oTotal125 * 100 / 125).toFixed(2));
									massive[i + 1] = [i + 1, oTotal125];
								}
							} else $("#groupsGText").text(data[1] + " - " +data[0] + " тобы");
							google.charts.setOnLoadCallback(drawBasic("chart_div2",massive));
							// $(".Close").slideUp();
							$("#groupsG").slideDown();
							$("#curatorG").slideUp();
							$(".blockLeft2").slideUp(1000);
							google.charts.setOnLoadCallback(drawBasic("chart_div2",massive));
							var m = [];
							var kl = [];
							var math = [];
							var h = [];
							var rl = [];
							$.ajax({
								url: "queries.php",
								type:"post",
								data:{bool:30, groupId:groupId},
								dataType:"json",
								success: function(data){
									kl = data[0];
									math = data[1];
									h = data[2];
									rl = data[3];
									$(".groupsGTable").html('<tr class="tr2"><td class="td2 td22 td2l td2r tt2 tdG1"><p class = "subjectForChartP">'+kl[0]+':</p></td><td class="td2 td22 td2l tt2 tdG2"><p class = "p2">'+kl[1]+'</p></td></tr><tr class="tr2"><td class="td2 td22 td2l td2r tt2 tdG1"><p class = "subjectForChartP">'+math[0]+':</p></td><td class="td2 td22 td2l tt2 tdG2"><p class = "p2">'+math[1]+'</p></td></tr><tr class="tr2"><td class="td2 td22 td2l td2r tt2 tdG1"><p class = "subjectForChartP">'+h[0]+':</p></td><td class="td2 td22 td2l tt2 tdG2"><p class = "p2">'+h[1]+'</p></td></tr><tr class="tr2"><td class="td2 td22 td2l td2r tt2 tdG1"><p class = "subjectForChartP">'+rl[0]+':</p></td><td class="td2 td22 td2l tt2 tdG2"><p class = "p2">'+rl[1]+'</p></td></tr>');
								}
							});
							}
					});
				});
	// кураторлар статистикасы
			$(".curatorG").click(function(){
				var curatorId = $(this).get(0).id;
				var name = $(this).text();
				name = name.substr(0, name.length - 1);
				console.log();
				$.ajax({
					url: "queries.php",
					type: "post",
					data:{bool:261, curatorId:curatorId},
					dataType:"json",
					success: function(data){
						console.log(data);
						var massive = [];
						massive[0] = [0,0]; 
						$("#curatorGText").html(name);
						if(data != false){
							var len = data[0].length;
							for(var i = 0; i < data.length; i++){
								if(data[i].length < len) len = data[i].length;
							}
							var num = data.length;
							for(var i = 0; i < len; i++){
								var totalgroup = 0;
								for(var j = 0; j < data.length; j++){
									var m = data[j][i];
									var n = m.split(":");
									var td = "";
									var oTotal125 = 0;
									var N = 0;
									for(var c = 3; c < n.length; c++){
										var b = n[c].split(" ");
										var id = b[0];
										var total125 = b[7];
										N++;
										oTotal125 += parseInt(total125);
									}
									oTotal125 = (oTotal125 / N).toFixed(2);
									oTotal125 = (oTotal125 * 100 / 125);
									totalgroup += parseFloat(oTotal125);
								}
								totalgroup = parseFloat((totalgroup / num).toFixed(2));
								massive[i + 1] = [i + 1, totalgroup];
							}
						}
						$.ajax({
							url: "queries.php",
							type:"post",
							data:{bool:30, bool2:1, curatorId:curatorId},
							dataType:"json",
							success: function(data){
								$(".curatorGTable").html("");
								var g = "";
								var s = "";
								for(var i = 0; i < data.length; i++){
									var m = data[i];
									if(i != 0) s = ", ";
									g = g + s + m["name"];
								}

								$(".curatorGTable").append('<tr class="tr2"><td class="td2 td22 td2l td2r tt2 tdG1"><p class = "subjectForChartP">Топтпры:</p></td><td class="td2 td22 td2l tt2 tdG2"><p class = "p2">'+g+'</p></td></tr>');
								for(var i = 0; i < data.length; i++){
									var m = data[i];
									$(".curatorGTable").append('<tr class="tr2"><td class="td2 td22 td2l td2r tt2 tdG1"><p class = "subjectForChartP">'+m["name"]+':</p></td><td class="td2 td22 td2l tt2 tdG2"><p class = "p2">'+m["date"]+'</p></td></tr>');
								}
							}
						});
						google.charts.setOnLoadCallback(drawBasic("chart_div_curator",massive));
						// $(".Close").slideUp();
						$("#curatorG").slideDown();
						$("#groupsG").slideUp();
						$(".blockLeft2").slideUp(1000);
						google.charts.setOnLoadCallback(drawBasic("chart_div_curator",massive));
					}
				});
			});
	// Include to worc with curator
		$(".toPageP").click(function(){
			var groupId = $(this).get(0).id;
			$.ajax({
				url: "queries.php",
				type:"post",
				data:{bool:-1,groupId:groupId},
				dataType:"html"
			});
		});
	// Оқушының ID -ін іске қосу.
		$("#turnOn").click(function(){
			var userId = $.trim($("#userIdTurnOn").val());
			if(userId != false){
				
				$.ajax({
					url: "queries.php",
					type:"post",
					data:{bool:1,userId:userId},
					dataType:"html",
					success: function(data){
						Timeout();
						if(data == 1){
							$(".span1").text("ID успешно активировано.");
							$(".span1").css("color","#00CD66");
							$(".errors").fadeIn(500);
						}

						else if(data == 2){
							$(".span1").text("Этот ID уже был активирован ранее.");
							$(".span1").css("color","#00CD66");
							$(".errors").fadeIn(500);
						}
						else if(data == 3){
							$(".span1").text("Пользователь с таким ID ужы зарегистрирован в системе.");
							$(".span1").css("color","#EE6363");
							$(".errors").fadeIn(500);
						}
					}
				});
			}
		});
	// Оқушыны өшіру.
		$("#turnOff").click(function(){
			var ids = "";
			$('.checkbox:checkbox:checked').each(function(){
				ids += $(this).get(0).id + " ";
			});
			if(ids != false){
				var users = ids.split(" ");
				var text = "";
				if(users.length != 2) text = "ей";
				var names = "";
				var c = ", ";
				for(var i = 0; i < users.length - 1; i++){
					if(users.length - 1 == i + 1) c = "";
					names += $("#id" + users[i]).text() + c;
				}
				console.log(names);
				if(confirm("Вы действительно хотите удалить ползователя"+text+" - " + names + " ?")){
					$.ajax({
						url: "queries.php",
						type:"post",
						data:{bool:5,userIds:ids},
						dataType:"html",
						success: function(data){
							Timeout();
							if(data == false){
								$(".span1").text("Пользователь успешно удалено.");
								$(".span1").css("color","#00CD66");
								$(".errors").fadeIn(500);
								$("#userIdTurnOff").val("")
							} else {
								var users = data.split(":");
								var names = "";
								var c = ", ";
								for(var i = 0; i < users.length; i++){
									if(users.length == i + 1) c = "";
									names += users[i] + c;
								}
								var text = "я";
								if(users.length != 1) text = "ей";
								$(".span1").text("Невозможно удалить пользовател"+text+" - " + names);
								$(".span1").css("color","#EE6363");
								$(".errors").fadeIn(500);
							}
						}
					});
				}
			} else {
				$(".span1").text("Пользователь не выбран!");
				$(".span1").css("color","#EE6363");
				$(".errors").fadeIn(500);
			}
		});
	// Жаңа топ ашу.
		$("#creatGroup").click(function(){
			var nameGroup = $("#nameGroup").val();
			var c = $("#curator").get(0);
			var curatorId = c.options[c.selectedIndex].value;
			$.ajax({
				url: "queries.php",
				type:"post",
				data:{bool:2,nameGroup:nameGroup, curatorId:curatorId},
				dataType:"html",
				success: function(data){
					console.log(nameGroup, curatorId, data);
					Timeout();
					if(data == 1){
						$(".span1").text("Группа успешно открыта.");
						$(".span1").css("color","#00CD66");
						$(".errors").fadeIn(500);
						// document.location.replace("profile.php");
					} else {
						$(".span1").text("Группа с таким названием уже есть.");
						$(".span1").css("color","#EE6363");
						$(".errors").fadeIn(500);
					}
				}
			});
		});
	// топты өшіру.
		$("#remove").click(function(){
				var c = $("#groupsId2").get(0);
				var groupsId = c.options[c.selectedIndex].value;
				var name = c.options[c.selectedIndex].text;

				if(confirm("Вы действительно хотите удалить группу - " + name)){
					$.ajax({
						url: "queries.php",
						type:"post",
						data:{bool:4,groupsId:groupsId},
						dataType:"html",
						success: function(data){
							Timeout();
							if(data == 1){
								$(".span1").text("Группа успешно удалена.");
								$(".span1").css("color","#00CD66");
								$(".errors").fadeIn(500);
								// document.location.replace("profile.php");
							}
						}
					});
				}

			});
	// Оқушыны топқа қосу / Оқушының тобын ауыстыру.
		$("#addChange").click(function(){
			var ids = "";
			$('.checkbox:checkbox:checked').each(function(){
				ids += $(this).get(0).id + " ";
			});
			// var userId = $.trim($("#userIdAddChange").val());
			var groupsId = $("#groupsId").get(0);
			groupsId = groupsId.options[groupsId.selectedIndex].value;
			if(ids != false){
				$.ajax({
					url: "queries.php",
					type:"post",
					data:{bool:3,userIds:ids,groupsId:groupsId},
					dataType:"html",
					success: function(data){
						console.log(data);
						Timeout();
						if(data == false){
							$(".span1").text("Группа успешно изменено.");
							$(".span1").css("color","#00CD66");
							$(".errors").fadeIn(500);
						} else {
							var users = data.split(":");
							var names = "";
							var c = ", ";
							for(var i = 0; i < users.length; i++){
								if(users.length == i + 1) c = "";
								names += users[i] + c;
							}
							var text = "я";
							if(users.length != 1) text = "ей";
							$(".span1").text("Невозможно изменить группу пользовател"+text+" - " + names);
							$(".span1").css("color","#EE6363");
							$(".errors").fadeIn(500);
						}
					}
				});
			} else {
				$(".span1").text("Пользователь не выбран!");
				$(".span1").css("color","#EE6363");
				$(".errors").fadeIn(500);
			}
		});
		// Оқушының таңдау пәнін өзгерту.
			$("#changeSubject").click(function(){
				var ids = "";
				$('.checkbox:checkbox:checked').each(function(){
					ids += $(this).get(0).id + " ";
				});
				// var userId = $("#userIdChangeSubject").val();
				var c = $("#Subject2").get(0);
				var subjectId = c.options[c.selectedIndex].value;
				var users = ids.split(" ");
				var text = "я";
				if(users.length != 1) text = "ей";
				var names = "";
				var c = ", ";
				for(var i = 0; i < users.length - 1; i++){
					if(users.length - 1 == i + 1) c = "";
					names += $("#" + users[i]).text() + c;
				}
				if(confirm("Вы действительно хотите изменить 5 предмет ползователя"+text+" - " + names + " ?") && ids != false){
					$.ajax({
						url: "queries.php",
						type:"post",
						data: {bool:6, userIds:ids, subjectId:subjectId},
						dataType: "html",
						success: function(data){
							console.log(data);
							Timeout();
							if(data == false){
								$(".span1").text("Успешно изменено.");
								$(".span1").css("color","#00CD66");
								$(".errors").fadeIn(500);
								$("#userIdChangeSubject").val("")
							} else {
								$(".span1").text("Пользователь с таким ID не найдено.");
								$(".span1").css("color","#EE6363");
								$(".errors").fadeIn(500);
							}
						}
					});
				} else {
					$(".span1").text("Пользователь не выбран!");
					$(".span1").css("color","#EE6363");
					$(".errors").fadeIn(500);
				}
			});
		// Топтың кураторын ауыстыру.
			$("#changeGroup").click(function(){
				var c = $("#groupsIdChangeGroup").get(0);
				var groupId = c.options[c.selectedIndex].value;
				var v = $("#curatorChangeGroup").get(0);
				var curatorId = v.options[v.selectedIndex].value;
				if(confirm("Вы действительно хотите изменить куратора группы - " + c.options[c.selectedIndex].text + " ?")){
					$.ajax({
						url: "queries.php",
						type:"post",
						data: {bool:7, groupId:groupId, curatorId:curatorId},
						dataType: "html",
						success: function(data){
							Timeout();
							if(data == 1){
								$(".span1").text("Успешно изменено.");
								$(".span1").css("color","#00CD66");
								$(".errors").fadeIn(500);
								$("#userIdChangeSubject").val("")
							} else {
								$(".span1").text("Группа не найдено.");
								$(".span1").css("color","#EE6363");
								$(".errors").fadeIn(500);
							}
						}
					});
				}
			});
		// edit status of teacher.
			var p;
			var input ;
			// $(".te").on("mouseenter", function(){
			$(".blockLeft").delegate(".te", "mouseenter", function(){
				$(".status").show();
				$(".write").hide();
				p = $(this).children().get(0).id;
				input = $(this).children().get(1).id;
				$("#" + p).hide();
				$("#" + input).show();
			});
			$(".blockLeft").delegate(".edit1", "click", function(){
			// $(".edit1").click(function(){
				var id = $(this).get(0).id;
				var status = $("#statusWillWriteT" + id).val();
				var tel = $("#telWillWriteT" + id).val();
				$.ajax({
					url: "queries.php",
					type:"post",
					data: {bool:8, teacherId:id, status:status, tel:tel},
					dataType: "html",
					success: function(data){
						Timeout();
						if(data == 1){
							$("#statusWrittenT" + id).text(status);
							$("#statusWillWriteT" + id).val(status);
							$("#telWrittenT" + id).text(tel);
							$("#statusWriteT" + id).val(tel);
							$(".status").show();
							$(".write").hide();
							$(".span1").text("Успешно изменено.");
							$(".span1").css("color","#00CD66");
							$(".errors").fadeIn(500);
							$("#userIdChangeSubject").val("")
						}
					}
				});
			});
		// edit info pupil.
			$(".blockLeft").delegate(".te3", "mouseenter", function(){
			// $(".te3").on("mouseenter", function(){
					$(".te3 .p2").show();
					$(".te3 .write").hide();
					p = $(this).children().get(0).id;
					input = $(this).children().get(1).id;
					$("#" + p).hide();
					$("#" + input).show();
				});

			$(".blockLeft").delegate(".edit2", "click", function(){
			// $(".edit2").click(function(){
				var id = $(this).get(0).id;
				var m = id.split(" ");
				var id = parseInt(m[0]);
				var userId = parseInt(m[1]);
				var info = $("#editI" + id).val();
				$.ajax({
					url: "queries.php",
					type:"post",
					data: {bool:11, info:info, userId:userId,id:id},
					dataType: "html",
					success: function(data){
						Timeout();
						if(data == 1){
							$("#editP" + id).text(info);
							$("#editI" + id).val(info);
							$("#editP" + id).show();
							$("#editI" + id).hide();
							$(".span1").text("Успешно изменено.");
							$(".span1").css("color","#00CD66");
							$(".errors").fadeIn(500);
							$("#userIdChangeSubject").val("")
						}
					}
				});
			}); 
		
		// Delete teacher
			$(".delete1").click(function(){
				var id = $(this).get(0).id;
					if(confirm("Вы действительно хотите удалить учителя - " + $("#NameTeacher" + id).text() + " ?")){
						$.ajax({
							url: "queries.php",
							type:"post",
							data: {bool:9, teacherId:id},
							dataType: "html",
							success: function(data){
								Timeout();
								if(data == 1){
									$(".span1").text("Успешно удалено.");
									$(".span1").css("color","#00CD66");
									$(".errors").fadeIn(500);
									$("#userIdChangeSubject").val("");
								}
							}
						});
					}
				});
		// Add teacher
			$("#addTeather").click(function(){
					var name = $("#nameTeacher").val();
					var subject = $("#subjectTeacher").val();
					var tel = $("#telTeacher").val();
					var status = $("#statusTeacher").val();
					if(name != false && subject != false && tel != false && status != false){
						$.ajax({
							url: "queries.php",
							type:"post",
							data: {bool:10, name:name, subject:subject, tel:tel, status:status},
							dataType: "html",
							success: function(data){
								Timeout();
								if(data == 1){
									$(".span1").text("Успешно добавлено.");
									$(".span1").css("color","#00CD66");
									$(".errors").fadeIn(500);
									$("#nameTeacher").val("");
									$("#subjectTeacher").val("");
									$("#telTeacher").val("");
									$("#statusTeacher").val("");
								}
							}
						});
					}
				});
		// Add Curator
			$("#addCurator").click(function(){
				var name = $("#nameCurator").val();
				var tel = $("#telCurator").val();
				if(name != false &&  tel != false){
					$.ajax({
						url: "queries.php",
						type: "post",
						data: {bool:14,name:name, tel:tel},
						dataType: "html",
						success: function(data){
							if(data == 1){
								Timeout();
								$(".span1").text("Куратор успешно добавлен.");
								$(".span1").css("color","#00CD66");
								$(".errors").fadeIn(500);
								$("#nameCurator").val("");
								$("#telCurator").val("");
							}
						}
					});
				}
			});

		// edit Curator
			$(".teC").on("mouseenter", function(){
				$(".telCurator").show();
				$(".write").hide();
				p = $(this).children().get(0).id;
				input = $(this).children().get(1).id;
				$("#" + p).hide();
				$("#" + input).show();
			});
			// edit tel Curator
				$(".edit3").click(function(){
					var id = $(this).get(0).id;
					var tel = $("#telWillWrite" + id).val().split(":");
					var tel1 = tel[0];
					var tel2 = tel[1];
					$.ajax({
						url: "queries.php",
						type: "post",
						data: {bool:15,tel1:tel1, tel2:tel2, curatorId:id},
						dataType: "html",
						success: function(data){
							if(data == 1){
								Timeout();
								$(".span1").text("Успешно изменено.");
								$(".span1").css("color","#00CD66");
								$(".errors").fadeIn(500);
								$("#telWillWrite" + id).val(tel1 + ":" + tel2);
								$("#telWritten" + id).html(tel1 + "<br>" + tel2);
								$(".telCurator").show();
								$(".write").hide();
							}
						}
					});
				});
			// Delete Curator
				$(".delete3").click(function(){
					var id = $(this).get(0).id;
					if(confirm("Вы действительно хотите удалить куратора - " + $("#nameCurator" + id).text() + " ?")){
						$.ajax({
							url: "queries.php",
							type: "post",
							data: {bool:16,id:id},
							dataType: "html",
							success: function(data){
								if(data == 1){
									Timeout();
									$(".span1").text("Куратор успешно удален.");
									$(".span1").css("color","#00CD66");
									$(".errors").fadeIn(500);
									document.location.replace("../page/profile4.php");
								}
							}
						});
					}
				});
			// add assistent
				$("#addAssistent").click(function(){
					var name = $("#nameAssistent").val();
					var curator = $("#curatorAssistent").val();
					if(name != false &&  curator != false){
						$.ajax({
							url: "queries.php",
							type: "post",
							data: {bool:17,name:name, curator:curator},
							dataType: "html",
							success: function(data){
								if(data == 1){
									Timeout();
									$(".span1").text("Ассистент успешно добавлен.");
									$(".span1").css("color","#00CD66");
									$(".errors").fadeIn(500);
									$("#nameAssistent").val("");
									$("#curatorAssistent").val("");
								}
							}
						});
					}
				});
			// delete assistent
				$(".delete4").click(function(){
					var id = $(this).get(0).id;
					if(confirm("Вы действительно хотите удалить куратора - " + $("#nameAssistant" + id).text() + " ?")){
						$.ajax({
							url: "queries.php",
							type: "post",
							data: {bool:18,assistantId:id},
							dataType: "html",
							success: function(data){
								if(data == 1){
									Timeout();
									$(".span1").text("Ассистент успешно удален.");
									$(".span1").css("color","#00CD66");
									$(".errors").fadeIn(500);
								}
							}
						});
					}
				});
			// edit assistent
				$(".teA").on("mouseenter", function(){
					$(".status").show();
					$(".write").hide();
					p = $(this).children().get(0).id;
					input = $(this).children().get(1).id;
					$("#" + p).hide();
					$("#" + input).show();
				});
			// edit tel assistant
				$(".edit4").click(function(){
					var id = $(this).get(0).id;
					var curator = $("#assistantWillWrite" + id).val();
					$.ajax({
						url: "queries.php",
						type: "post",
						data: {bool:19,curator:curator, assistantId:id},
						dataType: "html",
						success: function(data){
							if(data == 1){
								Timeout();
								$(".span1").text("Успешно изменено.");
								$(".span1").css("color","#00CD66");
								$(".errors").fadeIn(500);
								$("#assistantWillWrite" + id).val("");
								$("#assistantWritten" + id).html(curator);
								$(".status").show();
								$(".write").hide();
							}
						}
					});
				});
		//  Баға қою
			var m = [0,0,0,0,0];
			$(".tB").on("mouseenter", function(){
				// $(".tB .pB").show();
				// $(".tB .writeB").hide();
				p = $(this).children().get(0).id;
				input = $(this).children().get(1).id;
				$("#" + p).hide();
				$("#" + input).show();
			});
			$(".tB").on("mouseleave", function(){
				$(".tB .pB").show();
				$(".tB .writeB").hide();
				p = $(this).children().get(0).id;
				input = $(this).children().get(1).id;
				var id = $(this).children().get(0).className.substr(3);

				var total100 = $("#total100" + id).text();
				if(total100 == false) total100 = 0;

				var total125 = $("#total125" + id).text();
				if(total125 == false) total125 = 0;

				var val = $("#" + input).val();
				if(val == false) val = 0;

				total100 = parseInt(total100);
				total125 = parseInt(total125);
				val = parseInt(val);
				$("#" + p).text("" + val);
				var kl = $("#klP" + id).text() != false ? $("#klP" + id).text(): 0;
				var ma = $("#mP" + id).text() != false ? $("#mP" + id).text(): 0;
				var h = $("#hP" + id).text() != false ? $("#hP" + id).text(): 0;
				var rl = $("#rlP" + id).text() != false ? $("#rlP" + id).text(): 0;
				var s5 = $("#s5P" + id).text() != false ? $("#s5P" + id).text(): 0;
				m[0] = parseInt(kl);
				m[1] = parseInt(ma);
				m[2] = parseInt(h);
				m[3] = parseInt(rl);
				m[4] = parseInt(s5);
				if(p == "klP" + id) m[0] = val;
				else if(p == "mP" + id) m[1] = val;
				else if(p == "hP" + id) m[2] = val;
				else if(p == "rlP" + id) m[3] = val;
				else if(p == "s5P" + id) m[4] = val;
				total100 = m[0] + m[1] + m[2] + m[4];
				total125 = m[0] + m[1] + m[2] + m[3] + m[4];
				$("#total100" + id).text("" + (total100));
				$("#total125" + id).text("" + (total125));
			});
			$(".buttonSave2").click(function(){
					var bool = true;
					$(".tB").css("background", "#fff");
					$(".tB p").css("color", "#333");
					var tId;
					var allResults = "";
					var c = ":";
					var tId = $(this).get(0).id;
					var topic = $("#topic" + tId).val();
					var message = $("#messageToPupil" + tId).val();
					var m = $("#tId" + tId + " .tr2");
					for(var i = 1; i < m.length; i++){
						if (i + 1 == m.length) c = "";
						var userId = m[i].id;

						var kl =$("#klP" + userId).text();

						var math = $("#mP" + userId).text();

						var history = $("#hP" + userId).text();

						var rl = $("#rlP" + userId).text();

						var sub5 = $("#s5P" + userId).text();

						if(kl == "") {$("#klP" + userId).css("color", "#fff");$("#klP" + userId).parent().css("background", "#c9302c");bool = false;}
						if(math == "") {$("#mP" + userId).css("color", "#fff");$("#mP" + userId).parent().css("background", "#c9302c");bool = false;}
						if(history == "") {$("#hP" + userId).css("color", "#fff");$("#hP" + userId).parent().css("background", "#c9302c");bool = false;}
						if(rl == "") {$("#rlP" + userId).css("color", "#fff");$("#rlP" + userId).parent().css("background", "#c9302c");bool = false;}
						if(sub5 == "") {$("#s5P" + userId).css("color", "#fff");$("#s5P" + userId).parent().css("background", "#c9302c");bool = false;}
						var totalOf100 = parseInt(kl) + parseInt(math) + parseInt(history) + parseInt(rl);
						var totalOf125 = totalOf100 + parseInt(sub5);
						allResults += userId + " " + kl + " " + math + " " + history + " " + rl + " " + sub5 + " " + totalOf100 + " " + totalOf125 + c;
					}
					if(bool){
						$.ajax({
							url: "queries.php",
							type: "post",
							data: {bool:12,groupId:parseInt(tId), topic:topic,message:message, allResults:allResults},
							dataType: "html",
							success: function(data){
								console.log(parseInt(tId), topic, message, allResults);
								if(data == 1){
									$(".clear").val("");
									$(".clearP").text("");
									Timeout();
									$(".span1").text("Успешно сделано.");
									$(".span1").css("color","#00CD66");
									$(".errors").fadeIn(500);
									$(".pB").text("");
									$(".writeB").val("");
									$("#topic" + tId).val("");
								}
							}
						});
					}else{
						Timeout();
						$(".span1").text("Барлық балды енгізіңіз !");
						$(".span1").css("color","#EE6363");
						$(".errors").fadeIn(500);
					}
				});
		// delete post

			$("#topicW").delegate(".DeletePost", "click", function(){
				var groupId = parseInt($(this).get(0).id);
				$.ajax({
					url: "queries.php",
					type: "post",
					data: {bool:13,groupId:groupId},
					dataType: "html",
					success: function(data){
						// console.log(data);
						if(data == 1){
							Timeout();
							$(".span1").text("Успешно сделано.");
							$(".span1").css("color","#00CD66");
							$(".errors").fadeIn(500);
							// document.location.replace("../page/workWithCurator.php");
						}
					}
				});
			});
		// Open and Close
			$(".p1").click(function(){
				var tag = $(this).children();
				var id = tag.get(0).id;
				// console.log(id);
				if(id == 1){
					tag.html("&#9660")
					tag.get(0).id = 2;
				} else {
					tag.html("&#9658")
					tag.get(0).id = 1;
				}
				$(this).next().slideToggle(50);
			});

			$(".Open").click(function(){
				var tag = $(this).children();
				var id = tag.get(0).id;
				// console.log(id);
				if(id == 1){
					tag.html("&#9660")
					tag.get(0).id = 2;
				} else {
					tag.html("&#9658")
					tag.get(0).id = 1;
				}
				$(this).next().slideToggle(500);
			});

			$(".Open2").click(function(){
				var tag = $(this).children().next();
				var id = tag.get(0).id;
				if(id == 1){
					tag.html("&#9660")
					tag.get(0).id = 2;
				} else {
					tag.html("&#9658")
					tag.get(0).id = 1;
				}
				$(this).next().slideToggle(1);
			});

			$(".OpenEditAndMore").click(function(){
				var tag = $(this).children();
				var id = tag.get(0).id;
				// console.log(id);
				if(id == 1){
					tag.html("&#9650")
					tag.get(0).id = 2;
				} else {
					tag.html("&#9658")
					tag.get(0).id = 1;
				}
				// $(this).next().slideToggle(500);
			});
	// Search
		function searchUsers(data){
			if(data != false){
				$(".found").show();
				$(".error2").text("");
				$("#found").html('<tr class="tr2"><th class="th2 th2f">№</th><th class="th2 nameB">Аты-жөні</th><th class="th2">Таңдау-пәні</th><th class="th2">Телефон</th><th class="th2">ID</th><th class="th2"></th></tr>');
				var td = "";
				var num = data.length;
				for(var i = 0; i < data.length; i++){
					var row = data[i];
					$("#changeSchoolGetId").text(row['id']);
					if(i + 1 == num) td = "td2l";
					$("#found").append('<tr class="tr2"><td class="td2 td2f '+td+'">'+(i + 1)+'</td><td class="td2 '+td+' tdName"><a class = "userNameFound" id = "id'+row['id']+'">'+row['name']+'</a></td><td class="td2 '+td+'">'+row["subject"]+'</td><td class="td2 '+td+'">'+row['tel']+'</td><td class="td2 '+td+'">'+row['userId']+'</td><td class="td2 simvols2 '+td+'"><p id = "'+row['id']+'" class = "willDelete removeUser" title = "Оқудан шығатын оқушылар тізіміне қосу."><i class="fa fa-times" aria-hidden="true"></i></p></td></tr>');
				}
			} else {
				$("#found").html("");
				$(".found").show();
				$(".error2").text("Пользователь с таким именем не найдено.");
			}
		}


		$("#findUsersWithShcoolButton").click(function(){
			var c = $("#findUsersWithShcool").get(0);
			var school = c.options[c.selectedIndex].value;
			$.ajax({
				url: "queries.php",
				type:"post",
				data: {bool:202, school:school},
				dataType: "json",
				success: function(data){
					searchUsers(data);
				}
			});
		});
		$("#search").on("keyup", function(){
			var text = $(this).val();
			if(text != false){
				$.ajax({
					url: "queries.php",
					type:"post",
					data: {bool:20, text:text},
					dataType: "json",
					success: function(data){
						searchUsers(data);
						console.log(data);
					}
				});
			} else {
				$(".found").hide();
				$("#found").html("");
			}
		});
	
	// Оқушы жайлы мәлімет алу
		$("#search2").on("keyup", function(){
			var text = $(this).val();
			if(text != false){
				$.ajax({
					url: "queries.php",
					type:"post",
					data: {bool:20, text:text},
					dataType: "json",
					success: function(data){
						if(data != false){
							$(".found2").show();
							$(".error3").text("");
							$("#found2").html('<tr class="tr2"><th class="th2 th2f">№</th><th class="th2 nameB">Аты-жөні</th><th class="th2">Номері</th><th class="th2">Әкесі</th><th class="th2">Анасы</th><th class="th2">Тобы</th><th class="th2"></th></tr>');
							var td = "";
							var num = data.length;
							for(var i = 0; i < data.length; i++){
								var row = data[i];
								if(i + 1 == num) td = "td2l";
								$("#found2").append('<tr class="tr2"><td class="td2 td2f '+td+'">'+(i + 1)+'</td><td class="td2 '+td+' tdName"><p class = "userName getName'+row['id']+'" id = "'+row['id']+'">'+row['name']+'</p></td><td class="td2 '+td+'">'+row["tel"]+'</td><td class="td2 '+td+'">'+row['tel2']+'</td><td class="td2 '+td+'">'+row['tel3']+'</td><td class="td2 '+td+'">'+row['group']+'</td><td class="td2 simvols2 '+td+'"><p class = "do1 late" id = "'+row['id']+'" title = "Келмеген оқушылар тізіміне қосу."><b>&#10143;</b></p><p id = "'+row['id']+'" class = "do2  willDelete" title = "Оқудан шығатын оқушылар тізіміне қосу.">&#10010;</p></td></tr>');
							}
						} else {
							$("#found2").html("");
							$(".found2").show();
							$(".error3").text("Пользователь с таким именем не найдено.");
						}
					}
				});
				} else {
					$(".found2").hide();
					$("#found2").html("");
				}
			});
		$(".found2").delegate( ".late", "click",function(){
			var id = $(this).get(0).id;
			console.log(id);
			var name = $("#id" + id).text()
			$(".tWhy").html('<tr class="tr2"><th class="th2 th2f">№</th><th class="th2 nameB">Аты-жөні</th><th class="th2">Келмеу себебі</th><th class="th2"><p class = "do2 Exit" id = "'+id+'" title = "Закрыть">&#10006;</p></th></tr><tr class="tr2"><td class="td2 td2l td2f">1</td><td class="td2 td2l tdName"><p class = "NameTeacher" id = "'+id+'">'+name+'</p></td><td class="td2 td2l "><input type="text" class="write write6" id = "whyWillWrite'+id+'"></td><td class="td2 td2l Save"><p class = "do1 WhySave" id = "'+id+'" title = "Сохранить.">&#10004;</p></td></tr>');
			$(".Why").slideDown(500);
			$(".write6").focus();
		});
		$(".Why").delegate(".Exit", "click", function(){
			$(".Why").slideUp(500);
		});

		$(".Why").delegate(".WhySave", "click", function(){
			var id = $(this).get(0).id;
			var text = $("#whyWillWrite" + id).val();
			if(text != false){
				$.ajax({
					url: "queries.php",
					type:"post",
					data:{bool:21, bool2:1,userId:id, text:text},
					dataType:"html",
					success: function(data){
						if(data == 1){
							Timeout();
							$(".span1").text("Успешно сохранено.");
							$(".span1").css("color","#00CD66");
							$(".errors").fadeIn(500);
							$("#whyWillWrite" + id).val("");
						}
					}
				});
			}
		});
		$(".Hide").delegate( ".willDelete", "click",function(){
			var id = $(this).get(0).id;
			console.log(id);
			if(confirm("Вы действительно хотите удалить - " + $("#id" + id).text() + " ?")){
				$.ajax({
					url: "queries.php",
					type: "post",
					data: {bool:21, bool2:2,userId:parseInt(id)},
					dataType: "html",
					success: function(data){
						if(data == 1){
							Timeout();
							$(".span1").text("Успешно добавлено.");
							$(".span1").css("color","#00CD66");
							$(".errors").fadeIn(500);
						}
					}
				});
			}
		});
	// profile5 search2
		$(".fa-search").on("click", function(){
			var text = $("#search3").val();
			if(text != false){
				$.ajax({
					url: "queries.php",
					type:"post",
					data: {bool:22, text:text},
					dataType: "json",
					success: function(data){
						if(data != false){
							console.log(data);
							var id = data[0];
							var name = data[1];
							var text = data[2].split(":");
							$(".userNotCome").text(name);
							$("#found3").html('<tr class="tr2"><th class="th2 th2f">№</th><th class="th2">Келмеу себебі</th><th class="th2">Күні</th></tr>');
							var td = "";
							var num = text.length;
							for(var i = 0; i < num; i++){
								var row = text[i].split(";");
								if(i + 1 == num) td = "td2l";
								$("#found3").append('<tr class="tr2"><td class="td2 td2f '+td+'">'+(i + 1)+'</td><td class="td2 '+td+'"><p>'+row[1]+'</p></td><td class="td2 '+td+'"><p>'+row[0]+'</p></td></tr>');
							}

							$(".found3").slideDown(1000);
							$(".error4").text("");
							$(".error4").slideUp(500);
							// $(".found3").append('<input type="button" id = "send" class = "button buttonSave" value = "Есеп бөліміне жіберу">');
						} else {
							$("#found3").html("");
							$(".found3").slideDown(1000);
							$(".error4").text("Бұл оқушы жайында мәліметтер тіркелмеген.");
							$(".error4").slideDown(500);
						}
					}
				});
				} else {
					$(".found3").slideUp(1000);
					$("#found3").html("");
				}
			});
			// Барлық бағалар және смс тер
				$(".getAll").click(function(){
					$.ajax({
						url: "queries.php",
						type: "post",
						data:{bool:23},
						dataType:"json",
						success: function(data){
							console.log(data);
							var oKl = 0,
								oM = 0,
								oH = 0;
								oRl = 0,
								oSub5 = 0,
								oTotal100 = 0,
								oTotal125 = 0;
							$(".Table").html("");
							if(data[data.length - 1] == 1) $(".NameGroup").html('Куратормен жұмыс <i class="fa fa-long-arrow-right" aria-hidden="true"></i> ' + data[data.length - 2]);
							else $(".NameGroup").html('Оқушылармен жұмыс <i class="fa fa-long-arrow-right" aria-hidden="true"></i> ' +data[data.length - 2]+ ' тобы');
							if(data != false && data.length > 2){
								var groupId = data[0][data[0].length - 1];
								var date = data[0][0];
								var message = data[0][1];
								var topic = data[0][2];
								$(".fromCurator").show(1);
								var td = "";
								var num = data.length - 3;
								var N = 0;
								$("#topicW").html(topic+'<span class = "open" id = "dateW">'+date+'<span class = "DeletePost" id = "'+groupId+'" title = "Удалить.">&#10006;</span></span>');
								
								$("#messageW").text(message);
								$(".Table").append('<tr class="tr2"><th class="th2 th2f nB">№</th><th class="th2 nameB nameB2" >Аты-жөні</th><th class="th2 subjectB">қ.т</th><th class="th2 subjectB">м</th><th class="th2 subjectB">т</th><th class="th2 subjectB">о.т</th><th class="th2 subjectB">5</th><th class="th2 subjectB">100</th><th class="th2 subjectB">125</th><th class="th2 tTopic">Таңдау пәні</th></tr>');
								for(var i = 1; i < data.length - 2; i++){
									N++;
									var n = data[i];
									var kl = n[0];
									var m = n[1];
									var h = n[2];
									var rl = n[3];
									var sub5 = n[4];
									var total100 = n[5];
									var total125 = n[6];
									var subject = n[7];
									var id = n[8];
									var name = n[9];

									oKl += parseInt(kl);
									oM += parseInt(m);
									oH += parseInt(h);
									oRl += parseInt(rl);
									oSub5 += parseInt(sub5);
									oTotal100 += parseInt(total100);
									oTotal125 += parseInt(total125);
									// if(i == num) td = "td2l";
									$(".Table").append('<tr class="tr2 ChangeColor"><td class="td2 td2f '+td+'">'+i+'</td><td class="td2 '+td+' tdName"><p class = "NameTeacher" id = "'+id+'">'+name+'</p></td><td class="td2 '+td+'"><p class = "pB">'+kl+'</p></td><td class="td2 '+td+'"><p class = "pB">'+m+'</p></td><td class="td2 '+td+'"><p class = "pB">'+h+'</p></td><td class="td2 '+td+'"><p class = "pB">'+rl+'</p></td><td class="td2 '+td+'"><p class = "pB">'+sub5+'</p></td><td class="td2 '+td+'"><p class = "pB">'+total100+'</p></td><td class="td2 '+td+'"><p class = "pB">'+total125+'</p></td><td class="td2 '+td+' tdSubject"><p>'+subject+'</p></td></tr>');
								}
									oKl = (oKl / N).toFixed(2);
									oM = (oM / N).toFixed(2);
									oH = (oH / N).toFixed(2);
									oRl = (oRl / N).toFixed(2);
									oSub5 = (oSub5 / N).toFixed(2);
									oTotal100 = (oTotal100 / N).toFixed(2);
									oTotal125 = (oTotal125 / N).toFixed(2);
									// td = "td2l";
									$(".Table").append('<tr class="tr2 ChangeColor"><td class="td2 td2f '+td+'"></td><td class="td2 '+td+' tdName"><p class = "NameTeacher" id = "'+id+'">Орта балл:</p></td><td class="td2 '+td+'"><p class = "pB">'+(oKl)+'</p></td><td class="td2 '+td+'"><p class = "pB">'+(oM)+'</p></td><td class="td2 '+td+'"><p class = "pB">'+(oH )+'</p></td><td class="td2 '+td+'"><p class = "pB">'+(oRl)+'</p></td><td class="td2 '+td+'"><p class = "pB">'+(oSub5)+'</p></td><td class="td2 '+td+'"><p class = "pB">'+(oTotal100)+'</p></td><td class="td2 '+td+'"><p class = "pB">'+(oTotal125)+'</p></td><td class="td2 '+td+' tdSubject"></td></tr>');
							
									oKl = (oKl * 100 / 25).toFixed(2) + "";
									oM = (oM * 100 / 25).toFixed(2) + "";
									oH = (oH * 100 / 25).toFixed(2) + "";
									oRl = (oRl * 100 / 25).toFixed(2) + "";
									oSub5 = (oSub5 * 100 / 25).toFixed(2) + "";
									oTotal100 = (oTotal100 * 100 / 100).toFixed(2) + "";
									oTotal125 = (oTotal125 * 100 / 125).toFixed(2) + "";
									td = "td2l";
									$(".Table").append('<tr class="tr2 ChangeColor"><td class="td2 td2f '+td+'"></td><td class="td2 '+td+' tdName"><p class = "NameTeacher" id = "'+id+'">Орта балл %:</p></td><td class="td2 '+td+'"><p class = "pB">'+(oKl)+'</p></td><td class="td2 '+td+'"><p class = "pB">'+(oM)+'</p></td><td class="td2 '+td+'"><p class = "pB">'+(oH )+'</p></td><td class="td2 '+td+'"><p class = "pB">'+(oRl)+'</p></td><td class="td2 '+td+'"><p class = "pB">'+(oSub5)+'</p></td><td class="td2 '+td+'"><p class = "pB">'+(oTotal100)+'</p></td><td class="td2 '+td+'"><p class = "pB">'+(oTotal125)+'</p></td><td class="td2 '+td+' tdSubject"></td></tr>');
							} else {
								$(".fromCurator").hide(1);
							}
						}
					});
					setTimeout(function(){
						var text = $(".bodyD").html();
						$("#bodyDTest").html(text);
						var len = $("#bodyDTest").css("height").length;
						var height = parseInt($("#bodyDTest").css("height").substr(0, len - 2));
						$(".bodyD").scrollTop(height + 10000000);
					},200);});
	// profile2 open
		$(".groupBaga").click(function(){
			$(".blockLeft2,.minLeft,.minRight").slideUp(1000);
			$(".Close, .BagaClose").slideUp(1000);
			var id = $(this).get(0).id;
			$("#groupBaga" + id).slideDown(1000);
		});
		$(".groupZhalpyBaga").click(function(){
			$(".blockLeft2,.minLeft,.minRight").slideUp(1000);
			$(".Close, .BagaClose").slideUp(1000);
			var id = $(this).get(0).id;
			$("#groupZhalpyBaga" + id).slideDown(1000);
		}); 
		$(".toPageP").click(function(){
			$(".blockLeft2,.minLeft,.minRight").slideUp(1000);
			$(".Close").slideUp(1000);
			// var id = $(this).get(0).id;
			$(".workWithCuratorDiv").slideDown(1000);
		});
		// Жалпы бағаның ұзындығы
			var tables = $(".tOb");
			for(var i = 0; i < tables.length; i++){
				var number = tables.get(i).className.split(" ")[2];
				var table = parseInt(number) * 50 + 255;
				$("#table" + (i + 1)).css("width", table + "px");
			}
	// pofile 4 Open
		$(".OpenListOfCuratorsP").click(function(){
			$(".Close").slideUp(1000);
			$(".OpenListOfCuratorsDiv").slideDown(1000);
		});
		$(".OpenListOfAssistantsP").click(function(){
			$(".Close").slideUp(1000);
			$(".OpenListOfAssistantsDiv").slideDown(1000);
		});

		$(".wasLatePupilsP").click(function(){
			$(".Close").slideUp(1000);
			$(".wasLatePupilsDiv").slideDown(1000);
		});
		$(".OpenListOfTeachersP").click(function(){
			$(".Close").slideUp(1000);
			$(".OpenListOfTeachersDiv").slideDown(1000);
		});

		$(".OpenListOfTeachersGoneP").click(function(){
			$(".Close").slideUp(1000);
			$(".OpenListOfTeachersGoneDiv").slideDown(1000);
		});


		$(".OpenListOfPupilsP").click(function(){
			$(".Close").slideUp(1000);
			$(".OpenListOfPupilsDiv").slideDown(1000);
		});
		$(".OpenListOfPupilsP2").click(function(){
			$(".Close").slideUp(1000);
			$(".OpenListOfPupilsDiv2").slideDown(1000);
		});
	// profile5 open
		$(".getInfoAboutUserP").click(function(){
			$(".Close").slideUp(1000);
			$(".getInfoAboutUserDiv").slideDown(1000);
		});
		$(".getInfoAboutUserP2").click(function(){
			$(".Close").slideUp(1000);
			$(".getInfoAboutUserDiv2").slideDown(1000);
		});
	// настройки
	$(".TurnOfIdP").click(function(){
		$(".CloseAllDivs").slideUp(1000);
		$(".TurnOfIdDiv").slideDown(1000);
	});
	$(".DeleteUserP").click(function(){
		$(".CloseAllDivs").slideUp(1000);
		$(".DeleteUserDiv").slideDown(1000);
	});
	$(".CreatNewGroupP").click(function(){
		$(".CloseAllDivs").slideUp(1000);
		$(".CreatNewGroupDiv").slideDown(1000);
	});
	$(".CloseGroupP").click(function(){
		$(".CloseAllDivs").slideUp(1000);
		$(".CloseGroupDiv").slideDown(1000);
	});

	$(".AddUserToGroupP").click(function(){
		$(".CloseAllDivs").slideUp(1000);
		$(".AddUserToGroupDiv").slideDown(1000);
	});
	$(".ChangeCuratorP").click(function(){
		$(".CloseAllDivs").slideUp(1000);
		$(".ChangeCuratorDiv").slideDown(1000);
	});
	$(".ChangeSubjectP").click(function(){
		$(".CloseAllDivs").slideUp(1000);
		$(".ChangeSubjectDiv").slideDown(1000);
	});
	//  Бірнеше оқушыға арналған өзгертулер
		$(".Click2").click(function(){
			var ids = "";
			$('.checkbox:checkbox:checked').each(function(){
				ids += $(this).get(0).id + " ";
			});
			$.ajax({
				url: "queries.php",
				type: "post",
				data: {bool:25, ids:ids},
				dataType: "json",
				success: function(data){
					if(data != false){
						$(".DeleteTable").html('<tr class="tr2 ChangeColor"><th class="th2 th2f Number">№</th><th class="th2 nameMF NameAndSurname">Аты-жөні</th></tr>');
						var td = "";
						for(var i = 0; i < data.length; i++){
							if (i + 1 == data.length) td = "td2l";
							$(".DeleteTable").append('<tr class="tr2 ChangeColor"><td class="td2 td2f tdn '+td+'">'+(i + 1)+'</td><td class="td2 '+td+'"><p class = "userName2">'+data[i]+'</p></td></tr>');
						}
					}
				}
			});
		}); 
	// Барлық бағалар және смс тер for Nurdaulet agai
		$(".getAllForN").click(function(){
			$.ajax({
				url: "queries.php",
				type: "post",
				data:{bool:26},
				dataType:"json",
				success: function(data){
					console.log(data);
					$(".workWithCuratorDiv2").html('<p class = "p NameGroup"></p><span class = "error Error"></span>');
					$(".NameGroup").html('Тест нәтижиелері <i class="fa fa-long-arrow-right" aria-hidden="true"></i> ' +data[data.length - 1] +' <i class="fa fa-long-arrow-right" aria-hidden="true"></i> ' +data[data.length - 3]+ ' тобы');
					if(data != false && data.length > 3){
						var m = data[0].split("|");
						var len = m.length - 1;
						console.log(len);
						for(var i = len; i != -1; i--){
							var n = m[i].split(":");
							$(".workWithCuratorDiv2").append('<div class = "fromCurator'+(i + 1)+'"><p class = "p CURATOR" id = "topicW'+(i + 1)+'"></p><table class="t2 Table'+(i + 1)+'"></table></div>');

							$(".Table" + (i + 1)).html("");
								var date = n[0];
								var message = n[1];
								var topic = n[2];
								$(".fromCurator" + (i + 1)).show(1);
								$("#topicW" + (i + 1)).html(topic+'<span class = "open" id = "dateW">'+date+'</span>');
								
								$("#messageW" + (i + 1)).text(message);
								$(".Table" + (i + 1)).append('<tr class="tr2"><th class="th2 th2f nB">№</th><th class="th2 nameB nameB2" >Аты-жөні</th><th class="th2 subjectB">қ.т</th><th class="th2 subjectB">м</th><th class="th2 subjectB">т</th><th class="th2 subjectB">о.т</th><th class="th2 subjectB">5</th><th class="th2 subjectB">100</th><th class="th2 subjectB">125</th><th class="th2 tTopic">Таңдау пәні</th></tr>');
								var td = "";
								var oKl = 0,
									oM = 0,
									oH = 0;
									oRl = 0,
									oSub5 = 0,
									oTotal100 = 0, 
									oTotal125 = 0;
								var N = 0;
								for(var j = 3; j < n.length; j++){
									var b = n[j].split(" ");
									var id = b[0];
									var kl = b[1];
									var math = b[2];
									var h = b[3];
									var rl = b[4];
									var sub5 = b[5];
									var total100 = b[6];
									var total125 = b[7];
									var subject = $("#sub" +id).text();
									var name = $("#id" + id).text();
									N++;
									oKl += parseInt(kl);
									oM += parseInt(math);
									oH += parseInt(h);
									oRl += parseInt(rl);
									oSub5 += parseInt(sub5);
									oTotal100 += parseInt(total100);
									oTotal125 += parseInt(total125);
									// if(j + 1 == n.length) td = "td2l";
									$(".Table" + (i + 1)).append('<tr class="tr2 ChangeColor"><td class="td2 td2f '+td+'">'+(j - 2)+'</td><td class="td2 '+td+' tdName"><p class = "NameTeacher" id = "'+id+'">'+name+'</p></td><td class="td2 '+td+'"><p class = "pB">'+kl+'</p></td><td class="td2 '+td+'"><p class = "pB">'+math+'</p></td><td class="td2 '+td+'"><p class = "pB">'+h+'</p></td><td class="td2 '+td+'"><p class = "pB">'+rl+'</p></td><td class="td2 '+td+'"><p class = "pB">'+sub5+'</p></td><td class="td2 '+td+'"><p class = "pB">'+total100+'</p></td><td class="td2 '+td+'"><p class = "pB">'+total125+'</p></td><td class="td2 '+td+' tdSubject"><p>'+subject+'</p></td></tr>');
								}
									oKl = (oKl / N).toFixed(2);
									oM = (oM / N).toFixed(2);
									oH = (oH / N).toFixed(2);
									oRl = (oRl / N).toFixed(2);
									oSub5 = (oSub5 / N).toFixed(2);
									oTotal100 = (oTotal100 / N).toFixed(2);
									oTotal125 = (oTotal125 / N).toFixed(2);
									// td = "td2l";
									$(".Table"  + (i + 1)).append('<tr class="tr2 ChangeColor"><td class="td2 td2f '+td+'"></td><td class="td2 '+td+' tdName"><p class = "NameTeacher ortaBal" id = "'+id+'">Орта балл:</p></td><td class="td2 '+td+'"><p class = "pB">'+(oKl)+'</p></td><td class="td2 '+td+'"><p class = "pB">'+(oM)+'</p></td><td class="td2 '+td+'"><p class = "pB">'+(oH )+'</p></td><td class="td2 '+td+'"><p class = "pB">'+(oRl)+'</p></td><td class="td2 '+td+'"><p class = "pB">'+(oSub5)+'</p></td><td class="td2 '+td+'"><p class = "pB">'+(oTotal100)+'</p></td><td class="td2 '+td+'"><p class = "pB">'+(oTotal125)+'</p></td><td class="td2 '+td+' tdSubject"></td></tr>');
							
									oKl = (oKl * 100 / 25).toFixed(2) + "";
									oM = (oM * 100 / 25).toFixed(2) + "";
									oH = (oH * 100 / 25).toFixed(2) + "";
									oRl = (oRl * 100 / 25).toFixed(2) + "";
									oSub5 = (oSub5 * 100 / 25).toFixed(2) + "";
									oTotal100 = (oTotal100 * 100 / 100).toFixed(2) + "";
									oTotal125 = (oTotal125 * 100 / 125).toFixed(2) + "";
									td = "td2l";
									$(".Table"  + (i + 1)).append('<tr class="tr2 ChangeColor"><td class="td2 td2f '+td+'"></td><td class="td2 '+td+' tdName"><p class = "NameTeacher ortaBal" id = "'+id+'">Орта балл %:</p></td><td class="td2 '+td+'"><p class = "pB">'+(oKl)+'</p></td><td class="td2 '+td+'"><p class = "pB">'+(oM)+'</p></td><td class="td2 '+td+'"><p class = "pB">'+(oH )+'</p></td><td class="td2 '+td+'"><p class = "pB">'+(oRl)+'</p></td><td class="td2 '+td+'"><p class = "pB">'+(oSub5)+'</p></td><td class="td2 '+td+'"><p class = "pB">'+(oTotal100)+'</p></td><td class="td2 '+td+'"><p class = "pB">'+(oTotal125)+'</p></td><td class="td2 '+td+' tdSubject"></td></tr>');
							}
					} else {
						$(".fromCurator").hide(1);
						$(".Error").text("Бұл топқа бағалар қойылмаған!");
						$(".Error").show(1);
					}
				}
			});
		});
		// $(".blockLeft").delegate(".ChangeColor", "mouseenter", function(){
		// 	$(this).children().css("background", "#DFDFDF");
		// });
		var Class = "";
		$(".ChangeColorTd").delegate(".Money", "click", function(){
			$(".ver").css("background", "#fff");
			$(".ver").children("p").css("color", "#444");
			Class = $(this).get(0).className.split(" ");
			Class = Class[1];
			console.log(Class);
		});
		var c = 0;
		$(".blockLeft").delegate(".ChangeColor", "click", function(){
			var color = $(this).children().css("backgroundColor");
			$(".number12").parent().parent().children().css("background", "#fff");
			$(".number12").parent().parent().children().children("p").css("color", "#444");
			if(color == "rgb(255, 255, 255)"){
				if(Class != false){
					$("." + Class).css("backgroundColor", "#6A5ACD");
					$("." + Class).children("p").css("color", "#fff");
				}
				$(this).children().css("backgroundColor", "#6A5ACD");
				$(this).children().children("p").css("color", "#fff");
			} else {
				$(this).children().css("backgroundColor", "#fff");
				$(this).children().children("p").css("color", "#444");
			}
		});
		
		// $(".blockLeft").delegate(".ChangeColor", "mouseleave", function(){
		// 	if ($(this).children().css("backgroundColor") == "rgb(223, 223, 223)") $(this).children().css("background", "#fff");
		// });

	// Оқушы жайлы мәлімет алу
		function Search(data){
			if(data != false){
				$("#found5").html('<tr class="tr2"><th class="th2 th2f">№</th><th class="th2 nameB">Аты-жөні</th><th class="th2">Номері</th><th class="th2">Әкесі</th><th class="th2">Анасы</th><th class="th2">Тобы</th><th class="th2 th2Line"></th></tr>');
				var td = "";
				var num = data.length;
				for(var i = 0; i < data.length; i++){
					var row = data[i];
					if(i + 1 == num) td = "td2l";
					$("#found5").append('<tr class="tr2"><td class="td2 td2f '+td+'">'+(i + 1)+'</td><td class="td2 '+td+' tdName"><p class = "NameTeacher getName'+row['id']+'" id = "'+row['id']+'">'+row['name']+'</p></td><td class="td2 '+td+'">'+row["tel"]+'</td><td class="td2 '+td+'">'+row['tel2']+'</td><td class="td2 '+td+'">'+row['tel3']+'</td><td class="td2 '+td+'">'+row['group']+'</td><td class="td2 simvols '+td+'"><p class = "do1 late PayPrice" id = "'+row['id']+'" title = "Оплата төлеу."><i class="fa fa-long-arrow-right" aria-hidden="true"></i></p></td></tr>');
				}

				$(".found5").slideDown(1000);
				$(".error5").text("");
				$(".error5").slideUp(500);
			} else {
				$("#found5").html("");
				$(".found5").slideDown(1000);
				$(".error5").slideDown(500);
				$(".error5").text("Пользователь с таким именем не найдено.");
			}
		}

		var Data = [];
		var Data1 = [];
		$("#search5").on("keyup", function(){
			var text = $(this).val();
			if(text != false){
				$.ajax({
					url: "queries.php",
					type:"post",
					data: {bool:20, text:text},
					dataType: "json",
					success: function(data){
						Search(data);
					}
				});
			} else {
				$(".found5").hide();
				$("#found5").html("");
			}
		});
		
		// Оплата жөнінде мәлімет алу жеке адам үшін
			function getDatesPaid(id){
				$.ajax({
					url: "queries.php",
					type:"post",
					data: {bool:201, userId:id},
					dataType: "json",
					success: function(data){
						Data1 = data;
						console.log(data);
						var paid30 = data[0]["30"];
						var m30 = paid30.split(")");
						var len30 = paid30.length;
						$(".tWhy").html("");
						for(var i = 0; i < Data1.length; i++){
							if(Data1[i]['id'] == id){
								Data = Data1[i];
								break;
							}
						}
						var datesPaid = Data["datesPaid"].split(")");
						if(datesPaid[0] != false){
							var th30 = '<th class="th2 dateAndPay">30 %</th>';
							// if(data[0]["30"] == false){
							// 	th30 = "";
							// }
							var td30 = "";
							$(".error5").text("");
							var name = $(".getName" + id).text()
							var datesPaid2 = datesPaid;
							var number = 0;
							for(var i = 0; i < datesPaid2.length; i++){
								datesPaid21 = datesPaid2[i].split("(")[0];
								var Length = 0;
								var m = datesPaid21.split(';');
								if(m[0] != false) Length = m.length;
								if (Length > number) number = m.length;
							}
							var th = "";
							for(var i = 0; i < number; i++){
								th += '<th class="th2 dateAndPay">Күн & ақша</th>';
							}
							th = '<th class="th2 dateAndPay">Айлар</th>' + th30 + th;
							var tdl = "";
							var c = 0;
							var DayAndPraice = [];
							for(var i = 0; i < datesPaid.length; i++){
								var datesPaid2 = datesPaid[i].split("(");
								// if(datesPaid2[0] != false){
									DayAndPraice[c] = datesPaid[i];
									c++;
								// }
							}
							var monthMassive = ['Қаңтар', 'Ақпан', 'Наурыз', 'Сәуір', 'Мамыр', 'Маусым', 'Шілде', 'Тамыз', 'Қыркүйек', 'Қазан', 'Қараша', 'Желтоқсан'];
							if(DayAndPraice != false) $(".tWhy").html('<tr class="tr2"><th class="th2 th2f">№</th>'+ th +'<th class="th2 extraT">Негізгі с.</th><th class="th2 extraT">Төлеу к.</th><th class="th2 extraT">Төленді</th><th class="th2 extraT">Қарызы</th><th class="th2"><p class = "do2 Exit" id = "'+id+'" title = "Закрыть">&#10006;</p></th></tr></tr>');
							for(var i = 0; i < DayAndPraice.length; i++){
								if(DayAndPraice.length == i + 1) tdl = "td2l";
								var money30ToMonth = 0;
								var datesPaid2 = DayAndPraice[i].split("(");
								var m = datesPaid2[0].split(';');
								var n = datesPaid2[1].split(':');
								var month = parseInt(n[0]);
								var MainMoney = parseInt(n[1]);
								var Pay = parseInt(n[2]);
								var Paid = parseInt(n[3]);

								var s = "";
								var day;
								var money ;
								for(var j = 0; j < number; j++){
									if(m[j] != false ){
										var q = m[j].split(":");
										var month2 = q[0];
										day = parseInt(q[1]);
										money = parseInt(q[2]);
										s += '<td class="td2 '+tdl+' mdamTd"><p class = "mdam">'+(month2 + "." + day)+ " - <b>" + money +'</b></p></td>';
									} else {s += '<td class="td2 '+tdl+'"></td>';}
								}

								// 30 %
								var mon30 = "";
								if(data[0]["30"] != false){
									for(var w = 0; w < m30.length; w++){
										if(m30[w] != false){
											var n30 = m30[w].split("(");
											var date = n30[1].split(":");
											if(parseInt(date[0]) == month){
												// s = '<td class="td2 '+tdl+'">'+date[2]+ ' <i class="fa fa-long-arrow-right" aria-hidden="true"></i> ' + n30[0] + '</td>' + s;
												mon30 = date[2]+ ' <i class="fa fa-long-arrow-right" aria-hidden="true"></i> ' + n30[0];
											}
											if(parseInt(n30[0]) == month){
												money30ToMonth = parseInt(date[2]);
											}
										}
									}
								}
								s = '<td class="td2 '+tdl+'">'+mon30+'</td>' + s;
								s = '<td class="td2 '+tdl+'">'+monthMassive[month - 1]+'</td>' + s;
								$(".tWhy").append('<tr class="tr2"><td class="td2 '+tdl+' td2f Count">'+(i + 1)+'</td>'+s+'<td class="td2 '+tdl+'">'+MainMoney+'</td><td class="td2 '+tdl+'">'+Pay+'</td><td class="td2 '+tdl+'">'+(Paid + money30ToMonth)+'</td><td class="td2 '+tdl+'">'+(Pay - Paid - money30ToMonth)+'</td><td class="td2 '+tdl+' Save"></td></tr>');
							}
						} 
						// else $(".error5").text("Пользователь с таким именем не найдено.");
						$(".Why").slideDown(500);
						$(".makePay").slideDown(500);
					}
				});
			}
			$(".blockLeft").delegate( ".PayPrice", "click",function(){
				var id = $(this).get(0).id;
				$(".setDiscountGetId").get(0).id = id;
				$.ajax({
					url: "queries.php",
					type: "post", 
					data: {bool:25, ids:id + " "},
					dataType: "json",
					success: function(data){
						$(".found5").slideUp(1000);
						$(".PayUserName").text(data[0]);
						// if(data != false){
						// 	$(".setDiscountTable").html('<tr class="tr"><th class="th2 th2f Number">№</th><th class="th2 nameMF NameAndSurname">Аты-жөні</th></tr>');
						// 	var td = "";
						// 	for(var i = 0; i < data.length; i++){
						// 		if (i + 1 == data.length) td = "td2l";
						// 		$(".setDiscountTable").append('<tr class="tr2"><td class="td2 td2f tdn '+td+'">'+(i + 1)+'</td><td class="td2 '+td+'"><p class = "userName2">'+data[i]+'</p></td></tr>');
						// 	}
						// }
					}
				});
				getDatesPaid(id);
				$(".getId").get(0).id = id;
				$(".getId30").get(0).id = id;
			});
			$(".ProFilePayP").click(function(){
				$(".blockLeft2,.minLeft,.minRight").slideUp(1000);
				$(".BagaClose").slideUp(1000);
				// $(".ProFilePayDiv").slideDown(1000);
				var id = $(this).get(0).id;
				getDatesPaid(id);
			});

			$(".loadTestsP").click(function(){
				$(".blockLeft2,.minLeft,.minRight").slideUp(1000);
				$(".BagaClose").slideUp(1000);
				$(".Close").slideUp(1000);
				$(".loadTestsDiv").slideDown(1000);
			});

		$(".Why").delegate(".Exit", "click", function(){
			$(".Why").slideUp(500);
		});
	// Төлеу күні Есеп бөлімі
		var text1 = "";
		$(".dayPay").on("mouseenter", function(){
			p = $(this).children().get(0).id;
			input = $(this).children().get(1).id;
			$("#" + p).hide();
			$("#" + input).show();
			text1 = $("#" + p).text();
			$("#" + input).val(text1);
		});
		$(".dayPay").on("mouseleave", function(){
			var userId = parseInt($(this).children().get(0).className.split(" ")[1]);
			p = $(this).children().get(0).id;
			input = $(this).children().get(1).id;
			$("#" + p).show();
			$("#" + input).hide();
			var text = $("#" + input).val();
			$("#" + p).text(text);
			if(text != false && text1 != text){
				$.ajax({
					url: "queries.php",
					type:"post",
					data:{bool:28, text:text,userId:userId},
					dataType:"html",
					success: function(data){
						if(data == 1){
							Timeout();
							$(".span1").text("Успешно сохранено.");
							$(".span1").css("color","#00CD66");
							$(".errors").fadeIn(500);
						}
					}
				});
			}
		});
		// Bilim 
		$("#listMonth").click(function(){
			// $(".getInfoAllGroupL").slideDown(2000);
		});
		// active Test
		$(".activeTest").click(function(){
			var id = $(this).get(0).id;
			$.ajax({
				url: "queries.php",
				type:"post",
				data:{bool:39,bool2:1, id:id},
				dataType:"html",
				success: function(data){
					if(data == 1){
						Timeout();
						$(".span1").text("Успешно сделано.");
						$(".span1").css("color","#00CD66");
						$(".errors").fadeIn(500);
					}
				}
			});
		});
		// desactive Test
		$(".desactiveTest").click(function(){
			var id = $(this).get(0).id;
			$.ajax({
				url: "queries.php",
				type:"post",
				data:{bool:39,bool2:2, id:id},
				dataType:"html",
				success: function(data){
					if(data == 1){
						Timeout();
						$(".span1").text("Успешно сделано.");
						$(".span1").css("color","#00CD66");
						$(".errors").fadeIn(500);
					}
				}
			});
		});
		$('.activeTest1').next().children(".noSimvolTd").css('borderTop', 'none');

		$(".getAllGroup").click(function(){
			var id = $(this).get(0).id;
			$(".middle2").animate({width: "100%",margin: "0" }, 1000);
			$(".getInfoAllGroupL").animate({width: "76.1%" }, 1000);
			$(".getInfoAllGroupR").animate({width: "22%"}, 1000);
			$(".allGroupsOrginal").slideUp(1000);
			$(".allGroups").slideDown(1000);
		});

		$("#getAllGroup").click(function(){
			$(".middle2").animate({width: "100%",margin: "0" }, 1000);
			$(".getInfoAllGroupL").animate({width: "76.1%" }, 1000);
			$(".getInfoAllGroupR").animate({width: "22%"}, 1000);
			$(".MonthDiv").slideUp(1000);
			$(".allGroupsOrginal").slideDown(1000);
		});
		$("#setDayOfWeekP").click(function(){
			$(".CloseAllDivs").slideUp(1000);
			$(".setDayOfWeekDiv").slideDown(1000);
		});
		$(".closeBack").click(function(){
			$(".middle2").animate({width: "76.1%", marginLeft: '12%'}, 1000);
			$(".getInfoAllGroupL").animate({width: "65%"}, 1000);
			$(".getInfoAllGroupR").animate({width: "30%"}, 1000);
			$(".allGroups").slideUp(1000);
			$(".allGroupsOrginal").slideUp(1000);
			$(".MonthDiv").slideUp(1000);
		});
		$(".tdShowAlluserOfGroup").click(function(){
			var groupId = $(this).get(0).id;
			$.ajax({
				url: "queries.php",
				type:"post",
				data:{bool:37, groupId:groupId},
				dataType:"json",
				success: function(data){
					$(".tShowAlluserOfGroup").html("");
					for(var i = 0; i < data.length; i++){
						$(".tShowAlluserOfGroup").append('<tr class="tr2"><td class="td2 td2f td2Color"><p class = "showUserName">'+data[i]+'</p></td></tr>');
					}
					$(".divShowAlluserOfGroup").slideDown();
				}
			});
		});
		$("#closeShowAlluserOfGroup").click(function(){
			$(".divShowAlluserOfGroup").slideUp(1);
		});
		var da = 0;
		$(".setBalForCuratorP").click(function(){
			var curatorId = $(this).get(0).id;
			$.ajax({
				url: "queries.php",
				type:"post",
				data:{bool:283, curatorId:curatorId},
				dataType:"json",
				success: function(data){
					var name = $(".curatorName" + curatorId).text();
					$(".getCuratrorId").get(0).id = curatorId;
					$(".InsPZH").html('Журнал тексеру <i class="fa fa-long-arrow-right" aria-hidden="true"></i> ' + name);
					var td = '';
					$(".trNeedRemove").remove();
					for(var i = 0; i < data.length; i++){
						var row = data[i];
						$(".thAbc2").after('<tr class="tr2 trNeedRemove"><td class="td2 NumberTd td2f'+td+'">'+(i + 1)+'</td><td class="td2 nameGroupTd'+td+'" colspan = "2">'+row["name"]+' Тобы</td><td class="td2 CheckboxTd'+td+' setBalsForCurator"><p class = "status '+row["id"]+ " " +row["curatorId"]+' setBalsToGroupP" id = "setBalsToGroupP'+row["id"]+'">'+row["bal"]+'</p><input type="text" class="write" id = "'+'setBalsToGroupInput'+row["id"] +'" ></td></tr>');
					}
					if(da == 0){
						$(".CloseAllDivs").slideUp(1000);
						$(".setBlaToCuratorDiv").slideDown(1000);
						da = 1;
					}
				}
			});
		});

		$("#setBalToCuratorButton").click(function(){
			var bals = $('.setBalsToGroupP');
			var len = bals.length;
			var m = [];
			var j = 0;
			for(var i = 0; i < len; i++){
				var bal = $("#" + $('.setBalsToGroupP').get(i).id).text();
				if (bal != false) {m[j] = parseInt(bal);j++;}
			}
			if(m.length == len){
				var bals = 0;
				for(var i = 0; i < m.length; i++){bals += m[i];}
				bals = (bals / m.length).toFixed(2);
				console.log(bals);
				$.ajax({
					url: "queries.php",
					type:"post",
					data:{bool:281, bals:bals,curatorId:$(".getCuratrorId").get(0).id},
					dataType:"html",
					success: function(data){
						if(data == 1){
							Timeout();
							$(".span1").text("Успешно сохранено.");
							$(".span1").css("color","#00CD66");
							$(".errors").fadeIn(500);
						}
					}
				});
			} else {
				Timeout();
				$(".span1").text("Барлық бағаны қойыңыз !");
				$(".span1").css("color","#EE6363");
				$(".errors").fadeIn(500);
			}
		});
		$('.contract0').prev().css('borderRightColor', '#E32636');
		var contract = $('.contract0');
		for(var i = 0; i < contract.length; i++){
			var id = contract.get(i).id;
			var Class = contract.get(i).className;
			var m = Class.split(" ");
			var n = parseInt(m[0]);
			$("#" + id).parent().next().children().get(n - 1)
			try {
				var id2 = $("#" + id).parent().next().children().get(n - 1).id;
				$("#" + id2).css('borderTopColor', '#E32636');
			} catch (err) {}
		}

		var text1 = "";
		$(".blockLeft4").delegate(".setBalsForCurator", "mouseenter", function(){
			p = $(this).children().get(0).id;
			input = $(this).children().get(1).id;
			text1 = $("#" + p).text();
			$("#" + input).val(text1);
			$("#" + p).hide();
			$("#" + input).show();

		});
		$(".blockLeft4").delegate(".setBalsForCurator", "mouseleave", function(){
			var m = $(this).children().get(0).className.split(" ");
			var groupId = m[1];
			var curatorId = m[2];
			p = $(this).children().get(0).id;
			input = $(this).children().get(1).id;
			$("#" + p).show();
			$("#" + input).hide();
			var text = $("#" + input).val();
			$("#" + p).text(text);
			if(text != false && text1 != text){
				$.ajax({
					url: "queries.php",
					type:"post",
					data:{bool:282, text:text,groupId:groupId},
					dataType:"html"
				});

				// $.ajax({
				// 	url: "queries.php",
				// 	type:"post",
				// 	data:{bool:281, text:text,curatorId:curatorId,day:day, month:month},
				// 	dataType:"html",
				// 	success: function(data){
				// 		console.log(data);
				// 		if(data == 1){
				// 			Timeout();
				// 			$(".span1").text("Успешно сохранено.");
				// 			$(".span1").css("color","#00CD66");
				// 			$(".errors").fadeIn(500);
				// 		}
				// 	}
				// });
			}
		});
	// Топтарға келетін күнін қою.
		$("#dayOfWeekButton").click(function(){
			var ids = "";
			$('.dayOfWeekCheckbox:checkbox:checked').each(function(){
				ids += $(this).get(0).id + " ";
			});
			var c = $("#dayOfWeek").get(0);
			var day = c.options[c.selectedIndex].value;
			if(ids != false){
				$.ajax({
					url: "queries.php",
					type:"post",
					data:{bool:38,ids:ids, day:day},
					dataType:"html",
					success: function(data){
						Timeout();
						if(data == 1){
							$(".span1").text("Успешно сделано.");
							$(".span1").css("color","#00CD66");
							$(".errors").fadeIn(500);
						}
						 $('.dayOfWeekCheckbox').removeAttr("checked");
					}
				});
			}
		});
	// Оқушыларға мұғалім тағайындау
		$("#saveSubjectsTeacher").click(function(){
			var c = $("#SubjectGroupTeacher").get(0);
			var subject = parseInt(c.options[c.selectedIndex].value);
			var v = $("#groupTeacher").get(0);
			var teacher = parseInt(v.options[v.selectedIndex].value);
			$.ajax({
				url: "queries.php",
				type:"post",
				data:{bool:29, subject:subject,teacher:teacher},
				dataType:"html",
				success: function(data){
					if(data == 1){
						Timeout();
						$(".span1").text("Успешно сохранено.");
						$(".span1").css("color","#00CD66");
						$(".errors").fadeIn(500);
					}
				}
			});
		});
	// Есеп бөліміне

		$(".group").next().children().css("borderTop","none");
			$(".AciveMonthP").click(function(){
				$(".Close").slideUp(1000);
				$(".AciveMonthDiv").slideDown(1000);
			});
			$(".testsPN").click(function(){
				$(".Close").slideUp(1000);
				$(".testsDiv").slideDown(1000);
			});
			// Келесі айды іске қосу
				$("#ActiveMonth").click(function(){
					var c = $(".Months").get(0);
					var monthId = c.options[c.selectedIndex].value;
					if(confirm("Вы действительно хотите активировать месяц " + c.options[c.selectedIndex].text+ " ?")){
						$.ajax({
							url: "queries.php",
							type: "post",
							data: {bool:27, monthId:monthId},
							dataType: "html",
							success: function(data){
								Timeout();
								if(data == 1){
									$(".span1").text("Успешно активировано.");
									$(".span1").css("color","#00CD66");
									$(".errors").fadeIn(500);
								}
							}
						});
					}
				});

				$(".monthP").click(function(){
					var id = $(this).get(0).id;
					$(".MonthDiv").slideUp(1000);
					$("#MonthDiv" + id).show(1000);
				});
			// Оплата жасау
				$("#willPayButton").click(function(){
					var c = $(".MonthsForPay").get(0);
					var month = parseInt(c.options[c.selectedIndex].value);
					var money = parseInt($("#moneyInput").val());
					var userId = $(".getId").get(0).id;
					console.log($("#moneyInput").val());
					if($("#moneyInput").val() != false){
						if(confirm("Вы действительно хотите сделать оплату ?")){
							$.ajax({
								url: "queries.php",
								type:"post",
								data: {bool:31, boll2:1,month:month, userId:userId,money:money},
								dataType: "html",
								success: function(data){
									Timeout();
									if(data == 1){
										$(".span1").text("Платеж успешно зачислен.");
										$(".span1").css("color","#00CD66");
										$(".errors").fadeIn(500);
										$("#moneyInput").val("")
									}
								}
							});
						}
					} else{
						Timeout();
						$(".span1").text("Ақшаны енгізіңіз.");
						$(".span1").css("color","#EE6363");
						$(".errors").fadeIn(500);
					}
				});
			// 30%
				$("#willPayButton30").click(function(){
					var c = $("#Month30").get(0);
					var month = parseInt(c.options[c.selectedIndex].value);
					var money = parseInt($("#moneyInput30").val());
					var userId = $(".getId30").get(0).id;
					if($("#moneyInput30").val() != false){
						if(confirm("Вы действительно хотите сделать оплату ?")){
							$.ajax({
								url: "queries.php",
								type:"post",
								data: {bool:31, boll2:2,month:month, userId:userId,money:money},
								dataType: "html",
								success: function(data){
									Timeout();
									if(data == 1){
										$(".span1").text("Платеж успешно зачислен.");
										$(".span1").css("color","#00CD66");
										$(".errors").fadeIn(500);
										$("#moneyInput30").val("")
									}
								}
							});
						}
					} else{
						Timeout();
						$(".span1").text("Ақшаны енгізіңіз.");
						$(".span1").css("color","#EE6363");
						$(".errors").fadeIn(500);
					}
				});
		//  Доп доход
		$("#extragainButton").click(function(){
				var money = $("#extragainInput").val();
				var text = $("#extragainText").val();
				if(money != false){
					if(text != false){
						$.ajax({
							url: "queries.php",
							type: "post",
							data: {bool:34, bool2:1, money:money, text:text},
							dataType: "html",
							success: function(data){
								console.log(data);
								Timeout();
								if(data == 1){
									$(".span1").text("Успешно сделано.");
									$(".span1").css("color","#00CD66");
									$(".errors").fadeIn(500);
									$("#extragainInput").val("");
									$("#extragainText").val("");
								}
							}
						});
					} else {
						Timeout();
						$(".span1").text("Себебін енгізіңіз.");
						$(".span1").css("color","#EE6363");
						$(".errors").fadeIn(500);
					}
				} else {
					Timeout();
					$(".span1").text("Ақшаны енгізіңіз.");
					$(".span1").css("color","#EE6363");
					$(".errors").fadeIn(500);
				}
			});
		// расход
			$("#consumptionButton").click(function(){
				var money = $("#consumptionInput").val();
				var text = $("#consumptionText").val();
				if(money != false){
					if(text != false){
						$.ajax({
							url: "queries.php",
							type: "post",
							data: {bool:34, bool2:2, money:money, text:text},
							dataType: "html",
							success: function(data){
								console.log(data);
								Timeout();
								if(data == 1){
									$(".span1").text("Успешно сделано.");
									$(".span1").css("color","#00CD66");
									$(".errors").fadeIn(500);
									$("#consumptionInput").val("");
									$("#consumptionText").val("");
								}
							}
						});
					} else {
						Timeout();
						$(".span1").text("Себебін енгізіңіз.");
						$(".span1").css("color","#EE6363");
						$(".errors").fadeIn(500);
					}
				} else {
					Timeout();
					$(".span1").text("Ақшаны енгізіңіз.");
					$(".span1").css("color","#EE6363");
					$(".errors").fadeIn(500);
				}
			});
	// Келесі айды іске қосу Білім бөлімі
		$("#ActiveMonthBilim").click(function(){
			var c = $(".MonthsBilim").get(0);
			var monthId = c.options[c.selectedIndex].value;
			console.log(monthId);
			$.ajax({
				url: "queries.php",
				type: "post",
				data: {bool:271, monthId:monthId},
				dataType: "html",
				success: function(data){
					Timeout();
					if(data == 1){
						$(".span1").text("Успешно активировано.");
						$(".span1").css("color","#00CD66");
						$(".errors").fadeIn(500);
					}
				}
			});
		});
		$(".extraGainP").click(function(){
				$(".Close").slideUp(1000);
				$(".extraGainDiv").slideDown(1000);
			});
			$(".consumptionP").click(function(){
				$(".Close").slideUp(1000);
				$(".consumptionDiv").slideDown(1000);
			});
			$(".getInfoAboutUserP3").click(function(){
				$(".Close").slideUp(1000);
				$(".getInfoAboutUserDiv3").slideDown(1000);
			});
			$(".SearchAllMoneyP").click(function(){
				$(".Close").slideUp(1000);
				$(".SearchAllMoneyDiv").slideDown(1000);
			});
			$(".todays_groups_p").click(function(){
				$(".Close").slideUp(1000);
				$(".todays_groups_div").slideDown(1000);
			});

			// Оқушының аты
			$(".discount").click(function(){
				var id = $(this).get(0).id;
				
				$(".setMoneyGetId").get(0).id = id;
				// console.log($(".setMoneyGetId").get(0).id);
				$.ajax({
					url: "queries.php",
					type: "post", 
					data: {bool:25, ids:id + " "},
					dataType: "json",
					success: function(data){
						// console.log(data);
						if(data != false){
							$(".setMoneyTable").html('<tr class="tr"><th class="th2 th2f Number">№</th><th class="th2 nameMF NameAndSurname">Аты-жөні</th></tr>');
							var td = "";
							for(var i = 0; i < data.length; i++){
								if (i + 1 == data.length) td = "td2l";
								$(".setMoneyTable").append('<tr class="tr2"><td class="td2 td2f tdn '+td+'">'+(i + 1)+'</td><td class="td2 '+td+'"><p class = "userName2">'+data[i]+'</p></td></tr>');
							}
						}
					}
				});
				$(".setMoneyInput").focus();

				// $(".Close").slideUp(1000);
				$(".setMoneyDiv").slideDown(1000);
			});
			// Оқушы төлеу керек ақшаны қою
			$("#setMoneyButton").click(function(){
				var money = $("#setMoneyInput").val();
				var pay = $("#setMoneyInput2").val();
				var userId = $(".setMoneyGetId").get(0).id ;
				console.log(userId, money);
				$.ajax({
					url: "queries.php",
					type: "post", 
					data: {bool:35, userId:userId, money:money, pay:pay},
					dataType: "html",
					success: function(data){
						console.log(data);
						if(data == 1){
							// Timeout();
							$(".span1").text("Успешно сделано.");
							$(".span1").css("color","#00CD66");
							$(".errors").fadeIn(500);
						}
						
					}
				});
			});
			// Скидка жасау
			$("#setDiscountButton").click(function(){
				var money = $("#setDiscountInput").val();
				var userId = $(".setDiscountGetId").get(0).id ;
				console.log(userId, money);
				if($("#setDiscountInput").val() != false){
					if(confirm("Вы действительно хотите сделать скидку ?")){
						$.ajax({
							url: "queries.php",
							type: "post", 
							data: {bool:35, userId:userId, money:money},
							dataType: "html",
							success: function(data){
								console.log(data);
								if(data == 1){
									Timeout();
									$(".span1").text("Успешно сделано.");
									$(".span1").css("color","#00CD66");
									$(".errors").fadeIn(500);
								}
								
							}
						});
					}
				} else{
					Timeout();
					$(".span1").text("Ақшаны енгізіңіз.");
					$(".span1").css("color","#EE6363");
					$(".errors").fadeIn(500);
				}
			});
	// Айлар тізімі поиск
	$(".search6I").on("click", function() {
		var text = $(this).prev().val();
		$.ajax({
			url: "queries.php",
			type:"post",
			data: {bool:32, text:text},
			dataType: "html",
			success: function(data){
				$(".number12").parent().parent().children().css("background", "#fff");
				$(".number12").parent().parent().children().children("p").css("color", "#444");

				var c = parseInt($(".number2" + data).get(0).id);
				$("body, html").animate({scrollTop:20000},200);
				$(".MonthDivInner").animate({scrollTop:55 + 21*(c - 1)},200);
				var color = $(".number" + c).parent().parent().children().css("backgroundColor");
				if(color == "rgb(255, 255, 255)"){
					$(".number" + c).parent().parent().children().css("background", "#6A5ACD");
					$(".number" + c).parent().parent().children().children("p").css("color", "#fff");
				} else {
					$(".number" + c).parent().parent().children().css("background", "#fff");
					$(".number" + c).parent().parent().children().children("p").css("color", "#444");
				}
			}
		});
	});
	// Төлемдер жайлы мәлімет алу
	$("#buttonSearchExtra").on("click", function() {
		var c = $("#monthsSearchExtra").get(0);
		var month = parseInt(c.options[c.selectedIndex].value);
		var nameMonth = c.options[c.selectedIndex].text;
		var c = $("#daySearchExtra").get(0);
		var day = parseInt(c.options[c.selectedIndex].value);
		var nameDay = day;
		$.ajax({
			url: "queries.php",
			type:"post",
			data: {bool:36, month:month, day:day, index:0},
			dataType: "json",
			success: function(data){
				console.log(data);
				$(".searchMoneyName").html(nameMonth + " айы - " + nameDay);
				$(".searchMoney").html('<tr class="tr2"><th class="th2 th2f">№</th><th class="th2 tdSumma">негізгі сумма</th><th class="th2 thCouse">Кіріс</th><th class="th2 thCouse">Шығын</th><th class="th2 tdSumma">Қалғаны</th></tr>');
				var plus = data[0].split(";");
				var minus = data[1].split(";");
				td = "";
				var sPlus = "";
				var sMinus = "";
				var mPlus = 0;
				var mMinus = 0;
				var s1 = "";
				var s2 = "";
				if(data[0] != false){
					for(var i = 0; i < plus.length; i++){
						money = plus[i].split("|");
						mPlus += parseInt(money[0]);
						if(i != 0) s1 = "<br>";
						sPlus += s1 +'<p class = "NameTeacher">' + money[0] + " тг - " + money[1] + '</p>';
					}
				}
				if(data[1] != false){
					for(var i = 0; i < minus.length; i++){
						money = minus[i].split("|");
						mMinus += parseInt(money[0]);
						if(i != 0) s2 = "<br>";
						sMinus += s2 + '<p class = "NameTeacher">' + money[0] + " тг - " + money[1] + '</p>';
					}
				}
				if(data[3] != false){
					var money30 = data[3];
					for(var i = 0; i < money30.length; i++){
						var m = money30[i].split("(");
						var date = m[1].split(":");
						if(month == parseInt(date[0]) && day == parseInt(date[1]))data[2] += parseInt(date[2]);
					}
				}
				td = 'td2l';
				$(".searchMoney").append('<tr class="tr2"><td class="td2 td2f '+td+'">1</td><td class="td2 '+td+'"><p class = "NameTeacher">'+data[2]+' тг</p></td><td class="td2 '+td+'">'+sPlus+'</td><td class="td2 '+td+'">'+sMinus+'</td><td class="td2 '+td+'"><p>'+(data[2] + mPlus - mMinus)+' тг</p></td></tr>');
				$(".searchResult").slideDown(1000);
			}
		});
	});
	//  Пороль өзгерту 
			$(".changePasswordP").click(function(){
				$(".changePasswordDiv").slideDown(500);
			});
			$("#changePassword").click(function(){
				$(".info2").fadeOut(500)
				$(".info1").fadeOut(500)
				var oldPass = $("#oldPass").val();
				var newPass = $("#newPass").val();
				var repeatPass = $("#repeatPass").val();
				console.log(oldPass, newPass, repeatPass);
				if(newPass != repeatPass) {$(".info2").text("Пароли не совпадают. Пожалуйста проверьте");$(".info2").fadeIn(500);}
				else{
					$.ajax({
						url: "queries.php",
						type: "post",
						data : {bool:40, oldPass:oldPass, newPass:newPass},
						dataType:"html",
						success:function(data){
							Timeout();
							if(data == 1) {$(".info1").text("Не провельный пороль");$(".info1").fadeIn(500);}
							else{
								$(".span1").text("Пороль успешно изменен !!!");
								$(".span1").css("color","#00CD66");
								$(".errors").fadeIn(500);
								$(".changePasswordDiv").slideUp(500);
							}
						}
					});
				}
			});
});

					

