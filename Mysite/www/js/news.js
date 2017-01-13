var height = 0;

$(document).ready(function(){
	$("#textareaNews").on("keyup", function(){
		var text = $(this).val();
		// console.log(text);
		$("#divNews").text("");
		$("#divNews").text("" + text);
		height = Number($("#divNews").css("height").substr(0, $("#divNews").css("height").length - 2));
		$("#textareaNews").css("height", (height + 80) + "px");
		console.log(height);
	});

	// $("#writeNewsButton").on("click", function(){
	// 	console.log(445);
	// 	// document.location.replace("news.php");

	// });

});