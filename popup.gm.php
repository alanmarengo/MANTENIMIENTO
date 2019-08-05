<div class="popup-modal" id="popup-modal-gm"></div>
<div class="popup-stats" id="popup-stats-gm">

	<div class="row jump-row jus-right">

		<a href="#" onclick="$('#popup-modal-gm').hide(); $('#popup-stats-gm').hide();">
			<i class="fa fa-times"></i>
		</a>
	
	</div>

	<div class="row jump-row jus-between popup-stats-gm-row" id="popup-stats-gm-header">
		
		<h3>Mapear Variable</h3>
		<div class="icons">
			<a href="#" onclick="$('#popup-modal-gm').hide(); $('#popup-stats-gm').hide();">
				<i class="fa fa-print"></i>
			</a>
			<a href="#" onclick="$('#popup-modal-gm').hide(); $('#popup-stats-gm').hide();">
				<i class="fa fa-download"></i>
			</a>
		</div>
	
	</div>

	<div class="row jump-row popup-stats-gm-row">
		
		<hr>
		
		<div class="col col-md-4 col-lg-4">
			<span class="gm-highlight">Dataset:</span>
			<span class="gm-text">Nombre del Dataset</span>
		</div>
		
		<div class="col col-md-4 col-lg-4">
			<span class="gm-highlight">Agrupamiento:</span>
			<span class="gm-text">Nombre del Agrupamiento</span>
		</div>
		
		<div class="col col-md-4 col-lg-4">
			<span class="gm-highlight">Período:</span>
			<span class="gm-text">Desde 00/00/00 Hasta 00/00/00</span>
		</div>
	
	</div>

	<div class="row jump-row popup-stats-gm-row" style="top:30px;">
		
		<div class="col col-md-4 col-lg-4">
			
			<div class="row jump-row">
				<select class="selectpicker" id="gm-combo"></select>
			</div>
			<div class="row jump-row jump-posrel" style="top:30px;">
				<div class="mr-20">	
					<a href="#" class="button black-button" onclick="$('#popup-modal-gm').show(); $('#popup-stats-gm').show();">PROCESAR</a>
				</div>
			</div>
		</div>
		
		<div class="col col-md-8 col-lg-8">
			<div id="gm-stats-mediawrapper"></div>
		</div>
	
	</div>

</div>