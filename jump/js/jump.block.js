Jump.block = function() {
	
	this.refresh = function() {
		
		$(".jump-block-inner").each(function(i,v) {
			
			var innerElementHeight = $(v).height();			
			var blockHeight = $(v).closest(".jump-navbar").height();
			
			var margin = ((blockHeight - innerElementHeight) / 2);
			
			$(v).css({"margin":margin});
			
		});
		
		$(".jump-block-inner-toolbar").each(function(i,v) {
			
			var innerElementHeight = $(v).height();			
			var blockHeight = $(v).closest(".jump-navbar").height();			
			
			var margin = ((blockHeight - innerElementHeight) / 2);
			
			$(v).css({"margin":margin});
			
			$(v).find(".button").css({ "width":innerElementHeight+"px","height":innerElementHeight+"px","line-height":innerElementHeight+"px" });
			$(v).find(".button").parent().css({ "width":innerElementHeight+"px","height":innerElementHeight+"px","line-height":innerElementHeight+"px" });
			$(v).find(".input").css({ "height":innerElementHeight,"line-height":innerElementHeight});
		
		});
		
	}
	
}