<link rel="stylesheet" type="text/css" href="./css/page_template.css" />

<!--<div id="page_proyecto" class="page page_template h100p">-->
    <div class="row h100p">
                
        <!---------------------------------------------->
        <div class="col col-xs-11 col-sm-11 col-md-4 col-lg-4 section-b h100p p0">     
		
            <div style="border: solid 1px #666; margin: 0; height:100%; width: 100%;">
				
				<div class="col col-xs-12 col-sm-12 col-md-12 col-lg-12" style="position:relative; z-index:999; text-align: left; padding: 0px; height:0px;">
                    <div class="jump-window-body p20">
        
                        <div id="info-baselayers" class="jump-scrollble">
                    
                            <div class="pretty p-default p-round" style="font-size:20px;">
                                <input type="radio" name="radio-baselayers" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.openstreets);">
                                <div class="state">
                                    <label>Openstreets Maps</label>
                                </div>
                            </div>
                            
                            <br>
                        
                            <div class="pretty p-default p-round" style="font-size:20px;">
                                <input type="radio" name="radio-baselayers" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.opentopo);">
                                <div class="state">
                                    <label>Open Topo</label>
                                </div>
                            </div>
                            
                            <br>
                        
                            <div class="pretty p-default p-round" style="font-size:20px;">
                                <input type="radio" name="radio-baselayers" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.bing_roads);">
                                <div class="state">
                                    <label>Bing Caminos</label>
                                </div>
                            </div>
                            
                            <br>
                        
                            <div class="pretty p-default p-round" style="font-size:20px;">
                                <input type="radio" name="radio-baselayers" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.bing_aerials);">
                                <div class="state">
                                    <label>Bing Satelital</label>
                                </div>
                            </div>
                            
                            <br>
                        
                            <div class="pretty p-default p-round" style="font-size:20px;">
                                <input type="radio" name="radio-baselayers" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.argenmap);">
                                <div class="state">
                                    <label>Argenmap</label>
                                </div>
                            </div>
                            
                            <br>
                        
                            <div class="pretty p-default p-round" style="font-size:20px;">
                                <input type="radio" checked="checked" name="radio-baselayers" id="baselayer-default-radio" onclick="geomap.map.setBaseLayer(geomap.map.baselayers.google);">
                                <div class="state">
                                    <label>Google Maps</label>
                                </div>
                            </div>
                            
                            <br>
                        
                        </div>
                        
                    </div>
                    <div id="uxCapa" class="jump-scroll">
                        <!--<option value="">ESCALA DE PECES</option>-->
                    </div>
                </div>

                <div id="map">
				
				
					
                </div>

            </div>
			
        </div>
		
    </div>
<!--</div>-->

<div style="width:200px; bottom:15px; left:10px; font-weight:bolder;" class="jump-posabs">
			
	<a href="./geovisor.php?geovisor=2" target="_blank" class="black-button">
		<span>VER EN GEOVISOR</span>
	</a>

</div>
