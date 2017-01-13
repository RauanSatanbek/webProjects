$(document).ready(function(){
	$("#searchUsers").delegate(".writeMassageToUser", "click", function(){console.log(45);
		var userToId = $(this).attr("class").substr(19);
		$.ajax({
			url:"../page/allUsers.php",
			type:"POST",
			data:({userToId:userToId}),
			dataType:"html",
			success:function(data){
				document.location.replace('message.php');
			}
		});;
	});


	// Profile the other users
		$("#searchUsers").delegate(".showUser","click", function(){
			var userId = $(this).get(0).id;
			// console.log(userId);
			$.ajax({
					url:"../page/allUsers.php",
					type:"POST",
					data:({userId:userId}),
					dataType:"html",
					success:function(data){
						document.location.replace('profile.php')
					}
				});;
		});	
});