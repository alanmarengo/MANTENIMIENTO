<html>
<head>
<title>SldLib Test</title>
<script src= './js/sldlib.js'></script>

<script>

 function init()
 {
	 s = new sldlib();
	 
	 //s.set_geometria(_POINT_);
	 //s.set_geometria(_POLYGON_);
	 s.set_geometria(_LINE_);
	 
	 s.set_fill_color('#F87B5E');
	 s.set_border_color('#F85EC8');
	 s.set_border_size(4.444444);
	 s.set_size(8.3444);
	 s.set_simbolo('circle');
	 s.set_titulo('test sld');
	 
	 alert(s.sld_get());
	 //encode for wms sld_body
	 alert(s.sld_get_encode());
	 
 };
 
 </script>


</head>

<body onload='init();' >


</body>





</html>
