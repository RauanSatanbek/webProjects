<script>
	$(document).ready(function(){
		var id = "me",
			left = 18,
			down = 14,
			m = [],
			speed = 1,
			jump = 200,
			time = 2000;
		$(window).on("keydown",function(){
			var keyDown = event.keyCode;
			if(!m.includes(keyDown))
				m.push(keyDown);
			if(m.includes(102))
				left+=speed;
			if(m.includes(101))
				down+=speed;
			if(m.includes(104))
				down-=speed;
			if(m.includes(100))
				left-=speed;
			console.log(down + "px "+(left + "px"));
			$("#" + id).css('backgroundPosition', left + "px "+(down + "px"));
			
			$(window).bind("keyup",function(){
				var keyUp = event.keyCode;
				if(m.includes(keyUp)){
					var index = m.indexOf(keyUp);
					delete m[index];
				}
			});
		});
	});
</script>