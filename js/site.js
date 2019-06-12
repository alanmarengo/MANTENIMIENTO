$(document).ready(function() {
    $('#main-search').focusin(function() {
        $(this).attr('placeholder', '');
    });

    $('#main-search').focusout(function() {
        $(this).attr('placeholder', 'Buscar en todo el sitio');
    });

    $('#main-search').on('keypress', function(e) {
        if (e.which == 13) {
            let url = "./mediateca.php?s=" + $(this).val();
            window.location.replace(url);
        }
    });
});

$.urlParam = function(name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)')
        .exec(window.location.search);

    return (results !== null) ? results[1] || 0 : false;
}