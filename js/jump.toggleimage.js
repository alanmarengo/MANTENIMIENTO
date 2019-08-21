Jump.toggleimage = function() {
	
	this.refresh = function() {		
		
		$(".jump-toggleimage").each(function(i,v) {
			
			$(v).bind("click",function() {
				alert("tgim");
				var state = $(v).attr("data-state");
				var ini = $(v).attr("data-ini-src");
				var end = $(v).attr("data-end-src");
				var clean = $(v).attr("data-clean");
				
				if (clean == 1) {
					
					$(v).parent().children(".jump-toggleimage").each(function(j,x) {
						
						$(v).find("img").attr("src",ini);
						$(v).attr("data-state","0");
						
					});
					
				}
				
				if (state==0) {
					
					$(v).find("img").attr("src",end);
					$(v).attr("data-state","1");
					
				}else{
					
					$(v).find("img").attr("src",ini);
					$(v).attr("data-state","0");
					
				}
				
			});
			
		});
		
	}
	
}