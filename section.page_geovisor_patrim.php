<link rel="stylesheet" type="text/css" href="./css/page_template.css" />

<div class="row h100p">
			
	<!---------------------------------------------->
	<div class="col-md-8 col-lg-8 section-b h100p p0">
		
		<div class="buttons">
		
			<a href="javascript:void(0);" id="btn-com-1" class="btn-com black-button" style="font-weight:700;">
				<span>PALEONTOLOGÍA</span>
			</a>
		
			<a href="javascript:void(0);" id="btn-com-2" class="btn-com black-button" style="font-weight:700;">
				<span>ARQUEOLOGÍA</span>
			</a>
		
			<a href="javascript:void(0);" id="btn-com-3" class="btn-com black-button" style="font-weight:700;">
				<span>RESCATE GEOLÓGICO</span>
			</a>
		
		</div>
		
		<div id="map" style="cursor:pointer;">
		
		
			
		</div>
	
		<?php include("./html.navbar-geovisor-zoom.php"); ?>
		<?php include("./popup.baselayers.flotant2.php"); ?>
		
	</div>
	
	<div class="col-md-4 col-lg-4 section-b h100p jump-scroll jump-posrel p0" id="prog-wrapper" style="background:white; overflow:auto !important;">

		<div id="map-details" style="padding:20px;">

			
			
		</div>
		
	</div>
	
</div>
			
<div style="width:200px; bottom:15px; left:10px; font-weight:bolder;" class="jump-posabs">
			
	<a href="./geovisor.php?geovisor=32" target="_blank" class="black-button">
		<span>VER EN GEOVISOR</span>
	</a>

</div>