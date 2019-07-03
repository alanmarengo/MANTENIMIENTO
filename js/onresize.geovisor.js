function onresize() {
	
	var docWidth = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
				
	if (docWidth < 1230) {
		
		$("#navbar-main .col-nav").appendTo("#navbar-main .responsive-row");
		$("#navbar-main .col-nav").removeClass("col-md-3");
		$("#navbar-main .col-nav").removeClass("col-lg-3");
		$("#navbar-main .col-nav").addClass("col-md-12");
		$("#navbar-main .col-nav").addClass("col-lg-12");
		$("#navbar-main .col-brand").removeClass("col-md-3");
		$("#navbar-main .col-brand").removeClass("col-lg-3");
		$("#navbar-main .col-brand").addClass("col-md-12");
		$("#navbar-main .col-brand").addClass("col-lg-12");
		
		$("#nav-popup-filter").append($("#geovisor-popup-search"));
		$("#nav-popup-filter").append($("#popup-basic-filters"));
		$("#nav-popup-layers").append($("#dynbox-popup-layers"));
		$("#nav-popup-content").append($("#popup-preview-inner"));
		$("#frm-adv-search").find(".col").each(function(i,v) {
			$(v).attr("class","col col-xs-12 col-sm-12 col-md-12 col-lg-12");
		});
		
	}else{
		
		$("#navbar-main .col-nav").appendTo("#navbar-main .default-row");
		$("#navbar-main .col-nav").removeClass("col-md-12");
		$("#navbar-main .col-nav").removeClass("col-lg-12");
		$("#navbar-main .col-nav").addClass("col-md-3");
		$("#navbar-main .col-nav").addClass("col-lg-3");
		$("#navbar-main .col-brand").removeClass("col-md-12");
		$("#navbar-main .col-brand").removeClass("col-lg-12");
		$("#navbar-main .col-brand").addClass("col-md-3");
		$("#navbar-main .col-brand").addClass("col-lg-3");
		
		$("#popup-body").before($("#geovisor-popup-search"));
		$("#dynbox-popup-basic-search").append($("#popup-basic-filters"));
		$("#dynbox-popup-basic-search").append($("#dynbox-popup-layers"));
		$("#dynbox-popup-content").append($("#popup-preview-inner"));
		$("#frm-adv-search").find(".col").each(function(i,v) {
			var defClass = $(v).attr("data-class");
			$(v).attr("class",defClass);
		});
		
	}
	
	if (docWidth < 780) {
		
		$("#navbar-tools .col-tools").appendTo("#navbar-tools .responsive-row");
		$("#navbar-tools .col-tools").removeClass("col-md-3");
		$("#navbar-tools .col-tools").removeClass("col-lg-3");
		$("#navbar-tools .col-tools").addClass("col-md-12");
		$("#navbar-tools .col-tools").addClass("col-lg-12");
		$("#navbar-tools .col-title").removeClass("col-md-3");
		$("#navbar-tools .col-title").removeClass("col-lg-3");
		$("#navbar-tools .col-title").addClass("col-md-12");
		$("#navbar-tools .col-title").addClass("col-lg-12");
		
	}else{
		
		$("#navbar-tools .col-tools").appendTo("#navbar-tools .default-row");
		$("#navbar-tools .col-tools").removeClass("col-md-12");
		$("#navbar-tools .col-tools").removeClass("col-lg-12");
		$("#navbar-tools .col-tools").addClass("col-md-3");
		$("#navbar-tools .col-tools").addClass("col-lg-3");
		$("#navbar-tools .col-title").removeClass("col-md-12");
		$("#navbar-tools .col-title").removeClass("col-lg-12");
		$("#navbar-tools .col-title").addClass("col-md-3");
		$("#navbar-tools .col-title").addClass("col-lg-3");
		
	}
	
	geomap.map.ol_object.updateSize();
	geomap.map.ol_object.render();
	
	flotant.fit();
	flotant.fitPosition();
	flotant.fitTopElement("#navbar-tools","#navbar-main");
	flotant.fitTopElement(".page-container",".jump-navbar");
	
	scroll.refresh();
	
}