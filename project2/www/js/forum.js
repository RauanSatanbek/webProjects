$(document).ready(function(){
	function addLikeAndShow(messageId){
			$.ajax({
				url:"../page/like.php",
				type:"POST",
				dataType:"html",
				data:{messageId:messageId},
				
				success:function(data){
					// console.log(data);
					$("#like" + messageId).text("Мне нравится " + data);
				}
			});
		}
		
	// лайк басылганда
	$(".like").on('click', function(){
		var id = $(this).get(0).id;
		var messageId = Number(id.substr(4));
		addLikeAndShow(messageId);
	});

	// Show img
		$("div").delegate(".showImg",'click', function(){
			console.log(789);
			var src = $(this).attr("src");
			$("#showImg").children().attr("src",src);
		// $("#showImg").text("45613dsa");
		$("#showImg").slideDown(500);
	});
	$("#showImg").click(function(){
		$(this).slideUp(500);
		console.log(123);
	});
});