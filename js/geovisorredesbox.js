$(document).ready(function() {

    apiUrl = "http://observatorio.atic.com.ar/red_api.php";
    apiGraficosUrl = "http://observatorio.atic.com.ar/graficos_red/get_graficos.php";

    updateDatepicker();

    currentTab = 1;

    $(".btn-tab").on("click", function() {

        let tabNum = $(this).attr("data-tab");

        currentTab = tabNum;

        getParametros();
        getEstaciones();

    });

    getParametros();
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

function getParametros() {

    let url = apiUrl + "?tipo_estaciones=" + (currentTab - 1) + "&mode=13";
    let js = this.requestApi(url);

    $("#combo-parametros-redes").empty();

    for (let i = 0; i < js.length; i++) {
        let item = `
            <option value="${js[i].parametro_id}">${js[i].parametro_desc}</option>
        `;

        $("#combo-parametros-redes").append(item);
    }

}

function getEstaciones() {

    let url = apiUrl + "?tipo_estaciones=" + (currentTab - 1) + "&mode=10";
    let js = this.requestApi(url);

    $("#estaciones-lista").empty();
    $("#estaciones-lista-seleccionadas").empty();

    for (let i = 0; i < js.length; i++) {
        let item = `
            <div class="switcher-item"  data-estacion-id="${js[i].estacion_id}" onclick="est_select(this);">${js[i].estacion_nombre}</div>
        `;

        $("#estaciones-lista").append(item);
    }

}

function est_select(node, estacion_id) {

    if ($("#estaciones-lista-seleccionadas").children(".switcher-item").length < 5) {

        $(node).appendTo("#estaciones-lista-seleccionadas");

        node.onclick = function() {
            est_unselect(this);
        }

    }

}

function est_unselect(node, estacion_id) {

    $(node).appendTo("#estaciones-lista");

    node.onclick = function() {
        est_select(this);
    }

}

function getData() {

    let lista_estaciones = getEstacionesSeleccionadas();
    let url = apiUrl + "?lista_estaciones=" + lista_estaciones.join(",") + "&parametro_id=" + $("#combo-parametros-redes").val() + "&fd=" + $("#tab-redes-fdesde").val() + "&fh=" + $("#tab-redes-fhasta").val() + "&mode=11";
    let js = this.requestApi(url);


}

function getEstacionesSeleccionadas() {

    let selected = [];

    $("#estaciones-lista-seleccionadas").children(".switcher-item").each(function(i, v) {

        selected.push($(this).attr("data-estacion-id"));

    });

    return selected;

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