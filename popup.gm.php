<div class="popup-modal" id="popup-modal-gm"></div>
<div class="popup-stats" id="popup-stats-gm" data-action="-1">

	<div class="row jump-row jus-left">

		<a href="#" onclick="$('#popup-modal-gm').hide(); $('#popup-stats-gm').hide();">
			<i class="fa fa-times"></i>
		</a>
	
	</div>

	<div class="row jump-row jus-between popup-stats-gm-row" id="popup-stats-gm-header">
		
		<h3 id="gm-title">Mapear Variable</h3>
		<div class="icons">
			<a href="#" onclick="stats.view.mapearImprimir();">
				<i class="fa fa-print"></i>
			</a>
			<a href="#" id="gm-mapear-download">
				<i class="fa fa-download"></i>
			</a>
		</div>
	
	</div>

	<div class="row jump-row popup-stats-gm-row">
		
		<hr>
		
		<div class="col col-md-4 col-lg-4">
			<span class="gm-highlight">Dataset: &nbsp;</span>
			<span class="gm-text" id="labelgm-dataset-name">Nombre del Dataset</span>
		</div>
		
		<div class="col col-md-4 col-lg-4">
			<span class="gm-highlight">Agrupamiento: &nbsp;</span>
			<span class="gm-text" id="labelgm-dataset-agroup">Nombre del Agrupamiento</span>
		</div>
		
		<div class="col col-md-4 col-lg-4">
			<span class="gm-highlight">Período: &nbsp;</span>
			<span class="gm-text" id="labelgm-dataset-period">Desde 00/00/00 Hasta 00/00/00</span>
		</div>
	
	</div>

	<div class="row jump-row popup-stats-gm-row" style="top:30px;">
		
		<div class="col col-md-4 col-lg-4" style="display:block; width:100%;" id="gm-combo-container">
			
			<div class="row jump-row" style="height:30px;">
				<select class="selectpicker" id="gm-combo"></select>
			</div>
			<div id="var-desc" style="display:none;">
				<div class="row jump-row">
					<div id="var-desc-inner">
					
					</div>
				</div>
			</div>
			<div class="row jump-row" id="graph-types" style="display:none;">
				<div id="graph-list">
					<div class="row jump-row">
						<div class="col col-md-3 ">
							<a href="#" onclick="stats.view.graficarTipo(1);">
								<img src="./images/graph-samples/01.jpg" height="80">
							</a>
						</div>
						<div class="col col-md-3 ">
							<a href="#" onclick="stats.view.graficarTipo(2);">
								<img src="./images/graph-samples/02.jpg" height="80">
							</a>
						</div>
						<div class="col col-md-3 ">
							<a href="#" onclick="stats.view.graficarTipo(3);">
								<img src="./images/graph-samples/03.jpg" height="80">
							</a>
						</div>
						<div class="col col-md-3 ">
							<a href="#" onclick="stats.view.graficarTipo(4);">
								<img src="./images/graph-samples/04.jpg" height="80">
							</a>
						</div>
					</div>
					<div class="row jump-row">
						<div class="col col-md-3 ">
							<a href="#" onclick="stats.view.graficarTipo(5);">
								<img src="./images/graph-samples/05.jpg" height="80">
							</a>
						</div>
						<div class="col col-md-3 ">
							<a href="#" onclick="stats.view.graficarTipo(6);">
								<img src="./images/graph-samples/06.jpg" height="80">
							</a>
						</div>
						<div class="col col-md-3 ">
							<a href="#" onclick="stats.view.graficarTipo(8);">
								<img src="./images/graph-samples/08.jpg" height="80">
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row jump-row jump-posrel" style="top:90px;">
				<div class="mr-20">	
					<a href="#" id="gm-graficar-process" class="button black-button" onclick="stats.view.processGM();">PROCESAR</a>
				</div>
			</div>
		</div>
		
		<div class="col col-md-8 col-lg-8">			
		
			<div id="gm-stats-mediawrapper"></div>
			<div class="mt-30 jus-right row jump-row" id="btn-ver-geovisor">
				<div style="width:200px; top:30px; position:relative;">
					<a href="#" class="black-button">VER EN GEOVISOR</a>
				</div>
			</div>
			
		</div>
	
	</div>

</div>