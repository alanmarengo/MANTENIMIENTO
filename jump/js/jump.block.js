Jump.block = function() {
	
	this.refresh = function() {
		
		$(".jump-block-inner").each(function(i,v) {
			
			var innerElementHeight = $(v).height();			
			var blockHeight = $(v).closest(".jump-navbar").height();
			
			var margin = ((blockHeight - innerElementHeight) / 2);
			
			$(v).css({"margin":margin});
			
			console.log("((" + blockHeight + " - " + innerElementHeight + ") / 2))");
			console.log(margin);
			
		});
		
		$(".jump-block-inner-toolbar").each(function(i,v) {
			
			var innerElementHeight = $(v).attr("data-height");			
			var blockHeight = $(v).closest(".jump-navbar").height();			
			
			var margin = ((blockHeight - innerElementHeight) / 2);
			
			$(v).css({"margin":margin,"height":innerElementHeight+"px"});
			
		});
		
	}
	
}