<script type="text/javascript">
	
	$(document).ready(function() {
		
		stats = new ol_stats();
		stats.view.start();
		stats.view.getTable();
		
		$('select.operation-combo').val(-1);
		$('.selectpicker').selectpicker('refresh')
		
		$("select.operation-combo").each(function(i,v) {			
			
			$(v).next(".dropdown-toggle").find(".filter-option-inner-inner").before($("<i></i>").attr("class","fa fa-question-circle").css("color","red"));
			
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
		
		flotant = new Jump.flotant();
		flotant.prepareToggle(".navmenu:not(#nav-panel)");
		flotant.fitTopElement("#navbar-tools","#navbar-main");
		flotant.fitTopElement(".page-container",".jump-navbar");
		flotant.fit();
		
		scroll = new Jump.scroll();
		scroll.refresh();
		
		hovimage = new Jump.hovimage();
		hovimage.refresh();
		
		nav = new Jump.nav();
		nav.hamburguer.addBehavior(function() {
			
			var addBackOptionSize = $(".jump-sublevel-backoption:visible").length;
			
			if (addBackOptionSize > 0) {
				
				$(".jump-sublevel-backoption:visible a").trigger("click");
				
			}else{
			
				$("#hamburguer").toggleClass('open');
				flotant.toggle('#nav-main',false,false,false);
			
			}
			
		});	

		window.addEventListener("resize",onresize);
		onresize();
		
	});
			
</script>