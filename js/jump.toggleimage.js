Jump.toggleimage = function() {
	
	this.refresh = function() {		
		
		$(".jump-toggleimage").each(function(i,v) {
			
			$(v).bind("click",function() {
				
				var state = $(v).attr("data-state");
				var ini = $(v).attr("data-ini-src");
				var end = $(v).attr("data-end-src");
				var clean = $(v).attr("data-clean");
				
				if (clean == 1) {
					
					$(v).parent().children(".jump-toggleimage").each(function(j,x) {
						
						$(x).find("img").attr("src",ini);
						$(x).attr("data-state","0");
						
					});
					
				}
				alert(clean);
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