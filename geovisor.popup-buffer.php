<div class="popup popup-dark" id="popup-buffer">

	<div class="row popup-row popup-header">		
				
		<div class="col col-md-12 col-xs-12 popup-header">
		
			<div class="nav navbar-expand popup-nav popup-nav-right">
			
				<ul class="navbar-nav">
					<li class="nav-item nav-item-button popup-header-li active">
						<a class="popup-header-button" href="#" onclick="$('#popup-buffer').hide(); geomap.map.ol_object.removeInteraction(geomap.map.bufferdraw); geomap.map.buffer.layerVector.getSource().clear();">
							<span>X</span>
						</a>
					</li>
				</ul>
				
			</div>
		
		</div>
	
	</div>

	<?php include("./geovisor.popup-buffer-basic.php"); ?>

</div>