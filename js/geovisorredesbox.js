$(document).ready(function() {

    apiUrl = "http://observatorio.atic.com.ar/red_api.php";
    apiGraficosUrl = "http://observatorio.atic.com.ar/graficos_red/get_graficos.php";

    updateDatepicker();

    currentTab = 1;

    $(".btn-tab").on("click", function() {

        let tabNum = $(this).attr("data-tab");

        currentTab = tabNum;

        getEstaciones();

    });

    getEstaciones();

});

function updateDatepicker() {

    var date = new Date();

    var year = date.getFullYear();

    $(".datepicker").val("");

    $(".datepicker").datepicker({
        defaultDate: null,
        format: 'dd/mm/yyyy',
        firstDay: 0,
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: (year - 100) + ':' + (year),
        monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
        dayNamesShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
        dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        dayNames: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado"],
        onSelect: function() {}

    }).datepicker("setDate", new Date());

}

function getEstaciones() {

    let url = apiUrl + "?tipo_estaciones=" + (currentTab - 1) + "&mode=10";
    let js = this.requestApi(url);

    $("#estaciones-lista").empty();

    for (let i = 0; i < js.length; i++) {
        let item = `
            <div class="switcher-box" data-estacion-id="${js[i].estacion_id}" onclick="est_select(this);">
                <div class="switcher-item">${js[i].estacion_nombre}</div>
            </div>
        `;

        $("#estaciones-lista").append(item);
    }

}

function est_select(node, estacion_id) {

    $(node).appendTo("#estaciones-lista-seleccionadas");

    node.onclick = function() {
        est_unselect(this);
    }

}

function est_unselect(node, estacion_id) {

    $(node).appendTo("#estaciones-lista");

    node.onclick = function() {
        est_select(this);
    }

}

function requestApi(url) {

    var req = $.ajax({

        async: false,
        url: url,
        type: "GET",
        success: function(d) {}

    });

    var js = JSON.parse(req.responseText);

    return js;

}