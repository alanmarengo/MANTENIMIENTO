function ol_indicadores() {

	this.panel = {};
	this.panel.div = document.getElementById("nav-panel");
	
	this.current_ind = 0;
	this.current_ind_title = "";
	this.current_cid = 0;
	
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

	this.loadIndicador = function(ind_id,titulo,clase_id) {
		
		var req = $.ajax({
			
			async:false,
			url:"./indicadores.template.php",
			type:"post",
			data:{
				ind_id:ind_id
			},
			success:function(d){}			
			
		});		
		
		this.current_ind = ind_id;
		this.current_title = titulo;
		this.current_cid = clase_id;
		
		$("#navbar-tools h3").html("Indicadores / " + titulo);
		
		$("#template-wrapper").html("<h3 style='display:none;' id='titulo-indicador-"+ind_id+"'>"+titulo+"</h3>"+req.responseText);
		
		$("#template-wrapper .resource-col").each(function(i,v) {
			
			var pos = $(v).children(".resource-inner").attr("data-pos");
			this.loadIndicadorResource(ind_id,pos);
			
		}.bind(this));
		
		scroll.refresh();
		
		if (clase_id) {
			
			$(".abr[data-cid="+clase_id+"]").trigger("click");
			
		}
		
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
				name:'google_base',
				visible:true,
				source: new ol.source.TileImage({ 
					url: 'http://mt{0-3}.googleapis.com/vt?&x={x}&y={y}&z={z}&hl=es&gl=AR',
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
			
			var fichaIcon = document.createElement("a");
				fichaIcon.className = "indicador-icono-ficha";
				fichaIcon.href = "javascript:void(0);";
				fichaIcon.style.right = "50px";
				fichaIcon.onclick = function() {
					
					var req = $.ajax({
				
						async:false,
						data:{
							ind_id:ind_id,
							pos:pos
						},
						type:"POST",
						url:"./php/get-stats-table-csv-indicador.php",
						success:function(d){}
						
					});
					
					var blob = new Blob([req.responseText], { type: 'text/csv;charset=utf-8;' });
					var filename = "webexport.csv";
					if (navigator.msSaveBlob) { // IE 10+
						navigator.msSaveBlob(blob, filename);
					} else {
						var link = document.createElement("a");
						if (link.download !== undefined) { // feature detection
							// Browsers that support HTML5 download attribute
							var url = URL.createObjectURL(blob);
							link.setAttribute("href", url);
							link.setAttribute("download", filename);
							link.style.visibility = 'hidden';
							document.body.appendChild(link);
							link.click();
							document.body.removeChild(link);
						}
					}					
					
				}.bind(this);
				
			var fichaImg = document.createElement("img");
				fichaImg.src = "./images/ficha-icono-descarga.png";
				
			fichaIcon.appendChild(fichaImg);
			
			document.getElementById("indicador-col-pos-"+pos).appendChild(fichaIcon);
			
			break;
			
			case "grafico":
			
			$("#indicador-col-pos-"+pos).empty();
			$("#indicador-col-pos-"+pos).html(js.type);
			
			eval("draw_grafico_"+js.grafico_tipo_id+"('indicador-col-pos-"+pos+"',js)");
			
			break;
			
			case "slider":
				
			var carouselIndicators = document.createElement("ol");
				carouselIndicators.className = "carousel-indicators";
				
			var carouselSlide = document.createElement("div");
				carouselSlide.id = "carousel-"+pos;
				carouselSlide.className = "carousel slide";
				carouselSlide.setAttribute("data-ride","carousel");
				
			var carouselInner = document.createElement("div");
				carouselInner.className = "carousel-inner";
				
				carouselSlide.appendChild(carouselIndicators);
				carouselSlide.appendChild(carouselInner);
			
			var startClass = "carousel-item active";
			
			for (var i=0; i<js.images.length; i++) {
				
				var carouselIndicatorItem = document.createElement("li");
					carouselIndicatorItem.setAttribute("data-target","#carousel-"+pos);
					carouselIndicatorItem.setAttribute("data-slide-to",i);
				
				var carouselItem = document.createElement("div");
					carouselItem.className = startClass;
					
				var carouselImg = document.createElement("img");
					carouselImg.className = "d-block ml-auto mr-auto";
					carouselImg.setAttribute("src",js.images[i]);
					
					carouselIndicators.appendChild(carouselIndicatorItem);
					carouselItem.appendChild(carouselImg);
					carouselInner.appendChild(carouselItem);
					
				startClass = "carousel-item";
				
			}
			
			document.getElementById("indicador-col-pos-"+pos).innerHTML = "";
			document.getElementById("indicador-col-pos-"+pos).appendChild(carouselSlide);
			
			$(carouselSlide).carousel({
				interval: 3000,
				full_height:true
			})
				
			$(".carousel").css("height","100%");
			$(".carousel-inner").css("height","100%");
			$(".carousel-item").css("height","100%");
			$(".carousel-item img").attr("height","100%");
			
			break;
			
		}
			
		var fichaIcon = document.createElement("a");
			fichaIcon.className = "indicador-icono-ficha";
			fichaIcon.href = "javascript:void(0);";
			fichaIcon.onclick = function() {
				
				jwindow.open("popup-fmetodologica");
				$(".jump-alert-modal").show();
				this.loadFichaMetodologica(ind_id,pos);
				
			}.bind(this);
			
		var fichaImg = document.createElement("img");
			fichaImg.src = "./images/ficha-icono.png";
			
		fichaIcon.appendChild(fichaImg);
		
		document.getElementById("indicador-col-pos-"+pos).appendChild(fichaIcon);		
	
		$("#indicador-col-pos-"+pos).children().first().prepend("<p>"+js.ind_titulo+"</p>");

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
	
	
	this.startSearch = function() {
		
		$("#panel-seach-input-layers").val("");
		
		$("#panel-seach-input-layers").bind("focus",function() {
			
			$(this).parent().animate({
				
				"background-color":"#31cbfd"
				
			},"fast");
			
		});
		
		$("#panel-seach-input-layers").bind("blur",function() {
			
			$(this).parent().animate({
				
				"background-color":"#4c4b4b"
				
			},"fast");
			
		});
		
		$("#panel-seach-input-layers").bind("keyup",function(e) {
			
			if ($("#panel-seach-input-layers").val().trim() == "") {
				
				$("#nav-panel").hide();
				
			}else{
				
				if (e.which == 13) {
					
					this.searchInLayers($("panel-seach-input-layers").val());				
					$("#nav-panel").css("display","flex");
					
				}
				
			}
			
		}.bind(this));
		
	}
	
	this.searchInLayers = function(pattern) {
		
		$("#panel-busqueda-geovisor").css("display","flex");
		$("#panel-busqueda-geovisor .panel-header").html("Resultados de Búsqueda");
		
		var req = $.ajax({
			
			async:false,
			url:"./php/get-indicadores-search.php",
			type:"post",
			data:{
				pattern:pattern
			},
			success:function(d){}
			
		});		
		
		$("#panel-busqueda-geovisor .panel-body").html(req.responseText);
		
		scroll.refresh();
		
	}
	
	
	this.share = function() {
		
		$("#input-share").val("http://observatorio.atic.com.ar/indicadores.php?ind_id="+this.current_ind+"&t="+this.current_title+"&cid="+this.current_cid);
		
		$(".popup").not("#popup-busqueda").hide();
		jwindow.open("popup-share");
		
	}
	
	
	this.print = function() {
		
		$("#template-wrapper").children().show();
		
		var oldHeight = $("#template-wrapper").height();
		var newHeight = $("#template-wrapper").children(".template-indicador-container").height();
		
		$("#template-wrapper").css("height",newHeight+"px");
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
			
			$("#template-wrapper").css("height",oldHeight+"px");
		
			$("#titulo-indicador-"+this.current_ind).hide();
			
		});
		
	}
		
}
