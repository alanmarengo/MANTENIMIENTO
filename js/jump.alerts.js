function jalert(msg,bs_class) {	
	
	$(".jump-alert-container .jump-alert-body").html(msg);
	$(".jump-alert-container").attr("class","jump-alert jump-alert-"+bs_class);
	
	$(".jump-alert-modal").show();
	$(".jump-alert-container").show();	
	
}

function jalert_close() {
	
	$(".jump-alert-modal").hide();
	$(".jump-alert-container").hide();
	
}