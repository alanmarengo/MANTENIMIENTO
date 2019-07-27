function ol_stats() {

	this.panel = {};
	this.panel.div = document.getElementById("nav-panel");
	
	this.view = {};
	
	this.panel.start = function() {
		
		$(".panel-abr").on("click",function() {
			
			if (this.getAttribute("data-active") == 0) {
					
				$(".panel-abr").attr("data-active","0");
				$(".panel-abr").css("border-color","transparent");
				$(".panel-abr").css("background-color","transparent");
					
				$(this).attr("data-active","1");
				$(this).css("border-color",this.getAttribute("data-color"));
				$(this).css("background-color",this.getAttribute("data-bgcolor"));
					
				$(".layer-container").not(".layer-container[data-cid="+this.getAttribute("data-cid")+"]").hide();
				$(".layer-container[data-cid="+this.getAttribute("data-cid")+"]").show();
				//$("#abr-container").first(".panel-abr").prepend(this);			
				scroll.refresh();
					
			}
			
		});
	
	}
	
	this.view.start = function() {		
		
		$("#update-view").on("click",function() {
			
			$(this).attr("disabled","disabled");
			
		});
		
	}
	
	this.view.getTable = function() {
		
		var req = $.ajax({
			
			async:false,
			data:{page:2},
			type:"POST",
			url:"./php/get-stats-table.php",
			success:function(d){}
			
		});
		
		$("#dataset-wrapper").html(req.responseText);
		
	}
		
}