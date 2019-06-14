<div class="p30 text-center">
	
	<div class="button-input-group" style="height: 34px; line-height: 34px;">
		<a href="#" class="button button-input jump-link-death" style="width: 34px; height: 34px; line-height: 34px;">
			<i class="fa fa-search"></i>
		</a>
		<input id="panel-seach-input" class="jump-input jump-input pl-10" name="main-search" readonly="readonly" type="text" value="Buscar Información" data-jump-placeholder="Buscar Información" placeholder="Buscar Información" onfocus="jwindow.open('#popup-geovisor');">							
	</div>

</div>

<div id="layers-wrapper">

	<div id="abr-container">
	
		<?php DrawAbr(); ?>
	
	</div>
	
	<div id="layers-container">
	
		<?php DrawContainers(); ?>
	
	</div>

</div>