var c = 5;
var next = "";
$(document).ready(function(){


// add comment in dataBase
	function addComment(text){
		if(text != false){
			$.ajax({
				url:"../page/addOrGetComment.php",
				type:"post",
				data:({bool:"1",text:text})
				// dataType:"html",
				// success:function(data){
				// 	console.log(data);
				// }
			});
			$(".commentTextarea").val("");
		}
		loadComment();
	}
// load comment from dataBase
// number comments in one time
	
	function loadComment(){
		$.ajax({
				url:"../page/addOrGetComment.php",
				type:"post",
				data:({bool:"2"}),
				dataType:"json",
				success:function(data){
					// console.log(data);
					$(".commentBody").html("");
					var count = data.length;
					$(".commenthead").html("<p>" + count + " ответов</p>");
					if(c >= count) { next = ""}
						else {next = "<center><p id = 'commentNext'>к предыдущим записям &#8595;</p></center>";}
				
					for(var i = 0; i < count; i++){
						if(i < c){
							var hr = "";
							// if (i + 1 < c && count >= c)  hr = "<hr>";
							// else if (i + 1 < count)  hr = "<hr>";
							var user = data[i][0];
							var comment = data[i][1];
							var time = data[i][2];		
							var avatar = data[i][3];
							// console.log(user);
							$(".commentBody").append('<div class = "inBody"><div class = "commentBodyLeft"><div id = "writerPhoto"><img src = "../img/avatars/'+avatar+'" width = "110" height="auto" alt="" id = "userPhoto"></div></div><div class = "commentBodyRight"><div class = "writerInfo"><p id = "userName"><b>'+user+'</b></p><div class = "meddleInfo"><span class = "commentText">'+comment+'</span><span class = "commentTextTest" >'+comment+'</span><p id = "showAllComment">Показать полностью...</p></div><div class = "footInfo"><p id = "time1">'+time+'</p><p id = "like">Мне нравится 1</p></div></div></div></div>' + hr);
						}
					}
					$(".commentBody").append(next);
				}
			});
		}
	$(".commentBody").delegate("#commentNext", "click", function(){
	// $("#commentNext").click(function(){
		c+=5;
		loadComment();
		console.log(123);
	});

	// $(".bodyD").delegate("#commentButton", "click", function(){
	$("#commentButton").click(function(){
		var text = $(this).prev().val();
		addComment(text);
		$(".commentTextarea").val("");
		// console.log(text);
		
	});
// every 2s load comment because when user add new comment we it load
loadComment();
setInterval(loadComment, 5000);
});