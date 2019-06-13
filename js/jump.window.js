Jump.window = function() {
	
	this.initialize = function() {
		
		$(".jump-window-inner").each(function(i,v) {
			
			var height = (Jump.Document.linksHeight/2);
			
			$(v).children(".jump-window-header").css({
				"height":height+"px",
				"line-height":height+"px"
			});
			
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
	
}