$(document).ready(function(){
	$(".modal-show-close").click(function(){
		$('.modal-show').fadeOut(200);
	});

	$(".p").click(function(){
		var tag = $(this).children();
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

	$(".chat-dialog").click(function(){
		
	});
});