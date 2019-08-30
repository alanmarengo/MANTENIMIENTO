function ol_indicadores() {

	this.panel = {};
	this.panel.div = document.getElementById("nav-panel");
	
	this.panel.start = function() {
		
		$(".panel-abr").on("click",function() {
			
			if (this.getAttribute("data-active") == 0) {
					
				$(".panel-abr").attr("data-active","0");
				//$(".panel-abr").css("border-color","transparent");
				//$(".panel-abr").css("background-color","transparent");
				$(".panel-abr").css("background-color","#F5F5F5");
				$(".panel-abr").css("color","#888888");
				
				$(this).attr("data-active","1");
				//$(this).css("border-color",this.getAttribute("data-color"));
				//$(this).css("background-color",this.getAttribute("data-bgcolor"));
				$(this).css("background-color","#31cbfd");
				$(this).css("color","#FFFFFF");
					
				$(".layer-container").not(".layer-container[data-cid="+this.getAttribute("data-cid")+"]").hide();
				$(".layer-container[data-cid="+this.getAttribute("data-cid")+"]").show();
				//$("#abr-container").first(".panel-abr").prepend(this);			
				scroll.refresh();
					
			}
			
		});
	
	}

	this.loadIndicador = function(ind_id) {
		
		var req = $.ajax({
			
			async:false,
			url:"./indicadores.template.php",
			type:"post",
			data:{
				ind_id:ind_id
			},
			success:function(d){}
			
		});		
		
		$("#template-wrapper").html(req.responseText);
		
		$("#template-wrapper .resource-col").each(function(i,v) {
			
			var pos = $(v).attr("data-pos");
			this.loadIndicadorResource(ind_id,pos);
			
		}.bind(this));
		
		scroll.refresh();
		
	}
	
	this.loadIndicadorResource = function(ind_id,pos) {
		
		var req = $.ajax({
			
			async:false,
			url:"./indicadores.get-recurso.php",
			type:"post",
			data:{
				ind_id:ind_id,
				pos:pos
			},
			success:function(d){}
			
		});
		
		var js = JSON.parse(req.responseText);
		
		switch(js.type) {
			
			case "layer":
			
			var map_layers = [];
		
			map_layers[0] = new ol.layer.Tile({
				name: 'openstreets',
				title: 'OSM',
				type: 'base',
				visible: true,
				source: new ol.source.XYZ({
					url: '//{a-c}.tile.openstreetmaps.org/{z}/{x}/{y}.png',
					crossOrigin: 'anonymous'
				})
			});
			
			for (var i=0; $i<js.layers.length; $i++) {
			
				map_layers[i+1] = new ol.layer.Tile({
					visible:true,
					source: new ol.source.TileWMS({
						url: js.layers_server[i],
						params: {
							'LAYERS': '<?php echo $layer_name[$i]; ?>',
							'VERSION': '1.1.1',
							'FORMAT': 'image/png',
							'TILED': false
						}
					})
				});
				
			}
			
			var indMap = new ol.Map({
				layers:map_layers,
				target: "#template-wrapper .resource-col[data-pos="+pos+"]",
				extent: [-13281237.21183002,-7669922.0600572005,-738226.6183457375,-1828910.1066171727],
				controls: [],
				view: new ol.View({
					center: [-7176058.888636417,-4680928.505993671],
					zoom:3.8,
					minZoom: 3.8,
					maxZoom: 21
				})
			});
			
			break;
			
		}
		
	}
		
}