<link rel="stylesheet" type="text/css" href="./css/page_template.css" />

<div id="page_esia" class="page page_template">
    <div class="row">
        <div class="col-md-12 page-title">
            Observatorio  de los Aprovechamientos Hidroeléctricos del Río Sant Cruz - AHRSC
        </div>

        <div class="col-md-12 top-buttons section-sticky">
            <a href="#" data-target="#descripcion">Descripción</a>
            <a href="#" data-target="#optimizacion">Optimización</a>
            <a href="#" data-target="#condor">Condor Cliff</a>
            <a href="#" data-target="#barrancosa">La Barrancosa</a>
            <a href="#" data-target="#linea">Línea Eléctrica de Alta Tensión</a>
            <a href="#" data-target="#antena">Antenas/Receptores SHF (MW)</a>
        </div>

        <div class="col-md-12">
            <img src="./images/ahrsc_fondo.jpg" style="width: 100%; height: auto;" />
        </div>

        <div class="col-md-12 section-a" style="padding-left: 8em; padding-right: 8em;">
            <a id="descripcion"></a>

            <div class="row">
                <div class="col-md-6">
                    El Proyecto de los “Aprovechamientos Hidroeléctricos del Río Santa Cruz” se ubica en la provincia homónima, entre el Lago Argentino y un punto ubicado a 135 km aguas arriba de la localidad de Comandante Luis Piedrabuena. Está integrado por dos cierres; la presa Cóndor Cliff y La Barrancosa.
                    <br />        
                    <br />        
                    <br />        
                    La presa Cóndor Cliff, de materiales sueltos con pantalla impermeable de hormigón o CFRD, por sus siglas en inglés, se desarrolla en una longitud de 1.613 m y alcanza una altura de 68 m. La casa de máquinas ubicada sobre la margen izquierda, cuenta con 5 turbinas del tipo Francis de 190 MW cada una. Con esta configuración, es posible turbinar un caudal máximo de 1.750 m3/s lo que implica una generación media anual de 3.268 GWh, operando en régimen de punta o sea generando
                </div>
                <div class="col-md-6">
                    A 65 km aguas abajo del cierre anteriormente mencionado, se ubica la presa La Barrancosa. Esta presa también es del tipo CFRD y se desarrolla en una longitud de 2.445 m alcanzando una altura de 41 m. En este caso, la casa de máquinas se ubica sobre la margen derecha y aloja 3 turbinas del tipo Kaplan de 120 MW cada una. Considerando que el caudal turbinable es de 1.260 m3/s, la generación anual estimada es de 1.903 GWh/año y el régimen de operación de base, con un caudal permanente igual al saliente del Lago Argentino.
                </div>
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
$(document).ready(function() {
    $('.section-sticky a').on('click', function() {
        let selector = $(this).data('target');
        $('html, body').animate({
            scrollTop: $(selector).offset().top - 200
        }, 500)
    });

    let target = $.urlParam('target');
    if (target)
        $('#link-' + target).trigger('click');

});
</script>