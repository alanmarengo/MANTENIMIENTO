function jalert(title,msg,bs_class) {	
	
	$(".jump-alert-container .jump-alert-header").html(title);
	$(".jump-alert-container .jump-alert-body").html(msg);
	$(".jump-alert-container").attr("class","jump-alert-container jump-alert-"+bs_class);
	
	$(".jump-alert-modal").show();
	$(".jump-alert-container").css("display","flex");	
	
}

function jalert_close() {
	
	$(".jump-alert-modal").hide();
	$(".jump-alert-container").hide();
	
}