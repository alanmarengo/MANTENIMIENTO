<link rel="stylesheet" type="text/css" href="./css/page_template.css" />

<div id="page_proyecto" class="page page_template">
    <div class="row">
                
        <!---------------------------------------------->
        <div class="col-md-12 section-b">
		
            <a id="optimizacion"></a>
            <h3>VISOR DEL MODELO 2D</h3>            
            
            <div class="row">
                <div class="col-md-12" style="text-align: center; padding: 0px 10px 20px 0px;">
                    <select id="uxVisor" class="selectpicker" data-width="300">
                        <option value="">LA BARRANCOSA</option>
                    </select>
                    <select id="uxCapa" class="selectpicker" data-width="300">
                        <option value="">ESCALA DE PECES</option>
                    </select>
                </div>
            </div>

            <div style="border: solid 1px #666; margin: 10px 15px 0px 15px; width: 100%;">
                <div style="font-size: 10px; padding: 10px; background-color: #fff; color: #333; text-align: center;">
                    <b>VISOR LA BARRANCOSA</b><br />
                    <small>ESCALA DE PECES</small>
                </div>

                <div class="embed-responsive embed-responsive-21by9">
                    <iframe src="./mapa-popup.php" frameborder="0"></iframe>
                </div>
            </div>
			
        </div>
		
    </div>
</div>

<script type='text/javascript'>
$(document).ready(function() {
    $('.section-sticky a').on('click', function() {
        $('.section-sticky a').removeClass('selected');
        $(this).addClass('selected');

        let selector = $(this).data('target');
        $('html, body').animate({
            scrollTop: $(selector).offset().top - 200
        }, 500)
    });

    let target = $.urlParam('target');
    if (target)
        $('#link-' + target).trigger('click');

    $('.section-footer-button2').hover( 
        function () {
            let key=$(this).data('key');
            $(this).css('background-image', 'url("./images/icono-' + key + '-relleno-hover.png")')
        },
        function () {
            let key=$(this).data('key');
            $(this).css('background-image', 'url("./images/icono-' + key + '-relleno.png")')
        }
    )

});
</script>