Jump.window = function() {
	
	this.initialize = function() {
		
		$(".jump-window-full-body").each(function(i,v) {
			
			var headerHeight = $(v).prev(".jump-window-header").height();
			var windowHeight = $(v).closest(".jump-window").height();
			var paddingTop = window.getComputedStyle(v.parentNode, null).getPropertyValue('padding-top').split("px")[0];
			var bodyHeight = ((windowHeight - headerHeight) - (paddingTop*2));
			
			$(v).css({"height":bodyHeight+"px"});
			
		});
		
		$(".jump-window-full-body").each(function(i,v) {
			
			var hasGroups = $(v).find(".jump-window-group").length;
			var groupsHeight = $(v).find(".jump-window-group").first().find(".jump-window-group-header").first().height();
			var bodyHeight = $(v).height();
			
			if (hasGroups) {
				
				var groupHeight = ((bodyHeight - (groupsHeight * hasGroups)) / hasGroups);
				
				$(v).find(".jump-window-group").find(".jump-window-group-body").css({"height":groupHeight+"px"});
				
			}
			
		});
		
	}
	
	this.initMinimizing = function() {		
		
		document.body.jwindowBar = document.createElement("div");
		document.body.jwindowBar.className = "jump-window-minimized-bar";
			
		document.body.appendChild(document.body.jwindowBar);
		
	}
	
	this.setAllWindowsDraggable = function() {
		
		$(".jump-window").each(function(i,v) {
			
			var header = $(v).find(".jump-window-header");
			
			$(v).draggable({handle:header});
			
			$(v).find(".jump-window-close").on("click",function() {
				
				$(this).closest(".jump-window").hide();
				$(this).closest(".jump-window-mode").hide();
				
			});
			
		});
		
	}
	
	this.setAllWindowsResizable = function() {
		
		$(".jump-window").resizable();
		
	}
	
	this.open = function(e) {
		
		$(e).show();
		$(e).children(".jump-window-inner").css("visibility","visible");
		
	}
	
	this.close = function(e) {
		
		$(e).hide();
		$(e).children(".jump-window-inner").css("visibility","hidden");
		
	}	
	
	this.minimize = function(id) {
		
		var e = document.getElementById(id);
		
		$(e).hide();
		$(e).children(".jump-window-inner").css("visibility","hidden");
		
		if (!e.minimizedNode) {
			
			e.title = e.getAttribute("data-minimized-title");
			
			e.minimizedBar = document.createElement("div");
			e.minimizedBar.className = "jump-window-minimized-bar-node";
			
			e.minimizedBarTitle = document.createElement("span");
			e.minimizedBarTitle.appendChild(document.createTextNode(e.title));
			
			e.minimizedBarMaximize = document.createElement("a");
			e.minimizedBarMaximize.className = "jump-window-maximize";
			e.minimizedBarMaximize.setAttribute("href","#");
			
			e.minimizedBarMaximizeIcon = document.createElement("i");
			e.minimizedBarMaximizeIcon.className = "far fa-square";
			
			e.minimizedBarMaximize.appendChild(e.minimizedBarMaximizeIcon);
			
			e.minimizedBar.appendChild(e.minimizedBarTitle);
			e.minimizedBar.appendChild(e.minimizedBarMaximize);
			
			document.body.jwindowBar.appendChild(e.minimizedBar);
			
			$(e.minimizedBar).show();
			
			e.minimizedBarMaximize.onclick = function() {
		
				$(this).parent().hide();
				$(e).hide();
				$(e).children(".jump-window-inner").css("visibility","visible");
				
			}
			
		}else{
			
			$(e.minimizedBar).show();
			
		}
		
	}
	
}