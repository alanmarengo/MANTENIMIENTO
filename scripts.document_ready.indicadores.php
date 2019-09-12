<script type="text/javascript">
	
	$(document).ready(function() {		
		
		$("[title]").tooltipster({
			animation: 'fade',
			delay: 200,
			theme: 'tooltipster-dark',
			trigger: 'hover',
			side:"left"
		});
		
		indicadores = new ol_indicadores();
		indicadores.panel.start();
		indicadores.startSearch();
		
		flotant = new Jump.flotant();
		flotant.prepareToggle(".navmenu:not(#nav-panel)");
		flotant.fitTopElement("#navbar-tools","#navbar-main");
		flotant.fitTopElement(".page-container",".jump-navbar");
		flotant.fit();		
		
		jwindow = new Jump.window();
		jwindow.initialize();
		
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