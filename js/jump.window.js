Jump.window = function() {
	
	this.initialize = function() {
		
		$(".jump-window-full-body").each(function(i,v) {
			
			var headerHeight = $(v).prev(".jump-window-header").height();
			var windowHeight = $(v).closest(".jump-window").height();
			var paddingTop = window.getComputedStyle(v, null).getPropertyValue('padding-top').split("px")[0];
			
			var bodyHeight = ((windowHeight - headerHeight) - (paddingTop*2));
			
			$(v).css({"height":bodyHeight+"px"});
			
		});
		
	}
	
	this.setAllWindowsDraggable = function() {
		
		$(".jump-window").each(function(i,v) {
			
			var header = $(v).find(".jump-window-header");
			
			$(v).draggable({handle:header});
			
			$(v).find(".jump-window-close").on("click",function() {
				
				$(this).closest(".jump-window").hide();
				
			});
			
		});
		
	}
	
	this.open = function(e) {
		
		$(e).show();
		
	}
	
}