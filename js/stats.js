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
			this.resetSelects();
			
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
		
	}
	
	this.view.getTable = function(page) {
		
		var req = $.ajax({
			
			async:false,
			data:{page:page},
			type:"POST",
			url:"./php/get-stats-table.php",
			success:function(d){}
			
		});
		
		$("#dataset-wrapper").html(req.responseText);		
		this.resetSelects();
			
		$(".page-item").each(function(i,v) {
			
			$(v).on("click",function() {
				
				var pageitem = v.getAttribute("data-page");
				
				this.getTable(pageitem);
				
			}.bind(this));
			
		}.bind(this));
		
	}
	
	this.dataset.dt_id = 0;
	
	this.dataset.loadVars = function(dt_id) {
		
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
		
		this.dataset.dt_id = dt_id;
		alert(this.dataset.dt_id);
		
	}
	
	this.dataset.proceed = function() {
		
		alert(this.dt_id);
		var dt_id = this.dt_id;
		var dt_variables = $.map($(':checkbox[class=dataset-var-check\\[\\]]:checked'), function(n, i){
			  return n.value;
		}).join(',');
		var dt_cruce = $("#combo_cruce").val();
		
		var debug = "DT_ID: " + dt_id + "\n";		
			debug += "DT_VARS: " + dt_variables + "\n";		
			debug += "DT_CRUCE: " + dt_cruce + "\n";		
			
		alert(debug);
		
	}
		
}