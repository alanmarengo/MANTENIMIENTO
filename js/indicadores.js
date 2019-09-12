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
			
			for (var i=0; i<js.layers.length; i++) {
			
				map_layers[i+1] = new ol.layer.Tile({
					name:js.layers[i],
					visible:true,
					source: new ol.source.TileWMS({
						url: js.layers_server[i],
						params: {
							'LAYERS': js.layers[i],
							'VERSION': '1.1.1',
							'FORMAT': 'image/png',
							'TILED': false
						}
					})
				});
				
			}
			
			var indMap = new ol.Map({
				layers:map_layers,
				target: "indicador-col-pos-"+pos,
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
			
			case "table":
			
			var table = document.createElement("table");
				table.className = "indicadores-table";
				
			var headRow = document.createElement("tr");
			
			for (var i=0; i<js.columns.length; i++) {
				
				var td = document.createElement("th");
					td.innerHTML = js.columns[i];
			
					headRow.appendChild(td);
				
			}
			
			table.appendChild(headRow);
			
			for (var i=0; i<js.data.length; i++) {
				
				var tr = document.createElement("tr");
				
				for (var j=0; j<js.data[i].length; j++) {
					
					var td = document.createElement("td");
						td.innerHTML = js.data[i][j];
						
					tr.appendChild(td);
					
				}
				
				table.appendChild(tr);
				
			}
			
			$("#indicador-col-pos-"+pos).empty();
			document.getElementById("indicador-col-pos-"+pos).appendChild(table);
			
			break;
			
			case "grafico":
			
			$("#indicador-col-pos-"+pos).empty();
			$("#indicador-col-pos-"+pos).html(js.type);
			
			eval("draw_grafico_"+js.grafico_tipo_id+"('indicador-col-pos-"+pos+"',js)");
			
			break;
			
			case "slider":
			
			var carouselSlide = document.createElement("div");
				carouselSlide.id = "carousel-"+pos;
				carouselSlide.className = "carousel slide";
				carouselSlide.setAttribute("data-ride","carousel");
				
			var carouselInner = document.createElement("div");
				carouselInner.className = "carousel-inner";
				
				carouselSlide.appendChild(carouselInner);
			
			var startClass = "carousel-item active";
			
			for (var i=0; i<js.images.length; i++) {
				
				var carouselItem = document.createElement("div");
					carouselItem.className = startClass;
					
				var carouselImg = document.createElement("img");
					carouselImg.className = "d-block w-100";
					carouselImg.setAttribute("src",js.images[i]);
					
					carouselItem.appendChild(carouselImg);
					carouselInner.appendChild(carouselItem);
					
				startClass = "carousel-item";
				
			}
			
			document.getElementById("indicador-col-pos-"+pos).innerHTML = "";
			document.getElementById("indicador-col-pos-"+pos).appendChild(carouselSlide);
			
			$(carouselSlide).carousel({
				interval: 2000
			})
			
			break;
			
		}
			
		var fichaIcon = document.createElement("a");
			fichaIcon.className = "indicador-icono-ficha";
			fichaIcon.href = "javascript:void(0);";
			fichaIcon.onclick = function() {
				
				jwindow.open("popup-fmetodologica");
				this.loadFichaMetodologica(ind_id,pos);
				
			}.bind(this);
			
		var fichaImg = document.createElement("img");
			fichaImg.src = "./images/ficha-icono.png";
			
		fichaIcon.appendChild(fichaImg);
		
		document.getElementById("indicador-col-pos-"+pos).appendChild(fichaIcon);
		
	}
	
	this.loadFichaMetodologica = function(ind_id,pos) {
		
		var req = $.ajax({
			
			async:false,
			url:"./indicadores.get-labels.php",
			type:"post",
			data:{
				ind_id:ind_id,
				pos:pos
			},
			success:function(d){}
			
		});
		
		var js = JSON.parse(req.responseText);
		
		document.getElementById("ficha-metodologica-titulo").innerHTML = js.titulo;
		document.getElementById("ficha-metodologica-desc").innerHTML = js.desc;
		document.getElementById("ficha-metodologica-view").href = js.ficha_metodo_path;
		document.getElementById("ficha-metodologica-download").href = js.ficha_metodo_path;
		
	}
	
	this.print = function() {
		
		$("#template-wrapper").css("height",$("#template-wrapper").height()+"px");
		window.scrollTo(0,0);
		
		html2canvas(document.querySelector("#template-wrapper")).then(canvas => {
						
			var a = document.createElement('a');
			// toDataURL defaults to png, so we need to request a jpeg, then convert for file download.
			a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream");
			a.download = 'captura.jpg';
			
			document.body.appendChild(a);
			
			a.click();
			
			$(a).remove();
			
			//$("#print-legend-wrapper").hide();
			
		});
		
	}
		
}
