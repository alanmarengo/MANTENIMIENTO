Jump.scroll = function() {
	
	this.refresh = function() {
		
		$(".jump-scroll").each(function(i,v) {
			
			new PerfectScrollbar(v);
			
		});
		
	}
	
	this.refreshElementCollection = function(e) {
		
		$(e).each(function(i,v) {
			
			new PerfectScrollbar(v);
			
		});
		
	}
	
}