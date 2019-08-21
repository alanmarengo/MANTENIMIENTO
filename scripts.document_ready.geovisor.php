<script type="text/javascript">
	
	$(document).ready(function() {
		
		flotant = new Jump.flotant();
		flotant.prepareToggle(".navmenu:not(#nav-panel)");
		flotant.fitTopElement("#navbar-tools","#navbar-main");
		flotant.fitTopElement(".page-container",".jump-navbar");
		flotant.fit();
		
		scroll = new Jump.scroll();
		scroll.refresh();
		
		toggleimage = new Jump.toggleimage();
		toggleimage.refresh();
		
		hovimage = new Jump.hovimage();
		hovimage.refresh();
		
		jwindow = new Jump.window();
		jwindow.initialize();
		jwindow.setAllWindowsDraggable();
		jwindow.initMinimizing();
		
		//resize = new Jump.resizer(document.getElementById("popup-geovisor"));
		
		nav = new Jump.nav();
		nav.hamburguer.addBehavior(function() {
			
			var addBackOptionSize = $(".jump-sublevel-backoption:visible").length;
			
			if (addBackOptionSize > 0) {
				
				$(".jump-sublevel-backoption:visible a").trigger("click");
				
			}else{
			
				$("#hamburguer").toggleClass('open');
				flotant.toggle('#nav-main',false,false,false);
			
			}
			
		});
		
		/*** MAP ***/
		
		geomap = new ol_map();
		
		geomap.map.create();
		geomap.map.createLayers();
		geomap.map.createPrintLegendDiv();
		
		geomap.map.panel.start();
	
		<?php if (isset($_GET["geovisor"])) { ?>
		
			geomap.map.loadGeovisor(<?php echo $_GET["geovisor"]; ?>);
		
		<?php }else{ ?>
		
			<?php if (isset($_GET["l"])) { ?>
				
			var s_clase = [<?php echo $_GET["c"]; ?>];
			var s_layers = [<?php echo $_GET["l"]; ?>];
			var s_visibles = [<?php echo $_GET["v"]; ?>];
			
			for (var i=0; i<s_layers.length; i++) { 
				geomap.panel.AddLayer(s_clase[i],s_layers[i]);
				if (s_visibles[i]) { 
					document.getElementById("layer-checkbox-"+s_layers[i]).click(); 
				}
			}
							
			<?php } ?>
			
			<?php if ((isset($_GET["ca"])) && (!empty($_GET["ca"]))) { ?> 
				
				var ca = <?php echo $_GET["ca"]; ?>;
				
				$(".panel-abr[data-cid="+ca+"]").trigger("click"); 
				
			<?php } ?>
			
			<?php if ((isset($_GET["z"])) && (!empty($_GET["z"]))) { ?> 
			
			geomap.map.ol_object.getView().setZoom(<?php echo $_GET["z"]; ?>);
							
			<?php } ?>
			
			<?php if ((isset($_GET["cen"])) && (!empty($_GET["cen"]))) { ?> 
			
			geomap.map.ol_object.getView().setCenter(ol.proj.transform([<?php echo $_GET["cen"]; ?>], 'EPSG:3857', 'EPSG:3857'));
							
			<?php } ?>
		
		<?php } ?>
		
		geomap.map.updateLayerCount();
		geomap.map.startSearch();
		
		window.addEventListener("resize",onresize);
		onresize();
		
		// SELECCIONAR PROYECTOS AL INICIAR GEOVISOR
		$("#popup-basic-filters input[type=checkbox]").trigger("click");
		
		// ARREGLAR FIX POPUP
		var pb_h = $("#popup_body").height();
		var s_h = $("#popup-basic-filters").height();
		
		var n_h = (pb_h-s_h);
		alert(n_h);
		$("#dynbox-popup-layers").css("height",n_h+"px");
		
	});

</script>