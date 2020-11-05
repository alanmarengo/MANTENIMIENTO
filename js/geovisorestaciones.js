$(document).ready(function() {

    /*$("[title]").tooltipster({
    	animation: 'fade',
    	delay: 200,
    	theme: 'tooltipster-default',
    	trigger: 'hover'
    });*/

    geomap = new ol_map();

    geomap.map.create();
    geomap.map.createLayers();

    geomap.map.ol_object.noBaseLayers = [];

    scroll = new Jump.scroll();

    jwindow = new Jump.window();
    jwindow.initialize();

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
        function() {
            let key = $(this).data('key');
            $(this).css('background-image', 'url("./images/icono-' + key + '-relleno-hover.png")')
        },
        function() {
            let key = $(this).data('key');
            $(this).css('background-image', 'url("./images/icono-' + key + '-relleno.png")')
        }
    )

    scroll.refresh();

    $(".roverlay").each(function(i, v) { $(v).Roverlay(); });
    $("#tab-ha-1").trigger("click");

});

function reCalcPopup() {

    let h1 = $("#popup-inner").children(".header").height();
    let h2 = $("#popup-inner").children(".tabs").height();
    let h3 = $("#popup-inner").children(".categories").height();

    let hp = $("#popup").height();

    let nh = hp - (h1 + h2 + h3);

    $("#popup-tab-content").css("height", nh + "px");

}