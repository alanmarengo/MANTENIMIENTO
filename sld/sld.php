<?php
const _POINT_   =0;
const _LINE_    =1;
const _POLYGON_ =2;

$simbol = 'circle'; 

$type_geom		= $_REQUEST['type_geom'		];
$main_color 	= $_REQUEST['main_color'	];
$layer_name 	= $_REQUEST['layer_name'	];
$size			= $_REQUEST['size'			];
$border_color 	= $_REQUEST['border_color'	];
$border_size 	= $_REQUEST['border_size'	];


switch ($type_geom) 
{
    case _POINT_	:$sld_file 	= file_get_contents("./point.sld");		break;
    case _LINE_		:$sld_file 	= file_get_contents("./line.sld");		break;
    case _POLYGON_	:$sld_file 	= file_get_contents("./polygon.sld");	break;
};


//$sld_file 	= file_get_contents("./geom.sld");

$sld_file	= str_replace("[layer_name]"	, $layer_name	,$sld_file		);
$sld_file	= str_replace("[main_color]"	, '#'.$main_color	,$sld_file	);
$sld_file	= str_replace("[size]"			, $size			,$sld_file		);
$sld_file	= str_replace("[border_color]"	, '#'.$border_color	,$sld_file	);
$sld_file	= str_replace("[border_size]"	, $border_size	,$sld_file		);
$sld_file	= str_replace("[symbol]"		, $simbol		,$sld_file		);

echo $sld_file;

?>
