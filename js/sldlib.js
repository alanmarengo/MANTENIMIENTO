/*
 * SLDLib: Simple generador de estructuras SLD (Styled Layer Descriptor) 
 * Uso
 * <script>
 *
 * function init()
 * {
 *	 s = new sldlib();
 * 
 *	 //s.set_geometria(_POINT_);
 *	 //s.set_geometria(_POLYGON_);
 *	 s.set_geometria(_LINE_);
 *	 
 *	 s.set_fill_color('#F87B5E');
 *	 s.set_border_color('#F85EC8');
 *	 s.set_border_size(4.444444);
 *	 s.set_size(8.3444);
 *	 s.set_simbolo('circle');
 *	 s.set_titulo('test sld');
 *	 
 *	 alert(s.sld_get());
 *	 //encode for wms sld_body
 *	 alert(s.sld_get_encode());
 *	 
 * };
 * 
 * </script>
 */

const _POINT_   =0;
const _LINE_    =1;
const _POLYGON_ =2;

const _HEADER_      = '<?xml version="1.0" encoding="UTF-8"?>';
const _DESCRIPTOR_  = '<StyledLayerDescriptor xmlns="http://www.opengis.net/sld" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:se="http://www.opengis.net/se" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1.0" xmlns:ogc="http://www.opengis.net/ogc" xsi:schemaLocation="http://www.opengis.net/sld http://schemas.opengis.net/sld/1.1.0/StyledLayerDescriptor.xsd">';



function sldlib()
{
        this.tipo_geometria = -1;           /* -1: NO SET, 0: POINT, 1: LINE, 2: POLIGON */
        this.simbolo        = 'circle';     /* WellKnowSimbol */
        this.fill_color     = '#ffffff';    /* Por defecto */
        this.boder_color    = '#ffffff';    /* Por defecto */
        this.boder_size     = 1.0;          /* Por defecto */
        this.titulo         = '';
        this.desc           = '';
        this.layer_name     = '';
        this.size           = 4.0;         /* Por defecto */
        
        this.clear = function()
        {
            this.tipo_geometria = -1;           /* -1: NO SET, 0: POINT, 1: LINE, 2: POLIGON */
            this.simbolo        = 'circle';     /* WellKnowSimbol */
            this.fill_color     = '#ffffff';    /* Por defecto */
            this.boder_color    = '#ffffff';    /* Por defecto */
            this.boder_size     = 1.0;          /* Por defecto */
            this.titulo         = '';
            this.desc           = '';
            this.size           = 4.0;         /* Por defecto */
            this.layer_name     = '';
        };
        
        this.sld_size = function()
        {
          return  '<se:Size>'+this.size+'</se:Size>';  
        };
        
        this.sld_fill = function()
        {
            return '<se:Fill><se:SvgParameter name="fill">'+this.fill_color+'</se:SvgParameter></se:Fill>'; 
        };
        
        this.sld_boder = function()
        {
            var trazo       = '<se:SvgParameter name="stroke">'+this.boder_color+'</se:SvgParameter>';
            var trazo_size  = '<se:SvgParameter name="stroke-width">'+this.boder_size+'</se:SvgParameter>';
            var tipo_linea  = '';
            
            if(this.tipo_geometria==_POLYGON_)/* Solo para poligonos */
            {
                tipo_linea  = '<se:SvgParameter name="stroke-linejoin">bevel</se:SvgParameter>';
            };
            
            if(this.tipo_geometria==_LINE_)/* Solo para Lineas */
            {
                tipo_linea  = '<se:SvgParameter name="stroke-linejoin">bevel</se:SvgParameter><se:SvgParameter name="stroke-linecap">square</se:SvgParameter>';
                trazo       = '<se:SvgParameter name="stroke">'+this.fill_color+'</se:SvgParameter>';
            };
            
            return  '<se:Stroke>'+trazo+trazo_size+tipo_linea+'</se:Stroke>';
        };
        
        this.sld_name = function()
        {
           return '<se:Name>'+this.titulo+'</se:Name>';
        };
        
        this.sld_symbol = function()
        {
          return  '<se:WellKnownName>'+this.simbolo+'</se:WellKnownName>';  
        };
        
        this.sld_point = function()
        {
          var estilo = '';
          
          estilo += '<se:Rule>';
          estilo += this.sld_name();
          estilo += '<se:PointSymbolizer>';
          estilo += '<se:Graphic>';
          estilo += '<se:Mark>';
          estilo += this.sld_symbol();
          estilo += this.sld_fill();
          estilo += this.sld_boder();
          estilo += '</se:Mark>';
          estilo += this.sld_size();
          estilo += '</se:Graphic>';
          estilo += '</se:PointSymbolizer>';
          estilo += '</se:Rule>';
          
          return estilo;
        };
        
        this.sld_polygon = function()
        {
          var estilo = '';
          
          estilo += '<se:Rule>';
          estilo += this.sld_name();
          estilo += '<se:PolygonSymbolizer>';
          estilo += this.sld_fill();
          estilo += this.sld_boder();
          estilo += '</se:PolygonSymbolizer>';
          estilo += '</se:Rule>';
          
          return estilo;
        };
        
        this.sld_line = function()
        {
          var estilo = '';
          
          estilo += '<se:Rule>';
          estilo += this.sld_name();
          estilo += '<se:LineSymbolizer>';
          estilo += this.sld_boder();
          estilo += '</se:LineSymbolizer>';
          estilo += '</se:Rule>';
          
          return estilo;
        };
        
        this.sld_geometria_style = function()
        {
          var estilo = '';
          
          switch(this.tipo_geometria) 
          {
                case _POINT_    : estilo = this.sld_point();    break;
                case _POLYGON_  : estilo = this.sld_polygon();  break;
                case _LINE_     : estilo = this.sld_line();     break;
                default         : estilo = 'ESPECIFIQUE TIPO DE GEOMETRIA sld.set_geometria(int); _POINT_,_POLYGON_,_LINE_';
          };
          
          return estilo;
        };
        
        this.sld_get = function()
        {
          var sld = '';
          
          sld += _HEADER_;
          sld += _DESCRIPTOR_;
          sld += '<NamedLayer>';
          sld += this.sld_name();
          sld += '<UserStyle>';
          sld += this.sld_name();
          sld += '<se:FeatureTypeStyle>';
          sld += this.sld_geometria_style();
          sld += '</se:FeatureTypeStyle>';
          sld += '</UserStyle>';
          sld += '</NamedLayer>';
          sld += '</StyledLayerDescriptor>';
          
          return sld;          
        };
        
        this.sld_get_encode = function()
        {
			return encodeURI(this.sld_get());
		};
        
        this.set_size = function(float_size)
        {
            return this.size = float_size;
        };
        
        this.set_border_size = function(float_size)
        {
            return this.boder_size = float_size;
        };
        
        this.set_fill_color = function(hex_color)
        {
            return this.fill_color = hex_color;
        };
        
        this.set_border_color = function(hex_color)
        {
            return this.boder_color = hex_color;
        };
        
        this.set_simbolo = function(str_simbolo)
        {
          return this.simbolo = str_simbolo;
        };
        
        this.set_titulo =  function(str_titulo)
        {
           return this.titulo = str_titulo;
        };
        
        this.set_geometria = function(int_geometria)
        {
          return this.tipo_geometria = int_geometria;  
        };
      
};
