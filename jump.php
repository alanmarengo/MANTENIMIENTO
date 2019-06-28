<?php include("pgconfig.php"); ?>
<?php include("geovisor.fn.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>

	<title>Inicio</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- CSS -->	

	<!-- PRETTY CHECKBOX -->

	<link rel="stylesheet" href="./css/pretty-checkbox.css"/>
	<link href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css" rel="stylesheet"> <!-- CHECKBOX FONTS -->
	
	<!-- FONTS -->

	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="./fontawesome-5.8.1/css/all.min.css" />	

	<!-- BOOTSTRAP + LIBS -->

	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="./css/bootstrap-datepicker.min.css" />
	<link rel="stylesheet" type="text/css" href="./css/bootstrap-select.css" />
	<link rel="stylesheet" type="text/css" href="./css/perfect-scrollbar.css" />
	<link rel="stylesheet" type="text/css" href="./css/site.css" />
	
	<!-- SITE CSS -->
	
	<link rel="stylesheet" type="text/css" href="./css/geovisor.css">
	<link rel="stylesheet" type="text/css" href="./css/nav.css">
	<link rel="stylesheet" type="text/css" href="./css/navbar.main.css">
	<link rel="stylesheet" type="text/css" href="./css/navbar.tools.css">
	<link rel="stylesheet" type="text/css" href="./css/hamburguer.css">
	<link rel="stylesheet" type="text/css" href="./css/flexbox.css">
	
	<!-- JUMP CSS -->
	
	<link rel="stylesheet" type="text/css" href="./css/jump.spacers.css">
	<link rel="stylesheet" type="text/css" href="./css/jump.displays.css"/>
	<link rel="stylesheet" type="text/css" href="./css/jump.link.css"/>
	<link rel="stylesheet" type="text/css" href="./css/jump.rowcol.css"/>
	<link rel="stylesheet" type="text/css" href="./css/jump.spacers.css"/>
	<link rel="stylesheet" type="text/css" href="./css/jump.theme.css" />
	<link rel="stylesheet" type="text/css" href="./css/jump.window.css" />

	<!-- GEOVISOR -->

	<link rel="stylesheet" href="./css/geovisor/forms.css"/>
	<link rel="stylesheet" href="./css/geovisor/layers.css"/>
	<link rel="stylesheet" href="./css/geovisor/map.css"/>
	<link rel="stylesheet" href="./css/geovisor/panel.css"/>
	<link rel="stylesheet" href="./css/geovisor/popup.css"/>
	<link rel="stylesheet" href="./css/geovisor/input.css"/>
	<link rel="stylesheet" href="./css/geovisor/spacers.css"/>
	<link rel="stylesheet" href="./css/geovisor/sliders.css"/>
	<link rel="stylesheet" href="./css/geovisor/style.css"/>

	<!-- COLORPICKER CSS -->

	<link rel="stylesheet" href="./js/colorpicker/css/colorpicker.css"/>
	
	<!-- SCRIPTS -->
	
	<!-- JQUERY + UI -->	

	<script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="./js/jquery-ui/jquery-ui.min.js"></script>	

	<!-- POPPER -->	
	<script src="./js/popper-1.12.9.min.js"></script>

	<!-- BOOTSTRAP + LIBS -->	
	<script type="text/javascript" src="./js/bootstrap.min.js"></script>
	<script src="./js/bootstrap-datepicker.min.js"></script>
	<script src="./js/bootstrap-datepicker.es.min.js"></script>
	<script src="./js/bootstrap-select.js"></script>

	<script src="./js/perfect-scrollbar.js" type="text/javascript"></script>
	<script src="./js/scrollbars.js" type="text/javascript"></script>
	<script src="./js/moment.js"></script>
	<script src="./js/site.js" type="text/javascript"></script>
	<script src="./js/map.js" type="text/javascript"></script>
	<script src="./js/widget-links.js" type="text/javascript"></script>

	<!-- COLORPICKER JS -->
	
	<script src="./js/colorpicker/js/colorpicker.js" type="text/javascript"></script>

	<!-- HTML 2 CANVAS -->
	
	<script src="http://html2canvas.hertzen.com/dist/html2canvas.js"></script>

	<!-- JUMP JS -->

	<script src="./js/jump.js"></script>
	<script src="./js/jump.flotant.js"></script>
	<script src="./js/jump.nav.js"></script>
	<script src="./js/jump.hovimage.js"></script>
	<script src="./js/jump.scroll.js"></script>
		
	<?php include("./scripts.openlayers.php"); ?>	
	
	<!-- MAP -->
	
	<script src="./js/config.js" type="text/javascript"></script>
	<script src="./js/map.js" type="text/javascript"></script>
	<script src="./js/chart.js" type="text/javascript"></script>
	
	<?php// include("./scripts.default.php"); ?>
	
	<script type="text/javascript">
	
		$(document).ready(function() {
			
			flotant = new Jump.flotant();
			flotant.prepareToggle(".navmenu:not(#nav-panel)");
			flotant.fitTopElement("#navbar-tools","#navbar-main");
			flotant.fitTopElement(".page-container",".jump-navbar");
			flotant.fit();
			
			scroll = new Jump.scroll();
			scroll.refresh();
			
			hovimage = new Jump.hovimage();
			hovimage.refresh();
			
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

			window.addEventListener("resize",function() {
				
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
			
		});
	
	</script>
	
</head>
<body>

	<div id="page">
	
		<?php include("./html.navbar-main.php"); ?>
		<?php include("./html.navbar-tools.php"); ?>
		
		<div class="page-container">
		
			<div id="map" class="jump-flotant-heightfill">
				<div id="global-coordinates">
					<span id="global-coordinates-span"></span>
				</div>
			</div>
			<?php //include("./section.index.php"); ?>
			
			<?php include("./html.nav.php"); ?>
			<?php include("./html.nav.geovisores.php"); ?>
			<?php include("./html.nav.vinculaciones_insterinstitucionales.php"); ?>
			<?php include("./html.nav.recursos_hidricos.php"); ?>
			
			<?php include("./html.panel.php"); ?>
			
		</div>
		
	</div>
			
	<?php include("./popup.php"); ?>	

</body>
</html>