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
		
		var lc_top = $("#layers-container").offset().top+42;
		var lc_newheight = $(document).height() - lc_top;
		
		$(".layer-container-body").height(lc_newheight);				
		scrollbars.redrawElement(".scrollbar-content");
		
	
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
		
		this.createLayers = function() {
			
			$(".layer-checkbox").each(function(i,v) {
				
				v.layer = false;
				
				v.onclick = function() {
					
					if (!v.layer) {
						
						var layer_name = v.getAttribute("data-layer");
						var layer_wms = v.getAttribute("data-wms");
						
						v.layer = new ol.layer.Tile({
							visible:true,
							source: new ol.source.TileWMS({
								url: layer_wms,
								params: {
									'LAYERS': layer_name,
									'VERSION': '1.1.1',
									'FORMAT': 'image/png',
									'TILED': false
								}
							})
						});
				
						this.ol_object.addLayer(v.layer);
						
					}
					
					console.log(v.layer);
					
					if (v.checked) {
						
						v.layer.setVisible(true);
						
					}else{
						
						v.layer.setVisible(false);
						
					}
					
				}.bind(this)
				
			}.bind(this));
			
		}
		
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
				
				$("#abr-container").first(".panel-abr").prepend(this);			
				scrollbars.redrawElement(".scrollbar-content");
				scrollbars.updateSize();
				
			}
			
		});
		
	}
	
	// POPUP SCRIPTS
	
	this.popup.startInterface = function() {
		
		$(".popup-header-button-toggleable").on("click",function() {
			
			var thistar = this.getAttribute("data-target");
			
			$(this).closest(".nav").find(".popup-header-button-toggleable").not(this).removeClass("popup-header-button-active");
			
			$(this).addClass("popup-header-button-active");
			
		});
		
		$("#btn-popup-basic").on("click",function() {
			
			$("#geovisor-popup-search").slideUp();
			$("#popup-panel-section-1").slideDown();
			$("#scrollbar-content-basic-2").css("height","160px");
			$("#scrollbar-content-basic-3").css("height","430px");
			scrollbars.redrawElement("#scrollbar-content-basic-2");
			scrollbars.redrawElement("#scrollbar-content-basic-3");
			
		});
		
		$("#btn-popup-advanced").on("click",function() {
			
			$("#geovisor-popup-search").slideDown();
			$("#popup-panel-section-1").slideUp();
			$("#scrollbar-content-basic-2").css("height","260px");
			$("#scrollbar-content-basic-3").css("height","300px");
			scrollbars.redrawElement("#scrollbar-content-basic-2");
			scrollbars.redrawElement("#scrollbar-content-basic-3");
			
		});
		
		$(".popup-panel-tree-item-header").on("click",function() {
			
			if (this.parentNode.getAttribute("data-state") == 1) {
				
				$(this).find(".popup-panel-tree-item-icon").removeClass("far").removeClass("popup-icon-active").addClass("fas");
				
				$(this).find(".popup-panel-tree-item-label").removeClass("popup-text-active");
				
				$(this).find(".popup-panel-tree-item-icon-toggler").removeClass("fa-minus-circle").addClass("fa-plus-circle");
				
				$(this).next(".popup-panel-tree-item-subpanel").slideToggle("slow",function() {					
					
					scrollbars.redrawElement("#scrollbar-content-basic-2");
					
				});
				
				this.parentNode.setAttribute("data-state",0);
				
			}else{
				
				$(this).find(".popup-panel-tree-item-icon").addClass("far").addClass("popup-icon-active").removeClass("fas");
				
				$(this).find(".popup-panel-tree-item-label").addClass("popup-text-active");
				
				$(this).find(".popup-panel-tree-item-icon-toggler").removeClass("fa-plus-circle").addClass("fa-minus-circle");
				
				$(this).next(".popup-panel-tree-item-subpanel").slideToggle("slow",function() {					
					
					scrollbars.redrawElement("#scrollbar-content-basic-2");
					
				});
				
				this.parentNode.setAttribute("data-state",1);
				
			}
			
		});
		
	}
	
	this.popup.start = function() {
		
		this.startInterface();
		
	}
	
}