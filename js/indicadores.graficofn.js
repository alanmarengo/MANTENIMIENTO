function draw_grafico_1(container,config) {
	
	Highcharts.chart(container, {
		chart: {
			type: 'area'
		},
		accessibility: {
			description: config.desc
		},
		title: {
			text: config.titulo
		},
		subtitle: {
			text: config.desc
		},
		xAxis: {
			allowDecimals: false,
			labels: {
				formatter: function () {
					return this.value; // clean, unformatted number for year
				}
			}
		},
		yAxis: {
			title: {
				text: config.titulo
			},
			labels: {
				formatter: function () {
					return this.value / 1000 + 'k';
				}
			}
		},
		tooltip: {
			pointFormat: '{series.name} series por puntos <b>{point.y:,.0f}</b><br/>estadisticas en {point.x}'
		},
		plotOptions: {
			area: {
				pointStart: 1940,
				marker: {
					enabled: false,
					symbol: 'circle',
					radius: 2,
					states: {
						hover: {
							enabled: true
						}
					}
				}
			}
		},
		series:config.data
	});
	
} //  BASIC AREA

function draw_grafico_2(container,config) {
	
	Highcharts.chart(container, {
		chart: {
			type: 'bar'
		},
		title: {
			text: config.title
		},
		xAxis: {
			categories: config.etiquetas
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Total fruit consumption'
			}
		},
		legend: {
			reversed: true
		},
		plotOptions: {
			series: {
				stacking: 'normal'
			}
		},
		series: config.data
	});
	
} 


function draw_grafico_3(container,config) { // BUBBLE CHART
	
	var series = [];
	var arrInd = -1;
	var label = "";
	var data = [];
	
	for (var i=0; i<config.etiquetas.length; i++) {
		
		if (label != config.etiquetas[i]) {
			
			arrInd++;
			
			series.push({
				
				name:config.etiquetas[i]
				
			});
			
			data[arrInd] = [];			
			
			label = config.etiquetas[i];
			
		}
			
		data[arrInd].push({
			
			name:config.data[i].name,
			value:config.data[i].y
			
		});
		
	}
	
	for (var i=0; i<series.length; i++) {
		
		series[i].data = data[i];
		
	}
	
	Highcharts.chart(container, {
		chart: {
			type: 'packedbubble',
			height: '100%'
		},
		title: {
			text: config.title
		},
		tooltip: {
			useHTML: true,
			pointFormat: '<b>{point.name}:</b> {point.value}m CO<sub>2</sub>'
		},
		plotOptions: {
			packedbubble: {
				minSize: '30%',
				maxSize: '120%',
				zMin: 0,
				zMax: 1000,
				layoutAlgorithm: {
					splitSeries: false,
					gravitationalConstant: 0.02
				},
				dataLabels: {
					enabled: true,
					format: '{point.name}',
					filter: {
						property: 'y',
						operator: '>',
						value: 250
					},
					style: {
						color: 'black',
						textOutline: 'none',
						fontWeight: 'normal'
					}
				}
			}
		},
		series: series
	});


}

function draw_grafico_11(container,config) { // PIE WITH DRILLDOWN
	
	Highcharts.chart(container, {
		chart: {
			type: 'pie'
		},
		title: {
			text: config.titulo
		},
		subtitle: {
			text: config.desc
		},
		plotOptions: {
			series: {
				dataLabels: {
					enabled: true,
					format: '{point.name}: {point.y:.1f}%'
				}
			}
		},

		tooltip: {
			headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
			pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
		},

		series:[{
            name: config.titulo,
            colorByPoint: true,
			data:config.data
		}]
	});

}