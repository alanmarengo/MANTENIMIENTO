

function abrir_en_est()
{
	var url = window.location.origin+'/estadisticas.php?mode=1&dt='+document.getElementById("current_id").id_actual+'&cid='+document.getElementById("clase_id").value;
	window.open(url,'_blank');
};

function nuevo()
{

			document.getElementById("ind_id").value='';
			document.getElementById("ind_titulo").value='';
			document.getElementById("ind_desc").value='';
			document.getElementById("clase_id").value='';
			document.getElementById("template_id").value='';

			document.getElementById("current_id").id_actual=-1;
			document.getElementById("current_id").innerHTML = "<span>Sin panel seleccionado</span>";
			
			$("#grid-items-panel").jsGrid('loadData');
					
			document.getElementById("tab-link-b").click();
};

function borrar()
{
	if(confirm('Esta seguro desea eliminar el grafico?'))
	{
		
	var retorno = $.ajax
				({
					url: "./abm-graficos.php",
					async:false,
					data:
					{
								mode:2,
								grafico_id:document.getElementById("current_id").id_actual
					},
					dataType: "json"
				});
	
	s = JSON.parse(retorno.responseText); /* status */
	
	if(s.status_code=="0")
	{
		//alert('Se guardo el registro correctamente');
		nuevo();
		
		return true;
	}
	else
	{
		alert('No se pudo borrar el registro. Mensaje:'+s.error_desc);
		return false;
	};
	
	}return false;

};

function guardar()
{

	var retorno = $.ajax
				({
					url: "./abm-indicadores.php",
					async:false,
					data:
					{
								mode:1,
								ind_id:document.getElementById("current_id").id_actual,
								ind_titulo:document.getElementById("ind_titulo").value,
								ind_desc:document.getElementById("ind_desc").value,
								clase_id:document.getElementById("clase_id").value,
								template_id:document.getElementById("template_id").value
							
					},
					dataType: "json"
				});
	
	//console.log(retorno.responseText);
	
	s = JSON.parse(retorno.responseText); /* status */
	
	if(s.status_code=="0")
	{
		alert('Se guardaron correctamente los datos');
		
		document.getElementById("ind_id").value=s.ind_id;
		document.getElementById("current_id").id_actual=s.ind_id;
		document.getElementById("current_id").innerHTML = "<span>Panel Actual: " + document.getElementById("ind_titulo").value +"("+s.ind_id+")</span>";
			
		return true;
	}
	else
	{
		alert('No se puedo guardar el registro. Mensaje:'+s.error_desc);
		return false;
	};
	
};

function guardar_item(
posicion,
titulo,
desc,	
ficha_metodo_path,
extent,
tipo,
valor,
ind_id
)
{
	var estado = document.getElementById("current_id").id_actual;
	
	var retorno = $.ajax
				({
					url: "./abm-indicadores.php",
					async:false,
					data:
					{
								mode:4,
								posicion:posicion,
								titulo:titulo,
								desc:desc,
								ficha_metodo_path:ficha_metodo_path,
								extent:extent,
								tipo:tipo,
								valor:valor,
								ind_id:ind_id
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
		alert('No se puedo guardar el registro. Mensaje:'+s.error_desc);
		return false;
	};
	
};


$(
function() 
{
	
	 
     $("#grid-busqueda").jsGrid({
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
			document.getElementById("ind_id").value=args.item.ind_id;
			document.getElementById("ind_titulo").value=args.item.ind_titulo;
			document.getElementById("ind_desc").value=args.item.ind_desc;
			document.getElementById("clase_id").value=args.item.clase_id;
			document.getElementById("template_id").value=args.item.template_id;

			document.getElementById("current_id").id_actual=args.item.ind_id;
			document.getElementById("current_id").innerHTML = "<span>Panel Actual: " + args.item.ind_titulo +"("+args.item.ind_id+")</span>";
					
			//$("#grid-geovisores-capas").jsGrid('loadData');
			//$("#grid-dt-capas").jsGrid('loadData');
			//$("#grid-dt-variables").jsGrid('loadData')
			
			$("#grid-items-panel").jsGrid('loadData');
			
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
					url: "./abm-indicadores.php",
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
		
			{name: "ind_id", 			width: 100},
			{name: "ind_titulo", 		width: 100},
			{name: "ind_desc", 			width: 300},
			{name: "clase_id", 			width: 100},
			{name: "template_id", 		width: 100}			
		]
		});
		
		 
		$("#grid-items").jsGrid({
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
			
			guardar_item
			(
				document.getElementById('posicion').value,
				document.getElementById('titulo').value ,
				document.getElementById('desc').value ,	
				document.getElementById('ficha_metodo_path').value ,
				document.getElementById('extent').value ,
				args.item.tipo,
				args.item.valor,
				document.getElementById("current_id").id_actual
			);
			
			$("#grid-items-panel").jsGrid('loadData');
		
        },
		controller: 
		{
			loadData: function(filter) 
			{
				var b = document.getElementById('buscar_items').value;	
				return $.ajax
				({
					url: "./abm-indicadores.php",
					data:
					{
								mode:2,
								s:b
					},
					dataType: "json"
				});
			}
		},
		fields: 
		[
			{name: "tipo_desc", 		width: 100},
			{name: "titulo", 			width: 800},
			{name: "descripcion", 		width: 800},
			{name: "valor", 			width: 100},
			{name: "tipo", 				width: 100}
		]
		});
		
			 
		$("#grid-items-panel").jsGrid({
		width: "100%",
		height: "auto",
		autoload:   true,
		paging:     true,
		pageSize:   10,
		sorting: true,
		pageButtonCount: 5,
		pageIndex:  1,
		rowClick: function(args) 
		{
			document.getElementById("dt_variable_id").value=args.item.dt_variable_id;
			document.getElementById("dt_variable_nombre").value=args.item.dt_variable_nombre;
			document.getElementById("dt_variable_defincion").value=args.item.dt_variable_defincion;
			document.getElementById("dt_variable_origen").value=args.item.dt_variable_origen;
        },
		controller: 
		{
			loadData: function(filter) 
			{
							
				return $.ajax
				({
					url: "./abm-indicadores.php",
					data:
					{
								mode:3,
								ind_id:document.getElementById("current_id").id_actual
					},
					dataType: "json"
				});
			}
		},
		fields: 
		[
			{name: "posicion", 		width: 90},
			{name: "tipo_desc", 	width: 100},
			{name: "titulo", 		width: 400},
			{name: "desc", 			width: 400},
			{name: "ind_id", 		width: 100},
			{name: "valor", 		width: 100},
			{name: "ficha_metodo_path", 	width: 100}
			
		]
		});
		
		
		

});


