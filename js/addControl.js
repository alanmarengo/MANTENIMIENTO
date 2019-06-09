function addControl(control,name,map,control_type,auto_activate,icon,removeOnClose,bbox,bbox_msg,close_button) {

	var node = {};
	
		node.div = document.createElement("div");
		node.div.className = "map-tool-node";
		
		node.icon = document.createElement("div");
		node.icon.className = "map-tool-icon " + icon;
		
		node.triggerWrapper = document.createElement("div");
		node.triggerWrapper.className = "checkbox checkbox-primary";
			
		node.trigger = document.createElement("input");
		node.trigger.type = "checkbox";
		node.trigger.className = "styled";
		node.trigger.onclick = function() {
				
			switch (control_type) {
				
				case "interaction":				
				if (this.checked) {
					
					if (bbox) {
					
						bootbox.confirm(
							{
								closeButton: close_button,
								message: bbox_msg,
								buttons: {
									confirm: {
										label: 'Ir',
										className: 'btn-primary-plahe'
									},
									cancel: {
										label: 'Cerrar',
										className: 'btn-danger'
									}
								},
								callback: function (confirmed) {
						
									if (confirmed) {
										
										map.addInteraction(control);
											
									}else{										
										
										$(node.trigger).prop("checked",false);
										
									}
								}
							}
						);					
					
					}else{
						
						map.addInteraction(control);
						
					}
					
				}else{
					
					map.removeInteraction(control);
					
				}				
				break;
				
				case "flag":				
				if (this.checked) {
					
					control.flag = true;
					
				}else{
					
					control.flag = false;
					
				}
				break;
				
			} // END OF SWITCH
			
		}
		
		if (removeOnClose) {
						
			$(removeOnClose).bind("click",function() {
							
				map.removeInteraction(control);
				$(node.trigger).prop("checked",false);
							
			});
						
		}
		
		node.label = document.createElement("label");
		node.label.className = "map-tool-title";
		node.label.innerHTML = "<span>" + name + "</span>";	
		
		node.triggerWrapper.appendChild(node.trigger);
		node.triggerWrapper.appendChild(node.label);
		
		node.div.appendChild(node.icon);
		node.div.appendChild(node.triggerWrapper);
		
		document.getElementById("map-tools-wrapper").appendChild(node.div);
		
		if (auto_activate) {
			
			node.trigger.setAttribute("checked",true);
			node.trigger.checked = true;
			$(node.trigger).attr("id","testbox");
			
			console.log(node.trigger);
		
			switch (control_type) {
					
				case "interaction":							
				this.map.addInteraction(control);			
				break;
					
				case "flag":
				control.flag = true;
				break;
				
			} // END OF SWITCH
		
		}
		
		$("#perfil-topografico").draggable({handle:"#perfil-topografico-header"});

}