Jump.window = function() {
	
	this.initialize = function() {
		
		$(".jump-window-full-body").each(function(i,v) {
			
			var headerHeight = $(v).prev(".jump-window-header").height();
			var windowHeight = $(v).closest(".jump-window").height();
			var paddingTop = window.getComputedStyle(v.parentNode, null).getPropertyValue('padding-top').split("px")[0];
			var bodyHeight = ((windowHeight - headerHeight) - (paddingTop*2));
			
			$(v).css({"height":bodyHeight+"px"});
			
		});
		
		$(".jump-window-full-body").each(function(i,v) {
			
			var hasGroups = $(v).find(".jump-window-group").length;
			var groupsHeight = $(v).find(".jump-window-group").first().find(".jump-window-group-header").first().height();
			var bodyHeight = $(v).height();
			
			if (hasGroups) {
				
				var groupHeight = ((bodyHeight - (groupsHeight * hasGroups)) / hasGroups);
				
				$(v).find(".jump-window-group").find(".jump-window-group-body").css({"height":groupHeight+"px"});
				
			}
			
		});
		
	}
	
	this.setAllWindowsDraggable = function() {
		
		$(".jump-window").each(function(i,v) {
			
			var header = $(v).find(".jump-window-header");
			
			$(v).draggable({handle:header});
			
			$(v).find(".jump-window-close").on("click",function() {
				
				$(this).closest(".jump-window").hide();
				$(this).closest(".jump-window-mode").hide();
				
			});
			
		});
		
	}
	
	this.open = function(e) {
		
		$(e).show();
		
	}
	
	this.close = function(e) {
		
		$(e).hide();
		
	}
	
}