<div class="popup" id="popup-busqueda">

	<div class="row popup-row popup-header">		
				
		<div class="col col-md-12 col-xs-12 popup-header">
		
			<div class="nav navbar-expand popup-nav">
			
				<ul class="navbar-nav">
					<li class="nav-item nav-item-button popup-header-li active">
						<a class="popup-header-button popup-header-button-toggleable popup-header-button-active" href="#" id="btn-popup-basic">
							<span>BÚSQUEDA</span>
						</a>
					</li>
					<li class="nav-item nav-item-button popup-header-li">
						<a class="popup-header-button popup-header-button-toggleable" href="#" id="btn-popup-advanced">
							<span>BÚSQUEDA AVANZADA</span>
						</a>
					</li>
				</ul>
				
			</div>
		
			<div class="nav navbar-expand popup-nav popup-nav-right">
			
				<ul class="navbar-nav">
					<li class="nav-item nav-item-button popup-header-li active">
						<a class="popup-header-button" href="#" onclick="$('#popup-busqueda').hide();">
							<span>IR AL MAPA</span>
						</a>
					</li>
				</ul>
				
			</div>
		
		</div>
	
	</div>

	<?php include("./geovisor.popup.basic.php"); ?>

</div>