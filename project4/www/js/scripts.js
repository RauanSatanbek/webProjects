$(document).ready(function(){
	window.onscroll = function() {
	  var scrolled = window.pageYOffset;
	  console.log(scrolled);
	}
	$('.up').click(function(){
		$("body, html").animate({scrollTop:0}, 1000);
	});
	$("#AboutUs").click(function(){
		$("html, body").animate({scrollTop:302},500);
		$(".navP").css('textDecoration', 'none');
		$(this).css('textDecoration', 'underline');
	});

	$("#Recalls").click(function(){
		$("html, body").animate({scrollTop:1054},500);
		$(".navP").css('textDecoration', 'none');
		$(this).css('textDecoration', 'underline');
	});

	$("#Contacts").click(function(){
		$("html, body").animate({scrollTop:1467},500);
		$(".navP").css('textDecoration', 'none');
		$(this).css('textDecoration', 'underline');
	});

	var c = 1;
	$(".AboutUs").click(function(){
		if (c % 2 == 0) {
			$("#aboutUs").html('О компании <i class="fa fa-circle faBlue faBlue1" aria-hidden="true"></i>');
			$("#workStyle").html('Наши услуги <i class="fa fa-circle-o faBlue" aria-hidden="true">');
			$(".AboutUsDiv").slideDown(1000);
			$(".workStyleDiv").slideUp(1000);
			c++;
		}

		else {
			$("#workStyle").html('Наши услуги <i class="fa fa-circle faBlue" aria-hidden="true"></i>');
			$("#aboutUs").html('О компании <i class="fa fa-circle-o faBlue faBlue1" aria-hidden="true">');
			$(".AboutUsDiv").slideUp(1000);
			$(".workStyleDiv").slideDown(1000);
			c++;
		}
	});
	$(".openAllRecalls").click(function(){
		$(".hideRecalls").slideToggle(1000);
	});
});