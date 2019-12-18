function loadComboObra(proyectos) {
		
		$("#uxVisor").children("option").remove();
		
		for (var i=0; i<proyectos.length; i++) {
			
			$("#uxVisor").append(
				$("<option></option>")
				.val(proyectos[i].index)
				.text(proyectos[i].label)
			);
		
		}
		
		$("#uxVisor").selectpicker("refresh");
		
		loadComboComponente(proyectos);	
		
		$(".bootstrap-select").css({
			
			"width": "450px",
			"position": "absolute",
			"z-index": "9999",
			"top": "10px",
			"left": "30px"
			
		});
		
	}
	
function loadComboComponente(proyectos) {
	
	var obraIndex = $("#uxVisor").val();
	
	$("#uxCapa").empty();
	
	var mapLayers = geomap.map.ol_object.getLayers().getArray();

	for (var i=0; i<mapLayers.length; i++) {
		
		if (mapLayers[i].get('name') != "google_base") {
		
			geomap.map.ol_object.removeLayer(mapLayers[i]);
		
		}
	
	}
	
	for (var i=0; i<proyectos[obraIndex].layers.length; i++) {
		
		var layer_id = proyectos[obraIndex].layers[i].layer_id;
		var layerData = geomap.map.getLayerData(layer_id);
				
		var input = document.createElement("input");
			input.type = "checkbox";
			input.setAttribute("data-layer-id",proyectos[obraIndex].layers[i].layer_id);
			input.setAttribute("data-oi",obraIndex);
			input.setAttribute("data-i",i);
			input.checked = true;
			input.layer = new ol.layer.Tile({
				name:layerData.layer_wms_layer,
				visible:true,
				source: new ol.source.TileWMS({
					//url: layerData.layer_wms_server,
					url:"http://observatorio.ieasa.com.ar:8080/geoserver/ows?",
					params: {
						'LAYERS': layerData.layer_wms_layer,
						'VERSION': '1.1.1',
						'FORMAT': 'image/png',
						'TILED': false,
						'layer_id':layer_id
					}/*,
					crossOrigin: 'anonymous'*/
				})
			});
			input.onclick = function() {
								
				var layer_id = this.getAttribute("data-layer-id");
				var layerData = geomap.map.getLayerData(layer_id);
				
				/*if (this.layer == undefined) {
					
					this.layer = new ol.layer.Tile({
						name:layerData.layer_wms_layer,
						visible:true,
						source: new ol.source.TileWMS({
							//url: layerData.layer_wms_server,
							url:"http://observatorio.ieasa.com.ar:8080/geoserver/ows?",
							params: {
								'LAYERS': layerData.layer_wms_layer,
								'VERSION': '1.1.1',
								'FORMAT': 'image/png',
								'TILED': false,
								'layer_id':layer_id
							}/*,
							crossOrigin: 'anonymous'
						})
					});
					
					geomap.map.ol_object.addLayer(this.layer);
					
					this.layer.setVisible(true);
					
					geomap.map.ol_object.updateSize();
					geomap.map.ol_object.render();
				}*/			
				
				if (this.checked) {
				
					this.layer.setVisible(true);
	
					var js = geomap.map.getLayerExtent(layer_id);
					
					var extent = ol.proj.transformExtent(
						[js.minx,js.miny,js.maxx,js.maxy],
						"EPSG:3857", "EPSG:3857"
					);
					
					geomap.map.ol_object.getView().fit(extent,{duration:1000});
					geomap.map.ol_object.updateSize();
					geomap.map.ol_object.render();
					
				
				}else{
					
					this.layer.setVisible(false);
					
				}
				
			}
			
		var zoomTool = document.createElement("div");
			zoomTool.className = "d-inline ml-5 jump-posrel";
			zoomTool.style.top = "-2px";
		
		var zoomToolA = document.createElement("a");
			zoomToolA.href = "#";
			zoomToolA.setAttribute("data-layer-id",proyectos[obraIndex].layers[i].layer_id);
			zoomToolA.title = "Ir a extent de capa";
			zoomToolA.onclick = function() {
				
				var layer_id = this.getAttribute("data-layer-id");
				
				var js = geomap.map.getLayerExtent(layer_id);
					
				var extent = ol.proj.transformExtent(
					[js.minx,js.miny,js.maxx,js.maxy],
					"EPSG:3857", "EPSG:3857"
				);
				
				geomap.map.ol_object.getView().fit(extent,{duration:1000});
				geomap.map.ol_object.updateSize();
				geomap.map.ol_object.render();
				
			}
		
		var zoomToolImg = document.createElement("img");
			zoomToolImg.src = "./images/geovisor/icons/layer-bar-zoom.png";
			
			zoomTool.appendChild(zoomToolA);
			zoomToolA.appendChild(zoomToolImg);
			
		
		$("#uxCapa").append(
			$("<p></p>")					
				.append(input)
				.append(zoomTool)
				.append(
					$("<span></span>")
						.addClass("ml-10")
						.html(proyectos[obraIndex].layers[i].componente)
				)
			/*.val(proyectos[obraIndex].layers[i].layer_id)
			.text(proyectos[obraIndex].layers[i].componente)*/
		);
	
	}
	
	$("#uxCapa").selectpicker("refresh");
	
}

function loadLabels() {
	
	/*var proyectText = $("#uxVisor option:selected").text();
	var layerText = $("#uxCapa option:selected").text();
	
	$("#label-proyecto").html(proyectText);
	$("#label-capa").html(layerText);*/
	
}

function drawLayer() {
	
	/*var layer_id = $("#uxCapa").val();
	
	var layerData = geomap.map.getLayerData(layer_id);
	
	if (geomap.map.uniqueLayer) {
		
		geomap.map.ol_object.removeLayer(geomap.map.uniqueLayer);
		
	}
	
	geomap.map.uniqueLayer = new ol.layer.Tile({
		name:layerData.layer_wms_layer,
		visible:true,
		source: new ol.source.TileWMS({
			url: layerData.layer_wms_server,
			params: {
				'LAYERS': layerData.layer_wms_layer,
				'VERSION': '1.1.1',
				'FORMAT': 'image/png',
				'TILED': false,
				'layer_id':layer_id
			}/*,
			crossOrigin: 'anonymous'
		})
	});
	
	geomap.map.ol_object.addLayer(geomap.map.uniqueLayer);
	
	var js = geomap.map.getLayerExtent(layer_id);
	
	var extent = ol.proj.transformExtent(
		[js.minx,js.miny,js.maxx,js.maxy],
		"EPSG:3857", "EPSG:3857"
	);
	
	geomap.map.ol_object.getView().fit(extent,{duration:1000});
	geomap.map.ol_object.updateSize();
	geomap.map.ol_object.render();*/
	
}

$(document).ready(function() {
	
$("[title]").tooltipster({
	animation: 'fade',
	delay: 200,
	theme: 'tooltipster-default',
	trigger: 'hover'
});
		
geomap = new ol_map();
	
geomap.map.create();
geomap.map.createLayers();

$('.section-sticky a').on('click', function() {
	$('.section-sticky a').removeClass('selected');
	$(this).addClass('selected');

	let selector = $(this).data('target');
	$('html, body').animate({
		scrollTop: $(selector).offset().top - 200
	}, 500)
});

let target = $.urlParam('target');
if (target)
	$('#link-' + target).trigger('click');

$('.section-footer-button2').hover( 
	function () {
		let key=$(this).data('key');
		$(this).css('background-image', 'url("./images/icono-' + key + '-relleno-hover.png")')
	},
	function () {
		let key=$(this).data('key');
		$(this).css('background-image', 'url("./images/icono-' + key + '-relleno.png")')
	}
)

var req = $.ajax({
	
	async:false,
	type:"POST",
	url:"./php/get-geovisor-combo-json.php",
	success:function(d){}
	
});

var js = JSON.parse(req.responseText);

var proyectos = js;

/*var proyectos = [

	{
		
		"index":0,
		"label":"Condor Cliff",
		"layers":[
			{
				"layer_id":816,
				"componente":"AHRSC",
				"schema":"obra",
				"layer":"vp_geo_prcpr_presacc_otr1"
			},
			{
				"layer_id":818,
				"componente":"Obras de toma para la casa de máquinas",
				"schema":"obra",
				"layer":"vp_geo_prcpr_obratomacc_otr1"
			},
			{
				"layer_id":819,
				"componente":"Casa de máquinas",
				"schema":"obra",
				"layer":"vp_geo_prcpr_maquinascc_otr1"
			},
			{
				"layer_id":820,
				"componente":"Obras de desvío del río durante la construcción",
				"schema":"obra",
				"layer":"vp_geo_prcpr_desviocc_otr1"
			},
			{
				"layer_id":821,
				"componente":"Presas de materiales",
				"schema":"obra",
				"layer":"vp_geo_prcpr_ejecc_otr1"
			},
			{
				"layer_id":822,
				"componente":"Escala de Peces",
				"schema":"obra",
				"layer":"vp_geo_prcpr_escalacc_otr1"
			},
			{
				"layer_id":823,
				"componente":"Vertedero",
				"schema":"obra",
				"layer":"vp_geo_prcpr_vertecc_otr1"
			},
			{
				"layer_id":824,
				"componente":"Descargador de fondo",
				"schema":"obra",
				"layer":"vp_geo_prcpr_descargadorcc_otr1"
			}
		]
	
	},
	{
	
		"index":1,
		"label":"La Barrancosa",
		"layers":[
			{
				"layer_id":817,
				"componente":"AHRSC",
				"schema":"obra",
				"layer":"vp_geo_prcpr_presalb_otr1"
			},
			{
				"layer_id":825,
				"componente":"Obras de toma para la casa de máquinas",
				"schema":"obra",
				"layer":"vp_geo_prcpr_maquinaslb_otr1"
			},
			{
				"layer_id":825,
				"componente":"Casa de máquinas",
				"schema":"obra",
				"layer":"vp_geo_prcpr_maquinaslb_otr1"
			},
			{
				"layer_id":826,
				"componente":"Obras de desvío del río durante la construcción",
				"schema":"obra",
				"layer":"vp_geo_prcpr_desviolb_otr1"
			},
			{
				"layer_id":827,
				"componente":"Presas de materiales",
				"schema":"obra",
				"layer":"vp_geo_prcpr_ejelb_otr1"
			},
			{
				"layer_id":828,
				"componente":"Escala de Peces",
				"schema":"obra",
				"layer":"vp_geo_prcpr_escalalb_otr1 "
			},
			{
				"layer_id":829,
				"componente":"Vertedero",
				"schema":"obra",
				"layer":"vp_geo_prcpr_vertelb_otr1"
			},
			{
				"layer_id":829,
				"componente":"Descargador de fondo",
				"schema":"obra",
				"layer":"vp_geo_prcpr_vertelb_otr1"
			}
		]
	
	},
	{
		
		"index":2,
		"label":"LEAT",
		"layers":[
			{
				"layer_id":815,
					"componente":"LEAT",
					"schema":"bd_lin_electrica",
					"layer":"vp_geo_prcpr_leat_otr1"
				}
			]
			
		}
		
	];*/
	
	document.getElementById("uxVisor").addEventListener("change",function() {
		
		loadComboComponente(proyectos);	
		//loadLabels();
		
	});
	
	loadComboObra(proyectos);

});