<div id="nav-panel" data-visible="1" class="navmenu jump-flotant-nav jump-flotant-heightfill jump-flotant-heightfill-top jump-scroll nav-level-1 col col-nav col-xs-12 col-sm-12 col-md-4 col-lg-4">
	
	<div class="jump-row">
	
		<div class="mtb-20 ml-auto mr-auto w-100-p" style="height: 34px; line-height: 34px; background-color:#29363c;">
			<a href="#" class="plr-10 jump-link-death" style="width: 34px; height: 34px; line-height: 34px;">
				<img src="./images/panel.icon.f1.png">
			</a>
			<input id="panel-seach-input" class="panel-input pl-10" name="main-search" readonly="readonly" type="text" value="Buscar Información" data-jump-placeholder="Buscar Información" placeholder="Buscar Información" 
				onfocus="geomap.map.ol_object_mini.updateSize(); geomap.map.ol_object_mini.render(); jwindow.open('#popup-geovisor');">							
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
			<input id="panel-seach-input-layers" class="panel-input pl-10" name="main-search" readonly="readonly" type="text" value="Buscar en las Capas" data-jump-placeholder="Buscar en las Capas" placeholder="Buscar en las Capas" 
				onfocus="geomap.map.ol_object_mini.updateSize(); geomap.map.ol_object_mini.render(); jwindow.open('#popup-geovisor');">							
		</div>
	
	</div>
	
</div>