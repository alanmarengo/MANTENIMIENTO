<div id="navbar-tools" class="jump-navbar">

	<div class="row jump-row default-row">
		
		<div class="col col-xs-12 col-sm-12 col-md-4 col-lg-4 ml-10 flexbox col-title">
				
			<h3>Geovisor General de IEASA</h3>
		
		</div>
		
		<div class="col col-xs-12 col-sm-12 col-md-4 col-lg-4 mr-15 flexbox col-tools">
				
			<ul>
				<li>
					<a class="button" href="javascript:void(0);" onclick="jwindow.close('.geovisor-flotant'); geomap.map.buffer();">
						<img src="./images/toolbar.icon.buffer.png">
					</a>							
				</li>
				<li>
					<a class="button" href="javascript:void(0);" onclick="jwindow.close('.geovisor-flotant'); geomap.map.ptopografico();">
						<img src="./images/toolbar.icon.ptopografico.png">
					</a>        
				</li>
				<li>
					<a class="button" href="javascript:void(0);" onclick="jwindow.close('.geovisor-flotant'); geomap.map.medicion();">
						<img src="./images/toolbar.icon.medicion.png">
					</a>
				</li>
				<li>
					<a class="button" href="javascript:void(0);" onclick="jwindow.close('.geovisor-flotant'); jwindow.open('#popup-coordinates'); geomap.map.activateCoordinates();">
						<img src="./images/toolbar.icon.coordenadas.png">
					</a>
				</li>
				<li class="dropdown">
					<a class="button" href="javascript:void(0);" id="navbarDropdown-draw" role="button" data-toggle="dropdown" aria-expanded="false">
						<img src="./images/toolbar.icon.dibujo.png">
					</a>
					<div class="dropdown-menu dropdown-menu-right" id="dropdown-draw" aria-labelledby="navbarDropdown-draw" style="min-width:30px !Important; width:30px;">						
					
						<a href="#" onclick="">			
							<img src="./images/geovisor/icons/drawing-bar-point.png">						
						</a>
						<a href="#" onclick="">			
							<img src="./images/geovisor/icons/drawing-bar-line.png">						
						</a>
						<a href="#" onclick="">			
							<img src="./images/geovisor/icons/drawing-bar-polygon.png">						
						</a>
						<a href="#" onclick="">			
							<img src="./images/geovisor/icons/drawing-bar-circle.png">						
						</a>
						
					</div> 
				</li>
				<li>
					<a class="button" href="javascript:void(0);" onclick="geomap.map.print();">
						<img src="./images/toolbar.icon.print.png">
					</a>
				</li>
				<li class="ml-10">
					<a class="button" href="javascript:void(0);" onclick="jwindow.close('.geovisor-flotant'); jwindow.open('#popup-share'); geomap.map.share();">
						<img src="./images/toolbar.icon.share.png">
					</a>
				</li>
				
			</ul>
		
		</div>

	</div>
	
	<div class="row jump-row responsive-row">
	
	</div>

</div>