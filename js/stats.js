function ol_stats() {

	this.panel = {};
	this.panel.div = document.getElementById("nav-panel");
	
	this.view = {};
	this.dataset = {};
	
	this.panel.start = function() {
		
		$(".panel-abr").on("click",function() {
			
			if (this.getAttribute("data-active") == 0) {
					
				$(".panel-abr").attr("data-active","0");
				$(".panel-abr").css("border-color","transparent");
				$(".panel-abr").css("background-color","transparent");
					
				$(this).attr("data-active","1");
				$(this).css("border-color",this.getAttribute("data-color"));
				$(this).css("background-color",this.getAttribute("data-bgcolor"));
					
				$(".layer-container").not(".layer-container[data-cid="+this.getAttribute("data-cid")+"]").hide();
				$(".layer-container[data-cid="+this.getAttribute("data-cid")+"]").show();
				//$("#abr-container").first(".panel-abr").prepend(this);			
				scroll.refresh();
					
			}
			
		});
	
	}
	
	this.view.start = function() {	
	
		$("#update-view").attr("disabled","disabled");
		
		$("#update-view").on("click",function() {
			
			$("#update-view").attr("disabled","disabled");
			
			var currentPage = 1;
			
			if ($(".page-active").length > 0) {
			
				currentPage = $(".page-active").attr("data-page");
			
			}
			
			this.getTable(currentPage,false,false,false);
			
		}.bind(this));	
		
		this.resetSelects();
		
	}
	
	this.view.resetSelects = function() {
		
		$('select.operation-combo').val(-1);
		$('.selectpicker').selectpicker('refresh')
		
		$("select.operation-combo").each(function(i,v) {			
			
			if ($(v).next(".dropdown-toggle").find(".filter-option-inner-inner").prev().length == 0) {
			
				$(v).next(".dropdown-toggle").find(".filter-option-inner-inner").before($("<i></i>").attr("class","fa fa-question-circle").css("color","red"));
			
			}
			
			$(v).on("changed.bs.select",function(e, clickedIndex, newValue, oldValue) {
					
				if (clickedIndex == 0) {
						
					$(this).next(".dropdown-toggle").find(".filter-option-inner-inner").prev("i").attr("class","fa fa-question-circle").css("color","red");					
					$(this).next(".dropdown-toggle").find(".filter-option-inner-inner").css({"color":"red"});
					
				}else{
						
					$(this).next(".dropdown-toggle").find(".filter-option-inner-inner").prev("i").attr("class","fa fa-check-circle").css("color","green");
					$(this).next(".dropdown-toggle").find(".filter-option-inner-inner").css({"color":"green"});
					
				}
		
				$("#update-view").prop("disabled",false);
				
			});
			
		});
		
		$("select.filter-combo").each(function(i,v) {	
			
			$(v).on("changed.bs.select",function(e, clickedIndex, newValue, oldValue) {
			
				$("#update-view").prop("disabled",false);
			
			});
			
		});
		
		
		$("#group-combo-view").on("changed.bs.select",function(e, clickedIndex, newValue, oldValue) {
			
			$("#update-view").prop("disabled",false);
			
			this.updateAgroupColModals();
			
		}.bind(this));
		
	}
	
	this.view.updateAgroupColModals = function() {
		
		var index = $('option:selected', $("#group-combo-view")).attr("data-col-index");
		var val = $("#group-combo-view").val();
		
		$(".dataset-cell-modal").remove();
		
		if (index != undefined) {
			
			for (var i=0; i<3; i++) {
				
				if (i!=index) {
					
					$(".dataset-cell[data-col-index="+i+"]").append($("<div></div>").attr("class","dataset-cell-modal"));
					
				}else{
					
					$(".dataset-cell[data-col-index="+i+"]").each(function(i,v) {
						
						var className = $(v).parent().attr("class");
						
						if (className == "dataset-row dataset-row-header dataset-operation-row") {
							
							$(v).append($("<div></div>").attr("class","dataset-cell-modal"));
							
						}
					
					});
					
				}
				
			}
			
			$("#group-combo-view").attr("data-group-by-column","1");
			$("#group-combo-view").attr("data-group-column-index",index);
			$("#group-combo-view").attr("data-group-column-val",val);				
		
		}else{
			
			$("#group-combo-view").attr("data-group-by-column","0");
			$("#group-combo-view").attr("data-group-column-index","-1");
			$("#group-combo-view").attr("data-group-column-val","-1");		
			
		}
		
		if ((val == 2) || (val == 3)) {
			
			$(".dataset-operation-row .dataset-cell").append($("<div></div>").attr("class","dataset-cell-modal"));
			
		}
		
		$(".dataset-operation-row .dataset-cell[data-col-index=0]").find(".selectpicker").first().val("-1");
		$(".dataset-operation-row .dataset-cell[data-col-index=0]").find(".selectpicker").first().selectpicker("refresh");
		$(".dataset-operation-row .dataset-cell[data-col-index=0]").find(".selectpicker").next(".dropdown-toggle").find(".filter-option-inner-inner").prev("i").attr("class","fa fa-question-circle").css("color","red");					
		$(".dataset-operation-row .dataset-cell[data-col-index=0]").find(".selectpicker").next(".dropdown-toggle").find(".filter-option-inner-inner").css({"color":"red"});
		$(".dataset-operation-row .dataset-cell[data-col-index=1]").find(".selectpicker").first().val("-1");
		$(".dataset-operation-row .dataset-cell[data-col-index=1]").find(".selectpicker").first().selectpicker("refresh");
		$(".dataset-operation-row .dataset-cell[data-col-index=1]").find(".selectpicker").next(".dropdown-toggle").find(".filter-option-inner-inner").prev("i").attr("class","fa fa-question-circle").css("color","red");					
		$(".dataset-operation-row .dataset-cell[data-col-index=1]").find(".selectpicker").next(".dropdown-toggle").find(".filter-option-inner-inner").css({"color":"red"});
		$(".dataset-operation-row .dataset-cell[data-col-index=2]").find(".selectpicker").first().val("-1");
		$(".dataset-operation-row .dataset-cell[data-col-index=2]").find(".selectpicker").first().selectpicker("refresh");
		$(".dataset-operation-row .dataset-cell[data-col-index=2]").find(".selectpicker").next(".dropdown-toggle").find(".filter-option-inner-inner").prev("i").attr("class","fa fa-question-circle").css("color","red");					
		$(".dataset-operation-row .dataset-cell[data-col-index=2]").find(".selectpicker").next(".dropdown-toggle").find(".filter-option-inner-inner").css({"color":"red"});
		
	}
	
	this.view.getGMCombo = function(dt_variables) {		
		
		var req = $.ajax({
			
			async:false,
			data:{
				dt_variables:dt_variables
			},
			type:"POST",
			url:"./php/get-stats-gm-combo.php",
			success:function(d){}
			
		});
		
		document.getElementById("gm-combo").innerHTML = req.responseText;	
		
	}
	
	this.view.getTableHeader = function(page) {		
		
		var dt_id = $("#frm-dt #dt_id").val();
		var dt_variables = $("#frm-dt #dt_v").val();
		var dt_cruce = $("#frm-dt #dt_c").val();
		var colstr = $("#colstr").val();
		
		var req = $.ajax({
			
			async:false,
			data:{
				page:page,
				dt_id:dt_id,
				dt_variables:dt_variables,
				dt_cruce:dt_cruce
			},
			type:"POST",
			url:"./php/get-stats-table-header.php",
			success:function(d){}
			
		});
		
		document.getElementById("dataset-header").innerHTML = req.responseText;	
			
		var colgroup = $("#colgroup").val();
			colgroup = colgroup.split(",");
			
		var combo = document.getElementById("group-combo-view");
		
		for (var i=0; i<colgroup.length; i++) {
			
			var option = document.createElement("option");
				option.value = colgroup[i];
				option.innerHTML = colgroup[i];
				option.setAttribute("data-col-index",i);
				
			combo.appendChild(option);
			
		}
			
		this.resetSelects();
		
	}
	
	this.view.processGM = function() {
		
		var groupbycol = $("#group-combo-view").attr("data-group-by-column");
		var groupby_val = $("#group-combo-view").val();
		var groupbycol_index = $("#group-combo-view").attr("data-group-column-index");
		var groupbycol_name = $("#group-combo-view").attr("data-group-column-index");
		
		if ((groupbycol_index != 0) && (groupbycol_index != 1)) {
			
			alert("Debe agrupar el dataset por una variable de cruce espacial para poder mapear o graficar");
			
		}else{
		
			var gm_action = $("#popup-stats-gm").attr("data-action");
			var gm_var  = $("#gm-combo").val();
			
			if ((gm_action != -1) && (gm_var != -1)) {
			
				var mapear = false;
				var graficar = false;
				
				if (gm_action == "m") {
					
					mapear = true;
					
				}else{				
						
					graficar = true;
				
				}
			
				currentPage = $(".page-active").attr("data-page");
			
				this.getTable(currentPage,false,mapear,graficar);
			
			}else{
				
				alert("Se produjo un error asegurese de haber elegido una variable para procesar");
				
			}
		
		}
		
	}
	
	this.view.getTable = function(page,bypassOp,mapear,graficar) {
		
		var dt_id = $("#frm-dt #dt_id").val();
		var dt_variables = $("#frm-dt #dt_v").val();
		var dt_cruce = $("#frm-dt #dt_c").val();
		var colstr = $("#colstr").val();
		var colstrType = $("#coltypestr").val();
		var colgroup = $("#colgroup").val();
		var groupbycol = $("#group-combo-view").attr("data-group-by-column");
		var groupby_val = $("#group-combo-view").val();
		var groupbycol_index = $("#group-combo-view").attr("data-group-column-index");
		var groupbycol_name = $("#group-combo-view").attr("data-group-column-index");
		var gm_var = $("#gm-combo").val();
		
		if ((groupby_val == 2) || (groupby_val == 3)) {
			
			bypassOp = true;
			
		}
		
		var filters = [];
		
		$(".dataset-filter-row .dataset-cell").each(function(i,v) {
			
			var colname = $(this).attr("data-col-name");
			var coltype = $(this).attr("data-col-type");
			var filtertype = $(this).find(".selectpicker").val();
			var filterval = $(this).find(".col-filter").val();
			
			var column = {
				
				colname:colname,
				coltype:coltype,
				filtertype:filtertype,
				filterval:filterval
				
			}
			
			filters.push(column);
			
		});
		
		var operations = [];
		
		var no_op = false;
		
		var indexCell = 0;
		
		$(".dataset-operation-row .dataset-cell").each(function(i,v) {				
			
			var operation = $(this).find(".selectpicker").val();
			
			if (groupbycol == 1) {
				
				if (indexCell < 3) {
					
					if (groupbycol_index == indexCell) {
						
						operation = "NONE";
						
					}else{
						
						operation = "MAX";
						
					}
				
				}else{
					
					if (operation == -1) {
							
						no_op = true;
							
					}
					
				}
				
			}else{
			
				if (operation == -1) {
					
					no_op = true;
					
				}
			
			}
			
			operations.push(operation);
			
			indexCell++;
			
		});
		
		var data = {
			page:page,
			dt_id:dt_id,
			dt_variables:dt_variables,
			dt_cruce:dt_cruce,
			colstr:colstr,
			colstrType:colstrType,
			filters:filters,
			operations:operations,
			colgroup:colgroup,
			groupbycol:groupbycol,
			groupbycol_index:groupbycol_index,
			groupbycol_name:groupbycol_name,
			groupby_val:groupby_val,
			gm_var:gm_var
		}
		
		if ((!no_op) || (bypassOp)) {
		
			var req = $.ajax({
				
				async:false,
				data:data,
				type:"POST",
				url:"./php/get-stats-table.php",
				success:function(d){}
				
			});
			
			document.getElementById("dataset-content").innerHTML = req.responseText;
			
			//this.resetSelects();

			$(".page-item").each(function(i,v) {
				
				$(v).on("click",function() {
					
					var pageitem = v.getAttribute("data-page");
					
					this.getTable(pageitem,false,false,false);
					
				}.bind(this));
				
			}.bind(this));
			
			var rowWidth = $(".dataset-row").first().width();
			var rowChilds = $(".dataset-row").first().children().length;
			
			var cellWidth = rowWidth / rowChilds;
			
			$(".dataset-cell").css("width",cellWidth+"px");
			$(".dataset-filter-row .dropdown-toggle").css("width",50+"px");
			$(".dataset-operation-row .dropdown-toggle").css("width",cellWidth+"px");
			$(".col-filter").on("keydown",function() {
				
				$("#update-view").prop("disabled",false);
				
			});
			
			this.updateAgroupColModals();
			
			if (mapear) {
				
				var dt_mapeo_id = $("#dataset").attr("data-gm-id");
				this.mapear(dt_mapeo_id);
				
			}
			
			if (graficar) {
				
				var dt_mapeo_id = $("#dataset").attr("data-gm-id");
				this.graficar(dt_mapeo_id);
			}
		
		}else{
			
			alert("Faltan seleccionar funciones para poder actualizar la vista");
			$("#update-view").prop("disabled",false);
			
		}
		
	}
	
	/**************** DIOS , Un request via POST para WMS *******************************/
	function WmsPostHandle(image, src) 
	{
		var img = image.getImage();
		if (typeof window.btoa === 'function') 
		{
			 var xhr = new XMLHttpRequest();
			 xhr.open('POST', src, true);
			 xhr.responseType = 'arraybuffer';
			 xhr.onload = function(e) 
			 {
				if (this.status === 200) 
				{
				  console.log("this.response",this.response);
				  var uInt8Array = new Uint8Array(this.response);
				  var i = uInt8Array.length;
				  var binaryString = new Array(i);
				  
				  while (i--) 
				  {
					binaryString[i] = String.fromCharCode(uInt8Array[i]);
				  };
				  
				  var data = binaryString.join('');
				  var type = xhr.getResponseHeader('content-type');
				  if (type.indexOf('image') === 0) 
				  {
					img.src = 'data:' + type + ';base64,' + window.btoa(data);
				  };
				};
			};
			xhr.send();
		} 
		else 
		{
			img.src = src;
		};
	};
	
	/************************************************************************************/
	
	this.view.premapear = function() {
		
		$("#graph-types").hide(); 
		$("#popup-modal-gm").show(); 
		$("#popup-stats-gm").show();
		$("#popup-stats-gm").attr("data-action","m");
		$("#gm-stats-mediawrapper").html("");
		$("#popup-stats-gm-header .icons").show();
		
	}
	
	this.view.pregraficar = function() {
		
		$("#graph-types").show();
		$("#popup-modal-gm").show(); 
		$("#popup-stats-gm").show();
		$("#popup-stats-gm").attr("data-action","g");
		$("#gm-stats-mediawrapper").html("");
		$("#popup-stats-gm-header .icons").hide();
		
	}
	
	this.view.mapear = function(query_id) {
		
		document.getElementById("gm-stats-mediawrapper").innerHTML = "";
		
		sld_result = '';
		
		/**** Generar el SLD ****/
		s = new sldlib();
		capa = s.sld_get_intervalos(query_id); /* Retorna la capa que corresponde por tipo de geometria */
		
		var layer = new ol.layer.Tile({
				visible:true,
				singleTile: true,
				source: new ol.source.TileWMS({
					url: "http://observatorio.atic.com.ar/cgi-bin/mapserver?map=wms_atic",
					params: {
						'LAYERS': capa,//'intervalos_polygons',
						'id':query_id,
						//'VERSION': '1.1.1',
						'FORMAT': 'image/png',
						'TILED': false,
						'SLD':'http://'+window.location.hostname+'/sld/'+query_id+'.sld' /* EL SLD CREADO ES SIEMPRE EL ID_MAPEO.SLD */
					}
				})
			});
		
		
		var googlelayer = new ol.layer.Tile({
			name:'google_base',
			visible:true,
			source: new ol.source.TileImage({ 
				url: 'http://mt{0-3}.googleapis.com/vt?&x={x}&y={y}&z={z}&hl=es&gl=AR',
				crossOrigin: 'anonymous'
			})
		})
		
		var map = new ol.Map({
			layers:[googlelayer,layer],
			target: 'gm-stats-mediawrapper',
			extent: [-13281237.21183002,-7669922.0600572005,-738226.6183457375,-1828910.1066171727],
			controls: [],
			view: new ol.View({
				center: [-7176058.888636417,-4680928.505993671],
				zoom:3.8,
				minZoom: 3.8,
				maxZoom: 21
			})
		});
		
	}
	
	this.view.graficarTipo = function(graphType) {
		
		this.graphType = graphType;
		document.getElementById("gm-graficar-process").click();
		
	}
	
	this.view.graficar = function(query_id) {
		
		var colagroup = $("#group-combo-view").attr("data-group-column-val");
		var coldataset = $("#gm-combo").val();
		var labels = $("#graficar-labels").val();
			labels = labels.split(",");
		var values = $("#graficar-values").val();
			values = values.split(",");
			
		if (this.graphType) {
			
			var graphType = this.graphType;
			
		}else{
			
			var graphType = 1;
			
		}
		
		for (var i=0; i<values.length; i++) {
			
			values[i] = parseFloat(values[i]);
			
		}
		
		Highcharts.setOptions({
			lang: {
				contextButtonTitle:"Menu Contextual",
				viewFullscreen:"Pantalla Completa",
				printChart:"Imprimir Gráfico",
				downloadPNG:"Descargar PNG",
				downloadJPEG:"Descargar JPG",
				downloadPDF:"Descargar PDF",
				downloadSV:"Descargar SVG"
			}
		});
		
		switch(graphType) {
			
			case 1:
			
			this.chart = Highcharts.chart('gm-stats-mediawrapper', {
				chart: {
					type: 'column',
					height:350,
					width:600
				},
				credits:{
					enabled:false
				},
				title: {
					text: colagroup
				},
				subtitle: {
					text: "por " + coldataset
				},
				xAxis: {
					categories:labels,
					crosshair: true
				},
				yAxis: {
					min: 0,
					title: {
						text: coldataset
					}
				},
				tooltip: {
					headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
					pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
						'<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
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
				credits: {
					enabled: false
				},
				series: [{
					name:colagroup,
					data: values
				}]
			});
			
			break;
			
			case 2:
			
			this.chart = Highcharts.chart('gm-stats-mediawrapper', {
				chart: {
					zoomType: 'x',
					height:350,
					width:600
				},
				title: {
					text: colagroup
				},
				subtitle: {
					text: "por " + coldataset
				},
				xAxis: {
					type: labels
				},
				yAxis: {
					title: {
						text: coldataset
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
				credits: {
					enabled: false
				},

				series: [{
					name:colagroup,
					data: values
				}]
			});
			
			break;
			
			case 3:
			
			this.chart = Highcharts.chart('gm-stats-mediawrapper', {
				chart: {
					type: 'area',
					height:350,
					width:600
				},
				title: {
					text: colagroup
				},
				subtitle: {
					text: "por " + coldataset
				},
				xAxis: {
					categories: labels,
					tickmarkPlacement: 'on',
					title: {
						enabled: false
					}
				},
				yAxis: {
					title: {
						text: coldataset
					}
				},
				tooltip: {
					pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.percentage:.1f}%</b> ({point.y:,.0f} millions)<br/>',
					split: true
				},
				plotOptions: {
					area: {
						stacking: 'percent',
						lineColor: '#ffffff',
						lineWidth: 1,
						marker: {
							lineWidth: 1,
							lineColor: '#ffffff'
						}
					}
				},
				credits: {
					enabled: false
				},
				series: [{
					name:colagroup,
					data: values
				}]
			});
			
			break;
			
			case 4:
			
			this.chart = Highcharts.chart('gm-stats-mediawrapper', {
				chart: {
					type: 'area',
					height:350,
					width:600
				},
				title: {
					text: colagroup
				},
				subtitle: {
					text: "por " + coldataset
				},
				xAxis: {
					categories: labels,
					tickmarkPlacement: 'on',
					title: {
						enabled: false
					}
				},
				yAxis: {
					title: {
						text: coldataset
					},
					labels: {
						formatter: function () {
							return this.value / 1000;
						}
					}
				},
				tooltip: {
					split: true,
					valueSuffix: ' millions'
				},
				plotOptions: {
					area: {
						stacking: 'normal',
						lineColor: '#666666',
						lineWidth: 1,
						marker: {
							lineWidth: 1,
							lineColor: '#666666'
						}
					}
				},
				credits: {
					enabled: false
				},
				series:[{
					name:colagroup,
					data: values
				}]
			});
			
			break;
			
			case 5:
			
			this.chart = Highcharts.chart('gm-stats-mediawrapper', {
				chart: {
					type: 'line',
					height:350,
					width:600
				},
				title: {
					text: colagroup
				},
				subtitle: {
					text: "por " + coldataset
				},
				xAxis: {
					categories: labels
				},
				yAxis: {
					title: {
						text: coldataset
					}
				},
				plotOptions: {
					line: {
						dataLabels: {
							enabled: true
						},
						enableMouseTracking: false
					}
				},
				credits: {
					enabled: false
				},
				series:[{
					name:colagroup,
					data: values
				}]
			});
			
			break;
			
			case 6:
			
			this.chart = Highcharts.chart('gm-stats-mediawrapper', {
				chart: {
					type: 'column',
					height:350,
					width:600
				},
				title: {
					text: colagroup
				},
				subtitle: {
					text: "por " + coldataset
				},
				xAxis: {
					categories: labels
				},
				yAxis: {
					min: 0,
					title: {
						text: coldataset
					},
					stackLabels: {
						enabled: true,
						style: {
							fontWeight: 'bold',
							color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
						}
					}
				},
				legend: {
					align: 'right',
					x: -30,
					verticalAlign: 'top',
					y: 25,
					floating: true,
					backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
					borderColor: '#CCC',
					borderWidth: 1,
					shadow: false
				},
				tooltip: {
					headerFormat: '<b>{point.x}</b><br/>',
					pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
				},
				plotOptions: {
					column: {
						stacking: 'normal',
						dataLabels: {
							enabled: true,
							color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
						}
					}
				},
				credits: {
					enabled: false
				},
				series:[{
					name:colagroup,
					data: values
				}]
			});
			
			break;
			
			case 7:
			
			this.chart = Highcharts.chart('gm-stats-mediawrapper', {
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie',
					height:350,
					width:600
				},
				title: {
					text: colagroup
				},
				subtitle: {
					text: "por " + coldataset
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							format: '<b>{point.name}</b>: {point.percentage:.1f} %',
							style: {
								color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
							}
						}
					}
				},
				credits: {
					enabled: false
				},
				series:[{
					name:colagroup,
					data: values
				}]
			});
			
			break;
			
			case 8:
			
			this.chart = Highcharts.chart('gm-stats-mediawrapper', {
				chart: {
					type: 'bar',
					height:350,
					width:600
				},
				title: {
					text: colagroup
				},
				subtitle: {
					text: "por " + coldataset
				},
				xAxis: {
					categories: labels,
					title: {
						text: null
					}
				},
				yAxis: {
					min: 0,
					title: {
						text: coldataset,
						align: 'high'
					},
					labels: {
						overflow: 'justify'
					}
				},
				tooltip: {
					valueSuffix: ''
				},
				plotOptions: {
					bar: {
						dataLabels: {
							enabled: true
						}
					}
				},
				legend: {
					layout: 'vertical',
					align: 'right',
					verticalAlign: 'top',
					x: -40,
					y: 80,
					floating: true,
					borderWidth: 1,
					backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
					shadow: true
				},
				credits: {
					enabled: false
				},
				series:[{
					name:colagroup,
					data: values
				}]
			});
			
			break;
			
		}
			
		
		
	}
	
	this.dataset.dt_id = 0;
	
	this.dataset.loadVars = function(dt_id) {		
		
		this.dt_id = dt_id;
		
		var req = $.ajax({
			
			async:false,
			url:"./php/get-dataset-vars.php",
			type:"POST",
			data:{dt_id:dt_id},
			success:function(d){}
			
		});
		
		document.getElementById("panel-dataset-list").innerHTML = req.responseText;
		
		$(".dataset-var-check").each(function(i,v) {
			
			$(v).on("click",function() {
				
				var checks = $(".dataset-var-check:checked").length;
				
				if (checks>10) {
										
					$(v).prop("checked",false);
					alert("El limite de variables a elegir es de 10, por favor deseleccione una variable para poder marcar esta opción");
					
				}
				
			});
			
		});
		
	}
	
	this.dataset.loadContent = function(dt_id) {		
		
		this.dt_id = dt_id;
		
		var req = $.ajax({
			
			async:false,
			url:"./php/get-dataset-content.php",
			type:"POST",
			data:{dt_id:dt_id},
			success:function(d){}
			
		});
		
		document.getElementById("dataset-detail-wrapper").innerHTML = req.responseText;
		
	}
	
	this.dataset.proceed = function() {

		var dt_id = this.dt_id;
		var dt_variables = $.map($('.dataset-var-check:checked'), function(n, i){
			  return n.value;
		}).join(',');

		var dt_cruce = $("#combo_cruce").val();

		/*var debug = "DT_ID: " + dt_id + "\n";
			debug += "DT_VARS: " + dt_variables + "\n";
			debug += "DT_CRUCE: " + dt_cruce + "\n";*/

		$("#inp_dt_id").val(dt_id);
		$("#inp_dt_variables").val(dt_variables);
		$("#inp_dt_cruce").val(dt_cruce);
		
		var flink = "./estadisticas-vista.php?dt_id="+dt_id+"&dt_v="+dt_variables+"&dt_c="+dt_cruce;
		
		var flinka = document.createElement("a");
			flinka.setAttribute("href",flink);
			
		document.body.appendChild(flinka);
		flinka.click();
		
		$(flinka).remove();

	}
		
}
