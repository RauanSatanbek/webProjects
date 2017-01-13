$(document).ready(function(){ 
    $(".si_front").on("mouseenter",function(){
  	// ------------
		$(".si_front").css("zIndex", 5);
		$(".si_back").css("zIndex", -5);
		$(".si_front").css("transform", "180deg");
		$(".si_back").css("transform", "0deg");

  	// --------
  	var next = $(this).next().get(0);
      setTimeout(function(){
        $(this).css("zIndex", -5);
        $(next).css("zIndex", 5);
      },100);
      $(next).transition({
        rotateY: '0deg'
      });
      $(this).transition({
        rotateY: '180deg'
      });
  });
  $(".si_back").on("mouseleave",function(){
		$(".si_front").css("zIndex", 5);
		$(".si_back").css("zIndex", -5);
		$(".si_front").css("transform", "180deg");
		$(".si_back").css("transform", "0deg");
  	var prev = $(this).prev().get(0);
      setTimeout(function(){
        $(prev).css("zIndex", 5);
        $(this).css("zIndex", -5);
      },100);

      $(this).transition({
        rotateY: '180deg'
      });
      $(prev).transition({
        rotateY: '0deg'
      });
  });
});