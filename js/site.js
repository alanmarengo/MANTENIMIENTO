$(document).ready(function() {
    $('#main-search').focusin(function() {
        $(this).attr('placeholder', '');
    });
    $('#main-search').focusout(function() {
        $(this).attr('placeholder', 'Buscar en todo el sitio');
    });
});