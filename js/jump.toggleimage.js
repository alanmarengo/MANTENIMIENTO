Jump.toggleimage = function() {
	
	this.refresh = function() {		
		
		$(".jump-toggleimage").each(function(i,v) {
			
			$(v).on("click",function() {
					
				var state = $(v).attr("data-state");
				var ini = $(v).attr("data-ini-src");
				var end = $(v).attr("data-end-src");
				
				if (state==0) {
					
					$(v).children("img").attr("src",end);
					$(v).attr("data-state","1");
					
				}else{
					
					$(v).children("img").attr("src",ini);
					$(v).attr("data-state","0");
					
				}
				
			});
			
		});
		
	}
	
}