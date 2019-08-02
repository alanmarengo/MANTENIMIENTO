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
			
			this.getTable(currentPage);
			
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
			
			var index = $('option:selected', this).attr("data-col-index");
			var val = $(this).val();
			
			$(".dataset-cell-modal").remove();
			
			if (index != undefined) {
				
				for (var i=0; i<3; i++) {
					
					if (i!=index) {
						
						$(".dataset-cell[data-col-index="+i+"]").append($("<div></div>").attr("class","dataset-cell-modal"));
						
					}
					
				}
				
				$(this).attr("data-group-column","1");
				$(this).attr("data-group-column-index",index);
				$(this).attr("data-group-column-val",val);				
			
			}else{
				
				$(this).attr("data-group-column","0");
				$(this).attr("data-group-column-index","-1");
				$(this).attr("data-group-column-val","-1");		
				
			}
			
			if ((val == 2) || (val == 3)) {
				
				$(".dataset-operation-row .dataset-cell").append($("<div></div>").attr("class","dataset-cell-modal"));
				
			}
			
		});
		
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
	
	this.view.getTable = function(page,bypassOp) {
		
		var dt_id = $("#frm-dt #dt_id").val();
		var dt_variables = $("#frm-dt #dt_v").val();
		var dt_cruce = $("#frm-dt #dt_c").val();
		var colstr = $("#colstr").val();
		var colstrType = $("#coltypestr").val();
		var colgroup = $("#colgroup").val();
		var groupindex = $("#group-combo-view").val();
		var groupbycol = $("#group-combo-view").attr("data-group-column");
		var groupbycolindex = $("#group-combo-view").attr("data-group-column-index");
		
		if ((groupindex == 2) || (groupindex == 3)) {
			
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
				
				if (groupbycolindex == indexCell) {
					
					if (operation == -1) {
						
						no_op = true;
						
					}
					
				}else{
					
					operation = "MAX";
					
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
				groupindex:groupindex
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
					
					this.getTable(pageitem,false);
					
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
		
		}else{
			
			alert("Faltan seleccionar funciones para poder actualizar la vista");
			$("#update-view").prop("disabled",false);
			
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
		alert(flink);
		var flinka = document.createElement("a");
			flinka.setAttribute("href",flink);
			
		document.body.appendChild(flinka);
		flinka.click();
		
		$(flinka).remove();

	}
		
}