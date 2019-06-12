<!DOCTYPE html>
<html lang="es">
<head>

	<title>JUMP</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700" rel="stylesheet">	
	
	<link rel="stylesheet" href="./css/bootstrap.css"/>	
	<link rel="stylesheet" href="./js/jquery-ui/jquery-ui.min.css"/>	

    <link rel="stylesheet" href="./fontawesome-5.8.1/css/all.min.css" />
	
	<link rel="stylesheet" href="./css/pretty-checkbox.css"/>
	<link href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css" rel="stylesheet"> <!-- CHECKBOX FONTS -->
	
	<link rel="stylesheet" href="./css/perfect-scrollbar.css"/>
	<link rel="stylesheet" href="./css/bootstrap-select.css"/>
	    
	<link rel="stylesheet" href="./css/bootstrapfix.navbar.css"/>	
	
	<!-- JUMP CSS -->
	
	<link rel="stylesheet" href="./css/jump.site.css"/>
	<link rel="stylesheet" href="./css/jump.navbar.css"/>
	<link rel="stylesheet" href="./css/jump.hamburguer.css"/>
	<link rel="stylesheet" href="./css/jump.flotant.css"/>
	<link rel="stylesheet" href="./css/jump.theme.default.css"/>
	
	<!-- JUMP CSS AUX -->
	
	<link rel="stylesheet" href="./css/jump.spacers.css"/>
	
	<script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="./js/popper-1.12.9.min.js"></script>
	<script type="text/javascript" src="./js/bootstrap.min.js"></script>
	<script type="text/javascript" src="./js/jquery-ui/jquery-ui.min.js"></script>	

	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/highcharts-more.js"></script>
	<script src="https://code.highcharts.com/modules/funnel.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	
	<script src="./js/perfect-scrollbar.js"></script>
	<script src="./js/bootstrap-select.js"></script>
	<script src="./js/bootstrap-select-init.js"></script>
	
	<script src="./js/jump.js"></script>
	<script src="./js/jump.nav.js"></script>
	<script src="./js/jump.flotant.js"></script>
	
	<script src="./js/popper-1.12.9.min.js"></script>
	
	<script type="text/javascript">
	
		$(document).ready(function(){		
		
				
			flotant = new Jump.flotant();
			flotant.setFitAgainstRule(".jump-navbar"); // default
				
			flotant.initialize();
			
			
			
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
			
		});
	</script>
	
</head>
<body>

	<div class="jump-site">
	
		<div class="jump-navbar">
		
			<div class="jump-hamburguer p-lr10">
			
				<div id="jump-hamburguer">
					<span></span>
					<span></span>
					<span></span>
				</div>
			
			</div>
		
		</div>
	
	</div>
	
	<div class="jump-flotant-heightfill jump-flotant-nav col col-xs-12 col-sm-12-col-md-3 col-lg-3" data-visible="0" id="nav-main">
	
		<div class="jump-nav-default jump-nav-inner">
		
			<?php include("htmlnav.php"); ?>
		
		</div>
	
	</div>
	
	<div class="jump-flotant-heightfill jump-flotant-nav col col-xs-12 col-sm-12-col-md-3 col-lg-3" data-visible="0" id="nav-geovisores">
	
		<div class="jump-nav-default jump-nav-inner">
		
			<?php include("htmlnav.geovisores.php"); ?>
		
		</div>
	
	</div>
	
	<div class="jump-flotant-heightfill jump-flotant-nav col col-xs-12 col-sm-12-col-md-3 col-lg-3" data-visible="0" id="nav-vinculaciones-insterinstitucionales">
	
		<div class="jump-nav-default jump-nav-inner">
		
			<?php include("htmlnav.vinculaciones_insterinstitucionales.php"); ?>
		
		</div>
	
	</div>
	
	<div class="jump-flotant-heightfill jump-flotant-nav col col-xs-12 col-sm-12-col-md-3 col-lg-3" data-visible="0" id="nav-recursos-hidricos">
	
		<div class="jump-nav-default jump-nav-inner">
		
			<?php include("htmlnav.recursos_hidricos.php"); ?>
		
		</div>
	
	</div>

</body>
</html>