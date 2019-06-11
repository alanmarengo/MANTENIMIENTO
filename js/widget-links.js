window.addEventListener("load",function() {
	
	$(".widget-link").hover(
		function() {			
			$(this).addClass("widget-link-hovered");
			$(this).removeClass("widget-link-unhovered");
		},		
		function() {			
			$(this).addClass("widget-link-unhovered");
			$(this).removeClass("widget-link-hovered");
		})
	
}); 