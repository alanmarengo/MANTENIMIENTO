<!DOCTYPE html>
<html lang="es">
<head>

	<title>JUMP</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php include("./scripts.default.php"); ?>
	
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
			jwindow.initialize();
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
			
		});
		
	</script>
	
</head>
<body>

	<div class="jump-site">
	
		<div class="jump-navbar" id="jump-navbar-main">
		
			<div class="row jump-row">
		
				<div class="col col-xs-2 col-sm-2 col-md-1 col-lg-1 jump-hamburguer-col">
			
					<div class="jump-hamburguer plr-10">
					
						<div id="jump-hamburguer">
							<span></span>
							<span></span>
							<span></span>
						</div>
					
					</div>
					
				</div>
				
				<div class="col col-xs-10 col-sm-10 col-md-3 col-lg-3" id="brand-logo">
					
					<div class="jump-block">
					
						<div class="jump-block-inner">
						
							<img src="./images/logo_observatorio_ieasa.png" height="20">
						
						</div>
					
					</div>
				
				</div>
				
				<div class="col col-xs-12 col-sm-12 col-md-8 col-lg-8 text-right">
				
					<div class="jump-block">
					
						<div class="jump-block-inner-toolbar">
						
							<ul>
								<li class="button-input-group">
									<a href="#" class="button button-input">
										<i class="fa fa-search"></i>
									</a>
									<input id="main-search" class="jump-input jump-input-bl pl-10" name="main-search" type="text" data-jump-placeholder="Buscar en todo el sitio" placeholder="Buscar en todo el sitio">							
								</li>
								<li>
									<a href="#" class="button">
										<i class="fa fa-question-circle"></i>
									</a>
								</li>
								<li>
									<a href="#" class="button">
										<i class="fa fa-user"></i>
									</a>
								</li>
							
							</ul>
						
						</div>
					
					</div>
				
				</div>
			
			</div>
		
		</div>
		
		<div class="jump-container jump-flotant-heightfill-top jump-posabs">
		
			<?php include("./html.site.php"); ?>
			<?php include("./html.site.footer.php"); ?>
		
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
	
	<?php //include("./popup.baselayers.php"); ?>

</body>
</html>