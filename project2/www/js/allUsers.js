$(document).ready(function(){
	$(".au").click(function(){
		var userId = $(this).get(0).id;
		$.ajax({
			url:"../page/main.php",
			type:"post",
			data:({user:2, userId:userId}),
			dataType:"html",
			success:function(data){
				document.location.replace("profile.php");
			}
		});
	});

	$(".awm").click(function(){
		var toUserId = $(this).get(0).id;
		$.ajax({
			url:"../page/allUsers.php",
			type:"post",
			data:({toUserId:toUserId}),
			dataType:"html",
			success:function(data){
				document.location.replace("../page/dialog.php");
			}
		});
	});
	
});