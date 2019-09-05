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
				text: 'Nuclear weapon states'
			},
			labels: {
				formatter: function () {
					return this.value / 1000 + 'k';
				}
			}
		},
		tooltip: {
			pointFormat: '{series.name} had stockpiled <b>{point.y:,.0f}</b><br/>warheads in {point.x}'
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