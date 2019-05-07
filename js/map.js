function ol_map() {

	this.container = {};
	this.panel = {};
	this.map = {};
	this.popup = {};
	this.map.baselayers = {};
	
	this.container.div = document.getElementById("map");

	this.container.fixSize = function(otherElements) {
		
		var otherElementsTotalHeight = 0;
		var windowTotalHeight = $(document).height();
		
		for (var i=0; i<otherElements.length; i++) {
			
			otherElementsTotalHeight += $(otherElements[i]).outerHeight();
		
		}
	
		var newHeight = windowTotalHeight - otherElementsTotalHeight;
		var oldHeight = $(this.div).height();
		
		/*var percentualHeight = newHeight * 100 / windowTotalHeight;
		
		if (newHeight > oldHeight) {
			$(this.div).height(percentualHeight+"%");
		}*/
		
		if (newHeight > oldHeight) {
			$(this.div).height(newHeight);
			$(".panel").height(newHeight+2);
			$(".panel").css("top",$(this.div).offset().top);
		}
	
	}
	
	// MAP SCRIPTS 
	
	this.map.create = function() {
		
		this.baselayers.openstreets = new ol.layer.Tile({
			name: 'openstreets',
			title: 'OSM',
			type: 'base',
			visible: true,
			source: new ol.source.XYZ({
				url: '//{a-c}.tile.openstreetmaps.org/{z}/{x}/{y}.png'
			})
		})
		
		this.ol_object = new ol.Map({
			layers:[],
			target: 'map',
			extent: [-13281237.21183002,-7669922.0600572005,-738226.6183457375,-1828910.1066171727],
			controls: [],
			view: new ol.View({
				center: [-7176058.888636417,-4680928.505993671],
				zoom:3.8,
				minZoom: 3.8,
				maxZoom: 21
			})
		});
	
		this.ol_object.addLayer(this.baselayers.openstreets);
		
	}
	
	// PANEL SCRIPTS 
	
	this.panel.start = function() {
		
		$(".phanel .panel-arrow-link").each(function(i,v) {
			
			$(v).on("click",function() {
				
				if (v.getAttribute("data-state") == 1) {
								
					$(v).parent().parent().parent().animate({
						
						left:"-370px"
						
					},1000,function() {
						
						$(v).children("img").attr("src","./images/panel.icon.arrow.0.png");
						
					});
					
					$(v).attr("data-state",0);
					
				}else{
						
					$(v).parent().parent().parent().animate({
						
						left:"0px"
						
					},1000,function() {
						
						$(v).children("img").attr("src","./images/panel.icon.arrow.1.png");
						
					});
					
					$(v).attr("data-state",1);
				}
				
			});
			
		});
		
	}
	
	// POPUP SCRIPTS
	
	this.popup.startInterface = function() {
		
		$(".popup-header-button-toggleable").on("click",function() {
			
			$(this).closest(".nav").find(".popup-header-button-toggleable").not(this).removeClass("popup-header-button-active");
			
			$(this).addClass("popup-header-button-active");
			
		});
		
		$(".popup-panel-tree-item-header").on("click",function() {
			
			if (this.parentNode.getAttribute("data-state") == 1) {
				
				$(this).find(".popup-panel-tree-item-icon").removeClass("far").removeClass("popup-icon-active").addClass("fas");
				
				$(this).find(".popup-panel-tree-item-label").removeClass("popup-text-active");
				
				$(this).find(".popup-panel-tree-item-icon-toggler").removeClass("fa-minus-circle").addClass("fa-plus-circle");
				
				$(this).next(".popup-panel-tree-item-subpanel").slideToggle("slow");
				
				this.parentNode.setAttribute("data-state",0);
				
			}else{
				
				$(this).find(".popup-panel-tree-item-icon").addClass("far").addClass("popup-icon-active").removeClass("fas");
				
				$(this).find(".popup-panel-tree-item-label").addClass("popup-text-active");
				
				$(this).find(".popup-panel-tree-item-icon-toggler").removeClass("fa-plus-circle").addClass("fa-minus-circle");
				
				$(this).next(".popup-panel-tree-item-subpanel").slideToggle("slow");
				
				this.parentNode.setAttribute("data-state",1);
				
			}
			
		});
		
	}
	
	this.popup.start = function() {
		
		this.startInterface();
		
	}
	
}