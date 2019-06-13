<!DOCTYPE html>
<html lang="es">
<head>

	<title>JUMP</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php include("./scripts.default.php"); ?>	
	<?php include("./scripts.openlayers.php"); ?>	

	<!-- JUMP THEME -->

	<link rel="stylesheet" href="./css/jump.theme.geovisor.css"/>
	
	<!-- MAP -->
	
	<script src="./js/map.js" type="text/javascript"></script>

	<script type="text/javascript">
	
		$(document).ready(function(){		
			
			/*** FLOTANT ***/
				
			flotant = new Jump.flotant();
			flotant.setFitAgainstRule(".jump-navbar"); // default
				
			flotant.initialize();
			
			/*** NAV ***/
			
			nav = new Jump.nav();
			nav.hamburguer.fit();
			nav.hamburguer.addBehavior(function() {
				
				var addBackOptionSize = $(".jump-sublevel-backoption:visible").length;
				
				if (addBackOptionSize > 0) {
					
					$(".jump-sublevel-backoption:visible a").trigger("click");
					
				}else{
				
					$(this).toggleClass('open');
					flotant.toggle('#nav-main',false);
				
				}
				
			});			
			
			nav.fitNavLinks();	
			
			/*** FLOTANT ***/
			
			jwindow = new Jump.window();
			//jwindow.initialize();
			jwindow.setAllWindowsDraggable();
			
			/*** BLOCK ***/
			
			block = new Jump.block();
			block.refresh();
			
			/*** SCROLL ***/
			
			scroll = new Jump.scroll();
			scroll.refresh();
			
			/*** INPUT ***/
			
			jinput = new Jump.input();
			jinput.initialize();
			
			/*** MAP ***/
			
			geomap = new ol_map();
			
			geomap.map.create();
			geomap.map.createLayers();
			geomap.map.createPrintLegendDiv();
		
		});
		
	</script>
	
</head>
<body>

	<div class="jump-site">
	
		<div class="jump-navbar" id="jump-navbar-main">
		
			<?php include("./html.navbar-main.php"); ?>
		
		</div>
	
		<div class="jump-navbar" id="jump-navbar-geovisor">
		
			<?php include("./html.navbar-geovisor.php"); ?>
		
		</div>
		
		<div class="jump-container jump-flotant-heightfill jump-flotant-heightfill-top jump-posabs" id="map">
		
		</div>
	
	</div>
	
	<div class="jump-align-right jump-align-bottom jump-window jump-posfix col col-xs-12 col-sm-12-col-md-3 col-lg-3" id="jump-navbar-zoom">
	
		<div class="jump-nav-default jump-nav-inner">
		
			<?php include("html.navbar-geovisor-zoom.php"); ?>
		
		</div>
	
	</div>
	
	<div class="jump-flotant-heightfill jump-flotant-nav jump-scroll jump-posfix col col-xs-12 col-sm-12-col-md-3 col-lg-3" data-visible="0" id="nav-main">
	
		<div class="jump-nav-default jump-nav-inner">
		
			<?php include("html.nav.php"); ?>
		
		</div>
	
	</div>
	
	<div class="jump-flotant-heightfill jump-flotant-nav jump-scroll jump-posfix jump-flotant-nav-level-2 col col-xs-12 col-sm-12-col-md-3 col-lg-3" data-visible="0" id="nav-geovisores">
	
		<div class="jump-nav-default jump-nav-inner">
		
			<?php include("html.nav.geovisores.php"); ?>
		
		</div>
	
	</div>
	
	<div class="jump-flotant-heightfill jump-flotant-nav jump-scroll jump-posfix jump-flotant-nav-level-2 col col-xs-12 col-sm-12-col-md-3 col-lg-3" data-visible="0" id="nav-vinculaciones-insterinstitucionales">
	
		<div class="jump-nav-default jump-nav-inner">
		
			<?php include("html.nav.vinculaciones_insterinstitucionales.php"); ?>
		
		</div>
	
	</div>
	
	<div class="jump-flotant-heightfill jump-flotant-nav jump-scroll jump-posfix jump-flotant-nav-level-2 col col-xs-12 col-sm-12-col-md-3 col-lg-3" data-visible="0" id="nav-recursos-hidricos">
	
		<div class="jump-nav-default jump-nav-inner">
		
			<?php include("html.nav.recursos_hidricos.php"); ?>
		
		</div>
	
	</div>
	
	<?php include("./popup.baselayers.php"); ?>

</body>
</html>