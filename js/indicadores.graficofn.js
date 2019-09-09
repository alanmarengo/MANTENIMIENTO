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
				text: config.subtitle
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


function draw_grafico_4(container,config) { // BUBBLE CHART
	
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
				minSize: '20%',
				maxSize: '100%',
				zMin: 0,
				zMax: 1000,
				layoutAlgorithm: {
					gravitationalConstant: 0.05,
					splitSeries: true,
					seriesInteraction: false,
					dragBetweenSeries: true,
					parentNodeLimit: true
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
		series:series
	});

}


function draw_grafico_5(container,config) { // BASIC COLUMNS
	
	var series = [];
	var labels = [];
	var arrInd = -1;
	var label = "";
	var data = [];
	
	for (var i=0; i<config.etiquetas.length; i++) {
		
		if (label != config.etiquetas[i]) {
			
			labels.push(config.etiquetas[i]);
			
			label = config.etiquetas[i];
		
		}
		
	}
	
	for (var i=0; i<config.etiquetas.length; i++) {
					
		var found = false;
				
		for (var j=0; j<series.length; j++) {
				
			if (series[j].name == config.data[i].name) {
					
				series[j].data.push(config.data[i].y);
				found = true;
						
			}
		
		}
			
		if (!found) {
				
			series.push({
				
				name:config.data[i].name,
				data:[config.data[i].y]
					
			});
				
		}
					
	}
	
	Highcharts.chart(container, {
		chart: {
			type: 'column'
		},
		title: {
			text: config.titulo
		},
		subtitle: {
			text: config.desc
		},
		xAxis: {
			categories: labels,
			crosshair: true
		},
		yAxis: {
			min: 0,
			title: {
				text: config.titulo
			}
		},
		tooltip: {
			headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
			pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
				'<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
			footerFormat: '</table>',
			shared: true,
			useHTML: true
		},
		plotOptions: {
			column: {
				pointPadding: 0.2,
				borderWidth: 0
			}
		},
		series:series
	});
}


function draw_grafico_6(container,config) { // FIXED PLACEMENT
	
	var series = [];
	var labels = [];
	var arrInd = -1;
	var label = "";
	var data = [];
	
	for (var i=0; i<config.etiquetas.length; i++) {
		
		if (label != config.etiquetas[i]) {
			
			labels.push(config.etiquetas[i]);
			
			label = config.etiquetas[i];
		
		}
		
	}
	
	for (var i=0; i<config.etiquetas.length; i++) {
					
		var found = false;
				
		for (var j=0; j<series.length; j++) {
				
			if (series[j].name == config.data[i].name) {
					
				series[j].data.push(config.data[i].y);
				found = true;
						
			}
		
		}
			
		if (!found) {
				
			series.push({
				
				name:config.data[i].name,
				data:[config.data[i].y],
				pointPadding: 0.3,
				pointPlacement: -0.2
					
			});
				
		}
					
	}
	
	Highcharts.chart(container, {
		chart: {
			type: 'column'
		},
		title: {
			text: config.titulo
		},
		xAxis: {
			categories: labels
		},
		yAxis: [{
			min: 0,
			title: {
				text: config.titulo
			}
		}, {
			title: {
				text: config.desc
			},
			opposite: true
		}],
		legend: {
			shadow: false
		},
		tooltip: {
			shared: true
		},
		plotOptions: {
			column: {
				grouping: false,
				shadow: false,
				borderWidth: 0
			}
		},
		series: series
	});
	
}

function draw_grafico_7(container,config) { // FIXED PLACEMENT
	
	var series = [];
	var labels = [];
	var arrInd = -1;
	var label = "";
	var data = [];
	
	for (var i=0; i<config.etiquetas.length; i++) {
		
		if (label != config.etiquetas[i]) {
			
			labels.push(config.etiquetas[i]);
			
			label = config.etiquetas[i];
		
		}
		
	}
	
	for (var i=0; i<config.etiquetas.length; i++) {
					
		var found = false;
				
		for (var j=0; j<series.length; j++) {
				
			if (series[j].name == config.data[i].name) {
					
				series[j].data.push(config.data[i].y);
				found = true;
						
			}
		
		}
			
		if (!found) {
				
			series.push({
				
				name:config.data[i].name,
				data:[config.data[i].y],
				pointPadding: 0.3,
				pointPlacement: -0.2
					
			});
				
		}
					
	}
	
	Highcharts.chart(container, {
		chart: {
			type: 'column'
		},
		title: {
			text: config.titulo
		},
		xAxis: {
			categories: config.etiquetas
		},
		yAxis: {
			min: 0,
			title: {
				text: config.desc
			}
		},
		tooltip: {
			pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
			shared: true
		},
		plotOptions: {
			column: {
				stacking: 'percent'
			}
		},
		series: config.data
	});
	
}

function draw_grafico_8(container,config) { // FIXED PLACEMENT
	
	/*var series = [];
	var labels = [];
	var arrInd = -1;
	var label = "";
	var data = [];
	
	for (var i=0; i<config.etiquetas.length; i++) {
		
		if (label != config.etiquetas[i]) {
			
			labels.push(config.etiquetas[i]);
			
			label = config.etiquetas[i];
		
		}
		
	}
	
	for (var i=0; i<config.etiquetas.length; i++) {
					
		var found = false;
				
		for (var j=0; j<series.length; j++) {
				
			if (series[j].name == config.data[i].name) {
					
				series[j].data.push(config.data[i].y);
				found = true;
						
			}
		
		}
			
		if (!found) {
				
			series.push({
				
				name:config.data[i].name,
				data:[config.data[i].y],
				pointPadding: 0.3,
				pointPlacement: -0.2
					
			});
				
		}
					
	}
	
	Highcharts.chart(container, {
        series: [{
            type: 'treemap',
            layoutAlgorithm: 'squarified',
            allowDrillToNode: true,
            animationLimit: 1000,
            dataLabels: {
                enabled: false
            },
            levelIsConstant: false,
            levels: [{
                level: 1,
                dataLabels: {
                    enabled: true
                },
                borderWidth: 3
            }],
            data: points
        }],
        subtitle: {
            text: 'Click points to drill down. Source: <a href="http://apps.who.int/gho/data/node.main.12?lang=en">WHO</a>.'
        },
        title: {
            text: 'Global Mortality Rate 2012, per 100 000 population'
        }
    });*/
	
}

function draw_grafico_9(container,config) { // BASIC LINE
	
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

		title: {
			text: config.titulo
		},

		subtitle: {
			text: config.desc
		},

		yAxis: {
			title: {
				text: config.titulo
			}
		},
		legend: {
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'middle'
		},

		plotOptions: {
			series: {
				label: {
					connectorAllowed: false
				},
				pointStart: 2010
			}
		},

		series: config.data
		
		,

		responsive: {
			rules: [{
				condition: {
					maxWidth: 500,
					minHeight:300
				},
				chartOptions: {
					legend: {
						layout: 'horizontal',
						align: 'center',
						verticalAlign: 'bottom'
					}
				}
			}]
		}

	});
		
	console.log(config.data);
	
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