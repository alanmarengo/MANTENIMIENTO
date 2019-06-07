// JavaScript Document

function PerfilTopografico(map,control_collection) {
	
	this.wkt     = new OpenLayers.Format.WKT();
	this.layer = null;
 
	this.vector = new OpenLayers.Layer.Vector("Vector Layer", 
	
		{ 
			"preFeatureInsert":function(feature) {			

				this.vector.removeAllFeatures();
				
				this.ClearScene();
				
			}.bind(this),
			"onFeatureInsert":function(feature)	{
				
				var style = {
							
					strokeColor : '#306062',
					strokeWidth : '3'
							
				}
						
				var WellKnowText = this.wkt.write(feature);
				var Selectlayers = '';
				
				feature.style = style;
				
				this.vector.redraw();
				
				//this.DeleteLayer();
				
                this.control.deactivate();//apago el control
				
				id("tools_ruler").deactive();
				
				this.CreateLayer(WellKnowText,this.vector,this.wkt);

		}.bind(this)
	
	});
	
	var pointsLayer = new OpenLayers.Layer.Vector("Points Layer Topografico");
	
	this.controlPoly = new OpenLayers.Control.DrawFeature( this.vector, OpenLayers.Handler.Path);
	
	var polyControl = this.controlPoly;
	
	map.addLayer(this.vector);
	map.addLayer(pointsLayer);
	map.addControl(this.controlPoly);
	
	this.CreateLayer = function(wkt,vector,wkt_o) {	
	
		pointsLayer.removeAllFeatures();
		
		var opf = new OpenLayers.Format.WKT();
		var newf = opf.read(wkt).geometry.transform(map.displayProjection,new OpenLayers.Projection("EPSG:4326"));
		
		var newWkt = new String(newf);
		
		$.getJSON('./get_mde.php?wkt='+newWkt, function (data) {
			
			$("#perfil_topografico_min_max").html("<p>Altura Máxima: "+data.max+" Mts.</p><p>Altura Mínima: "+data.min + " Mts.")
			
			vector.points = data.points;
			
			$("#perfil_topografico").css("display","block");
			
			$("#perfil_topografico_chart").highcharts({
				chart: {
					zoomType: 'x',
					height: '230',
					width: '512'
				},
				title: {
					text: 'Perfil Topográfico',
					style: {
						
						fontSize:"15px"
						
					}
				},
				subtitle: {
					text: 'Distancia Total: ' + data.distancia_total + "Km."
				},
				xAxis: {
					type: 'distancia'
				},
				yAxis: {
					type: 'altura',
					title: {
						text: 'Altura'
					}
				},
				legend: {
					enabled: false
				},
				plotOptions: {
					area: {
						fillColor: {
							linearGradient: {
								x1: 0,
								y1: 0,
								x2: 0,
								y2: 1
							},
							stops: [
								[0, Highcharts.getOptions().colors[0]],
								[1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
							]
						},
						marker: {
							radius: 2
						},
						lineWidth: 1,
						states: {
							hover: {
								lineWidth: 1
							}
						},
						threshold: null
					}
				},

				series: [{
					type: 'area',
					name: 'Altura',
					data: data.data,
					point:{
						
						events:{
							
							mouseOver:function(event) {
								
								pointsLayer.removeAllFeatures();
								
								var pointGeom = OpenLayers.Geometry.fromWKT(vector.points[this.index]).transform(new OpenLayers.Projection("EPSG:4326"),new OpenLayers.Projection("EPSG:3857"));
								var pointFeature = new OpenLayers.Feature.Vector(pointGeom,null, {
										fillColor: '#2b8c8b',
										type: '10',
										strokeColor: '#306062',
										strokeWidth: 2,
										pointRadius: 7
									}
								);
								
								pointsLayer.addFeatures([pointFeature]);
								map.addLayer(pointsLayer);
								
								
							},
							mouseOut:function() {
								
								pointsLayer.removeAllFeatures();
								
							}
							
						}
						
					}
				}]
			});
		});
		
		Highcharts.theme = {
		   colors: ['#2b908f', '#90ee7e', '#f45b5b', '#7798BF', '#aaeeee', '#ff0066', '#eeaaee',
			  '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
		   chart: {
			  backgroundColor: {
				 linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
				 stops: [
					[0, '#2a2a2b'],
					[1, '#3e3e40']
				 ]
			  },
			  style: {
				 fontFamily: '\'Unica One\', sans-serif'
			  },
			  plotBorderColor: '#606063'
		   },
		   title: {
			  style: {
				 color: '#E0E0E3',
				 textTransform: 'uppercase',
				 fontSize: '20px'
			  }
		   },
		   subtitle: {
			  style: {
				 color: '#E0E0E3',
				 textTransform: 'uppercase'
			  }
		   },
		   xAxis: {
			  gridLineColor: '#707073',
			  labels: {
				 style: {
					color: '#E0E0E3'
				 }
			  },
			  lineColor: '#707073',
			  minorGridLineColor: '#505053',
			  tickColor: '#707073',
			  title: {
				 style: {
					color: '#A0A0A3'

				 }
			  }
		   },
		   yAxis: {
			  gridLineColor: '#707073',
			  labels: {
				 style: {
					color: '#E0E0E3'
				 }
			  },
			  lineColor: '#707073',
			  minorGridLineColor: '#505053',
			  tickColor: '#707073',
			  tickWidth: 1,
			  title: {
				 style: {
					color: '#A0A0A3'
				 }
			  }
		   },
		   tooltip: {
			  backgroundColor: 'rgba(0, 0, 0, 0.85)',
			  style: {
				 color: '#F0F0F0'
			  }
		   },
		   plotOptions: {
			  series: {
				 dataLabels: {
					color: '#B0B0B3'
				 },
				 marker: {
					lineColor: '#333'
				 }
			  },
			  boxplot: {
				 fillColor: '#505053'
			  },
			  candlestick: {
				 lineColor: 'white'
			  },
			  errorbar: {
				 color: 'white'
			  }
		   },
		   legend: {
			  itemStyle: {
				 color: '#E0E0E3'
			  },
			  itemHoverStyle: {
				 color: '#FFF'
			  },
			  itemHiddenStyle: {
				 color: '#606063'
			  }
		   },
		   credits: {
			  style: {
				 color: '#666'
			  }
		   },
		   labels: {
			  style: {
				 color: '#707073'
			  }
		   },

		   drilldown: {
			  activeAxisLabelStyle: {
				 color: '#F0F0F3'
			  },
			  activeDataLabelStyle: {
				 color: '#F0F0F3'
			  }
		   },

		   navigation: {
			  buttonOptions: {
				 symbolStroke: '#DDDDDD',
				 theme: {
					fill: '#505053'
				 }
			  }
		   },

		   // scroll charts
		   rangeSelector: {
			  buttonTheme: {
				 fill: '#505053',
				 stroke: '#000000',
				 style: {
					color: '#CCC'
				 },
				 states: {
					hover: {
					   fill: '#707073',
					   stroke: '#000000',
					   style: {
						  color: 'white'
					   }
					},
					select: {
					   fill: '#000003',
					   stroke: '#000000',
					   style: {
						  color: 'white'
					   }
					}
				 }
			  },
			  inputBoxBorderColor: '#505053',
			  inputStyle: {
				 backgroundColor: '#333',
				 color: 'silver'
			  },
			  labelStyle: {
				 color: 'silver'
			  }
		   },

		   navigator: {
			  handles: {
				 backgroundColor: '#666',
				 borderColor: '#AAA'
			  },
			  outlineColor: '#CCC',
			  maskFill: 'rgba(255,255,255,0.1)',
			  series: {
				 color: '#7798BF',
				 lineColor: '#A6C7ED'
			  },
			  xAxis: {
				 gridLineColor: '#505053'
			  }
		   },

		   scrollbar: {
			  barBackgroundColor: '#808083',
			  barBorderColor: '#808083',
			  buttonArrowColor: '#CCC',
			  buttonBackgroundColor: '#606063',
			  buttonBorderColor: '#606063',
			  rifleColor: '#FFF',
			  trackBackgroundColor: '#404043',
			  trackBorderColor: '#404043'
		   },

		   // special colors for some of the
		   legendBackgroundColor: 'rgba(0, 0, 0, 0.5)',
		   background2: '#505053',
		   dataLabelsColor: '#B0B0B3',
		   textColor: '#C0C0C0',
		   contrastTextColor: '#F0F0F3',
		   maskColor: 'rgba(255,255,255,0.3)'
		};

		// Apply the theme
		Highcharts.setOptions(Highcharts.theme);
		
		$("#close_ptop").on("click",function() {
			
			$("#perfil_topografico").css("display","none");
			vector.removeAllFeatures();
			pointsLayer.removeAllFeatures();		
			
		});
		
		/*$(".highcharts-menu").append(
			$("div")
				.attr("style","cursor: pointer; padding: 0.5em 1em; background: transparent none repeat scroll 0% 0%; color: rgb(51, 51, 51); font-size: 11px; transition: background 250ms ease 0s, color 250ms ease 0s;")
				.addClass("highcharts-menu-item")
				.html("Cerrar")
		)*/
	
	}
	
	this.control = new OpenLayers.Control({
	
		autoActivate:false,

			activate:function() {
				ol_map.controls.mouse_defaults.deactivate();
				ol_map.controls.popup.deactivate();	
				ol_map.controls.deactivate_all();
				polyControl.activate();
				ol_map.div.style.cursor = 'crosshair';
			},
			
			deactivate:function() {		
				ol_map.controls.mouse_defaults.activate();
				ol_map.controls.popup.activate();		
				polyControl.deactivate();
				ol_map.div.style.cursor = 'default';
			}
		
	});
	
	this.control.parent = this;
	this.control.vector = this.vector;
	
	this.DeleteLayer = function() {
	
		if (this.layer != null) {
					
			this.layer.setVisibility(false);
			ol_map.map.removeLayer(this.layer);
			this.layer.destroy();
					
		}
		
	}
	
	this.SetMirrorControl = function(control) {
	
		this.mirror = control;
		
	}
	
	this.ClearScene = function() {	
			
		//this.vector.removeAllFeatures();
		//this.DeleteLayer();
		this.vector.removeAllFeatures();
		//this.mirror.parent.DeleteLayer();
		
	}
	
	return this.control;
	
}