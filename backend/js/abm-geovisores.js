function abrir_en_geobi()
{
	var url = window.location.origin+'/geovisor.php?geovisor='+document.getElementById("current_geovisor_id").geovisor_id;
	window.open(url,'_blank');
};

function cargar_preview()
{
	var url = window.location.origin+'/mediateca_preview.php?origen_id=0&r='+document.getElementById("current_capa_id").layer_id;
	document.getElementById("preview_id").src=url;
};


function nueva_capa()
{
			document.getElementById("layer_id").value='';
			document.getElementById("layer_desc").value='';
			document.getElementById("layer_wms_server").value='';
			document.getElementById("layer_wms_layer").value='';
			document.getElementById("layer_wms_server_alter").value='';
			document.getElementById("layer_wms_layer_alter").value=''; 
			document.getElementById("layer_alter_activo").value=''; 	
			document.getElementById("layer_metadata_url").value=''; 	
			document.getElementById("layer_schema").value=''; 			
			document.getElementById("layer_table").value=''; 			
			document.getElementById("tipo_layer_id").value=''; 		
			document.getElementById("preview_desc").value=''; 			
			document.getElementById("preview_titulo").value='';
	
			document.getElementById("current_capa_id").innerHTML = "<span>Sin Capa Seleccionada</span>";
			document.getElementById("current_capa_id").layer_id = -1;/* -1 = nueva capa */
		
			document.getElementById("tab-link-b").click();
};

function borrar_capa()
{
	if(confirm('Esta seguro desea eliminar la capa?'))
	{
		
	var retorno = $.ajax
				({
					url: "./abm-layers.php",
					async:false,
					data:
					{
								mode:2,
								layer_id:document.getElementById("current_capa_id").layer_id
					},
					dataType: "json"
				});
	
	s = JSON.parse(retorno.responseText); /* status */
	
	if(s.status_code=="0")
	{
		//alert('Se guardo el registro correctamente');
		nueva_capa();
		
		return true;
	}
	else
	{
		alert('No se pudo borrar el registro. Mensaje:'+s.error_desc);
		return false;
	};
	
	}return false;

};

function guardar_catalogo()
{
	
	var retorno = $.ajax
				({
					url: "./abm-layers.php",
					async:false,
					data:
					{
								mode:3,
								layer_id:document.getElementById("current_capa_id").layer_id,
								layer_desc:document.getElementById("layer_desc").value,
								layer_wms_server:document.getElementById("layer_wms_server").value,
								layer_wms_layer:document.getElementById("layer_wms_layer").value,
								layer_wms_server_alter:document.getElementById("layer_wms_server_alter").value,
								layer_wms_layer_alter:document.getElementById("layer_wms_layer_alter").value,
								layer_alter_activo:document.getElementById("layer_alter_activo").value,	
								layer_metadata_url:document.getElementById("layer_metadata_url").value,	
								layer_schema:document.getElementById("layer_schema").value,		
								layer_table:document.getElementById("layer_table").value,			
								tipo_layer_id:document.getElementById("tipo_layer_id").value,		
								preview_desc:document.getElementById("preview_desc").value, 			
								preview_titulo:document.getElementById("preview_titulo").value
								
					},
					dataType: "json"
				});
	
	//console.log(retorno.responseText);
	
	s = JSON.parse(retorno.responseText); /* status */
	
	if(s.status_code=="0")
	{
		alert('Se guardaron correctamente los datos');
		
		return true;
	}
	else
	{
		alert('Hubo problemas para registrar en el catalogo. Mensaje:'+s.error_desc);
		return false;
	};
	
};

function guardar_capa()
{
	
	var retorno = $.ajax
				({
					url: "./abm-layers.php",
					async:false,
					data:
					{
								mode:1,
								layer_id:document.getElementById("current_capa_id").layer_id,
								layer_desc:document.getElementById("layer_desc").value,
								layer_wms_server:document.getElementById("layer_wms_server").value,
								layer_wms_layer:document.getElementById("layer_wms_layer").value,
								layer_wms_server_alter:document.getElementById("layer_wms_server_alter").value,
								layer_wms_layer_alter:document.getElementById("layer_wms_layer_alter").value,
								layer_alter_activo:document.getElementById("layer_alter_activo").value,	
								layer_metadata_url:document.getElementById("layer_metadata_url").value,	
								layer_schema:document.getElementById("layer_schema").value,		
								layer_table:document.getElementById("layer_table").value,			
								tipo_layer_id:document.getElementById("tipo_layer_id").value,		
								preview_desc:document.getElementById("preview_desc").value, 			
								preview_titulo:document.getElementById("preview_titulo").value
								
					},
					dataType: "json"
				});
	
	//console.log(retorno.responseText);
	
	s = JSON.parse(retorno.responseText); /* status */
	
	if(s.status_code=="0")
	{
		alert('Se guardaron correctamente los datos');
		
		document.getElementById("layer_id").value=s.layer_id;
		document.getElementById("current_capa_id").layer_id=s.layer_id;
		document.getElementById("current_capa_id").innerHTML = "<span>Capa Actual: " + document.getElementById("layer_desc").value +"("+s.layer_id+")</span>";
		
		cargar_preview();
		
		return true;
	}
	else
	{
		alert('No se puedo guardar el registro. Mensaje:'+s.error_desc);
		return false;
	};
	
};


$(
function() 
{
	 /**************** GRILLA DE GEOVISORES ****************/
	 
     $("#grid-geovisores").jsGrid({
		width: "100%",
		height: "auto",
		autoload:   true,
		paging:     true,
		pageSize:   5,
		sorting: true,
		pageButtonCount: 5,
		pageIndex:  1,
		rowClick: function(args) 
		{
			document.getElementById("geovisor_id").value=args.item.geovisor_id;
			document.getElementById("geovisor_desc").value=args.item.geovisor_desc;
			document.getElementById("geovisor_extent").value=args.item.geovisor_extent;
			
			document.getElementById("current_geovisor_id").geovisor_id=args.item.geovisor_id;
			document.getElementById("current_geovisor_id").innerHTML = "<span>Geovisor Actual: " + args.item.geovisor_desc +"("+args.item.geovisor_id+")</span>";
					
			$("#grid-geovisores-capas").jsGrid('loadData');
			
			document.getElementById("tab-link-b").click();
        },
		controller: 
		{
			loadData: function(filter) 
			{
				var b = document.getElementById('dtBusqueda').value;
				
				console
				
				return $.ajax
				({
					url: "./abm-geovisores.php",
					data:
					{
								mode:0,
								s:b
					},
					dataType: "json"
				});
			}
		},
		fields: 
		[
			{name: "geovisor_id", 				width: 100},
			{name: "geovisor_desc", 			width: 200},
			{name: "geovisor_extent", 			width: 400}
			
		]
		});
		
		 /**************** GRILLA DE CAPAS ****************/
	 
		$("#grid-capas").jsGrid({
		width: "100%",
		height: "auto",
		autoload:   true,
		paging:     true,
		pageSize:   5,
		sorting: true,
		pageButtonCount: 5,
		pageIndex:  1,
		rowClick: function(args) 
		{
			
        },
		controller: 
		{
			loadData: function(filter) 
			{
				var b = document.getElementById('layersBusqueda').value;
				
				console
				
				return $.ajax
				({
					url: "./abm-geovisores.php",
					data:
					{
								mode:4,
								s:b
					},
					dataType: "json"
				});
			}
		},
		fields: 
		[
			{name: "layer_id", 				width: 100},
			{name: "layer_desc", 			width: 300},
			{name: "preview_titulo", 		width: 800},
			{name: "preview_desc", 			width: 800}
		]
		});
		
		 /**************** GRILLA DE CAPAS DE GEOVISOR ****************/
	 
		$("#grid-geovisores-capas").jsGrid({
		width: "100%",
		height: "auto",
		autoload:   true,
		paging:     true,
		pageSize:   5,
		sorting: true,
		pageButtonCount: 5,
		pageIndex:  1,
		rowClick: function(args) 
		{
			
        },
		controller: 
		{
			loadData: function(filter) 
			{
							
				return $.ajax
				({
					url: "./abm-geovisores.php",
					data:
					{
								mode:5,
								geovisor_id:document.getElementById("current_geovisor_id").geovisor_id
					},
					dataType: "json"
				});
			}
		},
		fields: 
		[
			{name: "layer_id", 				width: 100},
			{name: "nombre_capa", 			width: 200},
			{name: "geovisor_id", 			width: 100},
			{name: "iniciar_visible", 		width: 100}
			
		]
		});
		
		
		

});
