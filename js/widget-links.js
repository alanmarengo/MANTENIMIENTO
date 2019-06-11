window.addEventListener("load",function() {
	
	$(".widget-link").hover(
		$(this).animate({
			width:"40px"
		},700),
		$(this).animate({			
			width:"20px"
		},700)
	);
	
}); 