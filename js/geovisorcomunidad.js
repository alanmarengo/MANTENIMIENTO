$(document).ready(function() {
	
	$("[title]").tooltipster({
		animation: 'fade',
		delay: 200,
		theme: 'tooltipster-default',
		trigger: 'hover'
	});
	
	scroll = new Jump.scroll();
			
	geomap = new ol_map();	
	geomap.map.create();
	
	scroll.refresh();
	
	$(".btn-com").each(function(i,v) {
				
		$(v).on("click",function() {
			
			$(".btn-com").removeClass("active");
			$(v).addClass("active");
			
		});
		
	});
	
	if (B!="") { document.getElementById("btn-com-"+B).click(); }else{ document.getElementById("btn-com-1").click(); }
	
});