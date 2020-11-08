
function nuevo_mapa()
{
	document.getElementById("mapa_id_current").innerHTML = "<span>Sin Mapa Seleccionado</span>";
	document.getElementById("mapa_id_current").mapa_id = -1;/* -1 = nueva capa */
	//document.getElementById("layer_abm_preview").src='./images/no_map.png';
			
	document.getElementById("mapa_id").value='';
	document.getElementById("mapa_nombre").value='';
	document.getElementById("mapa_desc").value='';
	document.getElementById("mapa_fecha").value='';
	document.getElementById("mapa_fuente").value='';
	document.getElementById("extent").value='';
	
	document.getElementById("tab-link-mapa").click();
};

function borrar_mapa()
{
	if(confirm('Esta seguro desea eliminar el mapa?'))
	{
		
	var retorno = $.ajax
				({
					url: "../php/abm-mapas.php",
					async:false,
					data:
					{
								mode:9,
								mapa_id:document.getElementById("mapa_id_current").mapa_id
					},
					dataType: "json"
				});
	
	s = JSON.parse(retorno.responseText); /* status */
	
	if(s.status_code=="0")
	{
		//alert('Se guardo el registro correctamente');
		nuevo_mapa();
		
		return true;
	}
	else
	{
		alert('No se pudo borrar el registro. Mensaje:'+s.error_desc);
		return false;
	};
	
	}return false;

};


function borrar_capa_mapa(mapa_id,layer_id)
{
	if(confirm('Esta seguro de quitar la Capa?'))
	{
		
	var retorno = $.ajax
				({
					url: "../php/abm-mapas.php",
					async:false,
					data:
					{
								mode:8,
								mapa_id:mapa_id,
								layer_id:layer_id
					},
					dataType: "json"
				});
	
	s = JSON.parse(retorno.responseText); /* status */
	
	if(s.status_code=="0")
	{
		//alert('Se guardo el registro correctamente');
		
		return true;
	}
	else
	{
		alert('No se pudo guardar el registro. Mensaje:'+s.error_desc);
		return false;
	};
	
	}return false;

};

function nuevo_capa_mapa(mapa_id,layer_id,orden)
{
	var retorno = $.ajax
				({
					url: "../php/abm-mapas.php",
					async:false,
					data:
					{
								mode:7,
								mapa_id:mapa_id,
								layer_id:layer_id,
								orden:orden
					},
					dataType: "json"
				});
	
	s = JSON.parse(retorno.responseText); /* status */
	
	if(s.status_code=="0")
	{
		alert('Se guardo el registro correctamente');
		
		return true;
	}
	else
	{
		alert('No se pudo guardar el registro. Mensaje:'+s.error_desc);
		return false;
	};

};

function nuevo_subtema_mapa(mapa_id,subtema_id)
{
	var retorno = $.ajax
				({
					url: "../php/abm-mapas.php",
					async:false,
					data:
					{
								mode:4,
								mapa_id:mapa_id,
								subtema_id:subtema_id
					},
					dataType: "json"
				});
	
	s = JSON.parse(retorno.responseText); /* status */
	
	if(s.status_code=="0")
	{
		alert('Se guardo el registro correctamente');
		
		return true;
	}
	else
	{
		alert('No se pudo guardar el registro. Mensaje:'+s.error_desc);
		return false;
	};

};

function borrar_subtema_mapa(mapa_id,subtema_id)
{
	var retorno = $.ajax
				({
					url: "../php/abm-mapas.php",
					async:false,
					data:
					{
								mode:3,
								mapa_id:mapa_id,
								subtema_id:subtema_id
					},
					dataType: "json"
				});
	
	s = JSON.parse(retorno.responseText); /* status */
	
	if(s.status_code=="0")
	{
		alert('Se guardo el registro correctamente');
		
		return true;
	}
	else
	{
		alert('No se pudo guardar el registro. Mensaje:'+s.error_desc);
		return false;
	};

};

function guardar_mapa()
{
	
	var retorno = $.ajax
				({
					url: "../php/abm-mapas.php",
					async:false,
					data:
					{
								mode:1,
								mapa_id:document.getElementById("mapa_id_current").mapa_id,
								mapa_nombre:document.getElementById("mapa_nombre").value,
								mapa_desc:document.getElementById("mapa_desc").value,
								mapa_fecha:document.getElementById("mapa_fecha").value,
								mapa_fuente:document.getElementById("mapa_fuente").value,
								extent:document.getElementById("extent").value
								
					},
					dataType: "json"
				});
	
	//console.log(retorno.responseText);
	
	s = JSON.parse(retorno.responseText); /* status */
	
	if(s.status_code=="0")
	{
		alert('Se guardaron correctamente los datos');
		
		document.getElementById("mapa_id").value=s.mapa_id;
		document.getElementById("mapa_id_current").mapa_id=s.mapa_id;
		document.getElementById("mapa_id_current").innerHTML = "<span>Capa Actual: " + document.getElementById("mapa_nombre").value +"("+s.mapa_id+")</span>";
		
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
	 /**************** GRILLA DE MAPAS ****************/
	 
     $("#grid-layers").jsGrid({
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
			document.getElementById("layer_id").value=args.item.layer_id;
			document.getElementById("layer_desc").value=args.item.layer_desc;
			document.getElementById("layer_wms_server").value=args.item.layer_wms_server;
			document.getElementById("layer_wms_layer").value=args.item.layer_wms_layer;
			document.getElementById("layer_wms_server_alter").value=args.item.layer_wms_server_alter;
			document.getElementById("layer_wms_layer_alter").value=args.item.layer_wms_layer_alter; 
			document.getElementById("layer_alter_activo").value=args.item.layer_alter_activo; 	
			document.getElementById("layer_metadata_url").value=args.item.layer_metadata_url; 	
			document.getElementById("layer_schema").value=args.item.layer_schema; 			
			document.getElementById("layer_table").value=args.item.layer_table; 			
			document.getElementById("tipo_layer_id").value=args.item.tipo_layer_id; 		
			document.getElementById("preview_desc").value=args.item.preview_desc; 			
			document.getElementById("preview_titulo").value=args.item.preview_titulo;
			
					
			document.getElementById("tab-link-b").click();
			
			//$("#grid-mapa-subtemas").jsGrid('loadData');
			//$("#grid-capa-mapa").jsGrid('loadData');
			
			//$("#grid-capa-subtemas").jsGrid('loadData');
			//$("#grid-datos-capa").jsGrid('loadData');
		
        
        },
		controller: 
		{
			loadData: function(filter) 
			{
				var b = document.getElementById('dtBusqueda').value;
				
				console
				
				return $.ajax
				({
					url: "./abm-layers.php",
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
			{name: "layer_id", 				width: 100},
			{name: "layer_desc", 			width: 200},
			{name: "layer_wms_server", 		width: 200},
			{name: "layer_wms_layer", 		width: 200},
			{name: "layer_wms_server_alter",width: 200},
			{name: "layer_wms_layer_alter", width: 200},
			{name: "layer_alter_activo", 	width: 200},
			{name: "layer_metadata_url", 	width: 200},
			{name: "layer_wms_sld", 		width: 200},
			{name: "layer_schema", 			width: 200},
			{name: "layer_table", 			width: 200},
			{name: "tipo_layer_id", 		width: 200},
			{name: "tipo_origen_id", 		width: 200},
			{name: "preview_desc", 			width: 200},
			{name: "preview_link", 			width: 200},
			{name: "preview_titulo", 		width: 800}
		]
		});
		
		/************* GRILLA SUBTEMAS ****************/
		
		$("#grid-subtemas").jsGrid({
		width: "100%",
		height: "auto",
		autoload:   true,
		paging:     true,
		pageSize:   5,
		pageButtonCount: 5,
		pageIndex:  1,
		rowClick: function(args) 
		{
			mapa_id = document.getElementById("mapa_id_current").mapa_id;
		
			nuevo_subtema_mapa(mapa_id,args.item.subtema_id);
			
			$("#grid-mapa-subtemas").jsGrid('loadData');
        },
		controller: 
		{
			loadData: function(filter) 
			{
				var b = document.getElementById('subtemasBusqueda').value;
				
				return $.ajax
				({
					url: "./php/abm-layers.php",/* REUTILIZAMOS LOS DATOS */
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
			{name: "subtema_id", type: "number",width: 60},
			{name: "subtema_titulo", width: 200}
		]
		});
       
		
		/************* GRILLA SUBTEMAS DE LA MAPA ****************/
		
		$("#grid-mapa-subtemas").jsGrid({
		width: "100%",
		height: "auto",
		autoload:   true,
		paging:     true,
		pageSize:   5,
		pageButtonCount: 5,
		pageIndex:  1,
		rowClick: function(args) 
		{
			borrar_subtema_mapa(args.item.mapa_id,args.item.subtema_id);
			$("#grid-mapa-subtemas").jsGrid('loadData');
        },
		controller: 
		{
			loadData: function(filter) 
			{
				mapa_id = document.getElementById("mapa_id_current").mapa_id;
				
				console.log('mapa_id: '+mapa_id);
				
				return $.ajax
				({
					url: "./php/abm-mapas.php",
					data:
					{
								mode:2,
								mapa_id:mapa_id
					},
					dataType: "json"
				});
			}
		},
		fields: 
		[
			{name: "mapa_id", type: "number",width: 60},
			{name: "subtema_id", type: "number",width: 60},
			{name: "subtema_titulo", width: 200}
		]
		});
		
		/************* GRILLA CAPAS ****************/
		
		$("#grid-capas").jsGrid({
		width: "100%",
		height: "auto",
		autoload:   true,
		paging:     true,
		pageSize:   5,
		pageButtonCount: 5,
		pageIndex:  1,
		rowClick: function(args) 
		{
			mapa_id = document.getElementById("mapa_id_current").mapa_id;
			orden = document.getElementById("orden").value;
			
			if(orden!='')
			{
				
				nuevo_capa_mapa(mapa_id,args.item.layer_id,orden);
				
				$("#grid-capa-mapa").jsGrid('loadData');
				
			}else alert('Ingrese un orden valido.');

        },
		controller: 
		{
			loadData: function(filter) 
			{
				var b = document.getElementById('capasBusqueda').value;
				
				return $.ajax
				({
					url: "./php/abm-mapas.php",
					data:
					{
								mode:5,
								s:b
					},
					dataType: "json"
				});
			}
		},
		fields: 
		[
			{name: "layer_id", width: 100},
			{name: "layer_titulo", width: 200}
		]
		});
		
		/************* GRILLA CAPAS DEL MAPA ****************/
		
		$("#grid-capa-mapa").jsGrid({
		width: "100%",
		height: "auto",
		autoload:   true,
		paging:     true,
		pageSize:   5,
		pageButtonCount: 5,
		pageIndex:  1,
		rowClick: function(args) 
		{
			
			borrar_capa_mapa(args.item.mapa_id,args.item.layer_id);
			
			$("#grid-capa-mapa").jsGrid('loadData');

        },
		controller: 
		{
			loadData: function(filter) 
			{
				var mapa_id = document.getElementById("mapa_id_current").mapa_id;
				
				return $.ajax
				({
					url: "./php/abm-mapas.php",
					data:
					{
								mode:6,
								mapa_id:mapa_id
					},
					dataType: "json"
				});
			}
		},
		fields: 
		[
			{name: "mapa_id", width: 100},
			{name: "layer_id", width: 100},
			{name: "layer_titulo", width: 200},
			{name: "orden_capas", width: 200}			
		]
		});
		
		
		

});
