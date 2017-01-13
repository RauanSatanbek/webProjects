$(document).ready(function(){
	$("#Profile").click(function(){
		console.log(451);
		$.ajax({
			url:"main.php",
			type:"post",
			data:({user:1}),
			dataType:"html",
			success:function(data){
				document.location.replace("profile.php");
			}
		});
	});



	var edit = 0;
	
	$("#edit").click(function(){
		console.log(edit);
		if(edit%2 == 0){
			$(".editForm").slideDown(1000);
		} else {
			$(".editForm").slideUp(1000);
		}
		edit++;
	});

	$("#save").click(function(){
		var name = $("#editName").val();
		var surname = $("#editSurname").val();
		$.ajax({
			url:"edit.php",
			type:"post",
			data:({bool:1,name:name,surname:surname}),
			dataType:"html",
			success:function(data){
				document.location.replace("profile.php");
			}
		});
	}); 


	$(".labelFile").click(function(){
		$("#error").text("");
		function def(){
			console.log("1");
			var val = $("#inputFile").val();
			if(val != false){
				$("#sendAvatar").slideDown(200);
				clearTimeout(timer);
			}
		}
		var timer = setInterval(def,1000);
	});
});