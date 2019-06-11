window.addEventListener("load",function() {
	
	$(".widget-link").hover(
		function() {
			$(this).animate({
				width:"40px"
			}
		},700),		
		function() {
			$(this).animate({
				width:"20px"
			}
		},700)
	);
	
}); 