<div id="nav-panel" data-visible="1" class="navmenu jump-flotant-nav jump-flotant-heightfill jump-flotant-heightfill-top jump-scroll nav-level-1 col col-nav col-xs-12 col-sm-12 col-md-4 col-lg-4">
	
	<div id="nav-panel-inner" data-visible="1">	
		
		<div id="nav-panel-arrow">
		
			<a href="#" onclick="flotant.toggle('#nav-panel-inner')" class="jump-toggleimage" data-state="1" data-ini-src="./images/panel.icon.arrow.0.png" data-end-src="./images/panel.icon.arrow.1.png">
			
				<img src="./images/panel.icon.arrow.1.png">
			
			</a>
		
		</div>
	
		<div class="jump-row">
		
			<div class="mtb-20 ml-auto mr-auto w-100-p" style="height: 34px; line-height: 34px; background-color:#29363c;">
				<a href="#" class="plr-10 jump-link-death" style="width: 34px; height: 34px; line-height: 34px;">
					<img src="./images/panel.icon.f1.png">
				</a>
				<input id="panel-seach-input" class="panel-input pl-10" name="main-search" readonly="readonly" type="text" value="Agregar Información al Mapa" data-jump-placeholder="Agregar Información al Mapa" placeholder="Agregar Información al Mapa" 
					onfocus="geomap.map.ol_object_mini.updateSize(); geomap.map.ol_object_mini.render(); jwindow.open('popup-geovisor');">							
			</div>
		
		</div>
		
		<div class="jump-row">
		
			<div id="layers-wrapper">

				<div id="abr-container">
				
					<?php DrawAbr(); ?>
				
				</div>
				
				<div id="layers-container">
				
					<?php DrawContainers(); ?>
				
				</div>

			</div>
		
		</div>
		
		<div class="jump-row">
		
			<div class="mtb-20 ml-auto mr-auto w-100-p" style="height: 34px; line-height: 34px; background-color:#29363c;">
				<a href="#" class="plr-10 jump-link-death" style="width: 34px; height: 34px; line-height: 34px;">
					<img src="./images/panel.icon.f2.png">
				</a>
				<input id="panel-seach-input-layers-bottom" class="panel-input pl-10" name="main-search" type="text" data-jump-placeholder="Buscar en las Capas" placeholder="Buscar en las Capas" 
					onfocus="geomap.map.ol_object_mini.updateSize(); geomap.map.ol_object_mini.render(); jwindow.open('#popup-geovisor');">
				<span class="layers-visible-count jump-posrel l--30"></span>
			</div>
		
		</div>
			
		<div id="panel-busqueda-geovisor">
			
			<div class="row jump-row jus-right">
				<a href="#" onclick="$('#panel-busqueda-geovisor').hide();" class="panel-close">
					<i class="fa fa-times"></i>
				</a>
			</div>
			<div class="panel-header"></div>
			<div class="panel-body jump-flotant-height-transform jump-scroll"></div>
			
		</div>
	
	</div>
	
</div>