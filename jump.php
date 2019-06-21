<!DOCTYPE html>
<html lang="es">
<head>

	<title>Inicio</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" type="text/css" href="./css/navbar.main.css">
	<link rel="stylesheet" type="text/css" href="./css/navbar.tools.css">
	<link rel="stylesheet" type="text/css" href="./css/hamburguer.css">
	<link rel="stylesheet" type="text/css" href="./css/flexbox.css">
	<link rel="stylesheet" type="text/css" href="./css/jump.spacers.css">
	
	<?php include("./scripts.default.php"); ?>
	
	<script type="text/javascript">
	
		$(document).ready(function() {
			
			flotant = new Jump.flotant();
			
			nav = new Jump.nav();
			nav.hamburguer.addBehavior(function() {
				
				var addBackOptionSize = $(".jump-sublevel-backoption:visible").length;
				
				if (addBackOptionSize > 0) {
					
					$(".jump-sublevel-backoption:visible a").trigger("click");
					
				}else{
				
					$("#hamburguer").toggleClass('open');
					//flotant.toggle('#nav-main',false);
				
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
				
			});
			
		});
	
	</script>
	
</head>
<body>

	<div class="site">
	
		<?php include("./html.navbar-main.php"); ?>
		<?php include("./html.navbar-tools.php"); ?>
		
	</div>

</body>
</html>