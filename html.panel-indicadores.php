<div id="nav-panel" data-visible="1" class="jump-flotant-heightfill nav-level-1 col col-nav col-xs-12 col-sm-12  col-md-3 col-lg-3">
	
	<div id="nav-panel-inner" data-visible="1" style="width:95%;">	
		
		<div id="nav-panel-arrow">
		
			<a href="#" onclick="flotant.toggle('#nav-panel-inner')" class="jump-toggleimage" data-state="1" data-ini-src="./images/panel.icon.arrow.0.png" data-end-src="./images/panel.icon.arrow.1.png">
			
				<img src="./images/panel.icon.arrow.1.png">
			
			</a>
		
		</div>
		
		<div class="jump-row">
		
			<div class="mtb-20 ml-auto mr-auto w-100-p search-wrapper">
				<a href="#" class="plr-10 jump-link-death" style="width: 34px; height: 34px; line-height: 34px;">
					<img src="./images/panel.icon.f2.png">
				</a>
				<input id="panel-seach-input-layers" class="panel-input pl-10" name="main-search" type="text" data-jump-placeholder="BUSCAR" placeholder="BUSCAR" 
					onfocus="">
				<span class="layers-visible-count jump-posrel l--30"></span>
			</div>
		
		</div>
		
		<div class="jump-row">
		
			<div id="layers-wrapper">

				<div id="abr-container">
				
					<?php DrawAbrInd(); ?>
				
				</div>
				
				<div id="layers-container" class="jump-scroll">
				
					<?php DrawContainersInd(); ?>
				
				</div>

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