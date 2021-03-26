$(document).ready(function() {

    moment.locale('es');

    var model = {
        apiUrlBase: GlobalApiUrl,
        tab: 0,
        paginas: 0,
        qty0: 0,
        qty1: 0,
        qty2: 0,
        qty3: 0,
        stopLoad: false,
        filters: {
            pagina: 0,
            salto: 20,
            orden: 0,
            searchText: '',
            dateStart: '',
            dateEnd: '',
            mode: -1,
            mode_id: 0,
            mode_label: '',
            groups: initFiltersGroups()
        },
        data: {
            docs: [],
            medias: [],
            techs: [],
            news: []
        },
        ficha: null
    };

    init();

    $('.pinned').hcSticky({
        stickTo: '.x0',
        top: 160
    });

    // POP IMAGE
    $('body').on('click', '.preview-pop', function() {
        let media = $(this).data('media');
        let src = $(this).attr('src');
        let html = '';

        if (media == 2) {
            html = `                
                <video width="800" height="450" controls poster="image">
                    <source src="${src}" type="video/mp4" />
                    Tu navegador no soporta reproducir este archivo.
                </video>
            `;
        } else if (media == 3) {
            html = `                
                <video width="800" height="450" controls poster="image">
                    <source src="${src}" type="audio/mpeg" />
                    Tu navegador no soporta reproducir este archivo.
                </video>
            `;
        } else {
            // SI NO SE ESPECIFICA ASUME IMAGEN
            html = `<img src='${src}' style='height: 450px; width: auto;' >`;
        }

        $('#preview').html(html);
        $('#previewmodal').modal('show');

        if (media == 2) {
            $('video')[0].play();
        } else if (media == 3) {
            $('video')[0].play();
        } else {
            //
        }

        $('#previewmodal').on('hidden.bs.modal', function() {
            $('video')[0].pause();
        })

        $('#uxPreviewClose').on('click', function() {
            $('video')[0].pause();
            //$('#previewmodal').modal('hide');
        });


    });

    // CHANGE PAGE
    $('body').on('click', '.page-number', function() {
        let pagina = $(this).data('page');
        model.pagina = pagina;
        dataLoad();
        dataRender();
    });

    // REMOVE FILTER
    $('body').on('click', '.filters-clear', function() {
        filtersReset();
        return;
    });

    // REMOVE FILTER
    $('body').on('click', '.filters-checked', function() {
        let estudio = $(this).data('estudio');
        let group = $(this).data('group');
        let item = $(this).data('item');

        if (estudio == -1) {
            model.filters.searchText = '';
            $('#main-search').val('');
        } else if (estudio == -2) {
            model.filters.searchText = '';
            $('#main-search').val('');
            filtersReset();
        } else if (estudio == 1) {
            model.filters.mode = -1;
            model.filters.mode_id = 0;
            model.filters.mode_label = '';
            filtersReset();
        } else {
            model.filters.groups[group].items[item].checked = false;
        }

        filtersRender();
        model.pagina = 0;
        dataLoad();
    });

    // ADD FILTER
    $('body').on('click', '.filters-group-item', function(e) {
        let group = $(this).data('group');
        let item = $(this).data('item');
        model.filters.groups[group].items[item].checked = true;
        filtersRender();
        model.pagina = 0;
        dataLoad();
    });

    // GROUP COLLAPSE
    $('body').on('click', '.group-title', function() {
        let index = $(this).data('group');
        let collapsed = $($(this).data('target')).hasClass('show');
        let group = model.filters.groups[index];

        collapseAllGroups();
        group.collapsed = collapsed;
        filtersRender();
    });

    // ORDEN
    $('#uxOrden').on('change', function() {
        model.filters.orden = $('#uxOrden').val();
        dataLoad();
    });

    // CLICK ON TAB
    $('a[data-tab]').on('click', function(e) {
        setSolapa($(this).data('tab'));

        model.filters.groups[1].visible = false;
        model.filters.groups[2].visible = false;
        model.filters.groups[3].visible = false;
        model.filters.groups[model.tab + 1].visible = true;

        filtersRender();
        model.pagina = 0;
        dataLoad();
    });

    // CLICK EN LINKS DE FICHA
    $('body').on('click', '.estudios-link, .media-preview-link', function(e) {
        e.stopPropagation();
        let solapa = $(this).data('solapa');
        let mode = $(this).data('mode');
        let mode_id = $(this).data('mode_id');

        setSolapa(solapa);
        model.stopLoad = true;
        model.filters.mode = mode;
        model.filters.mode_id = mode_id;
        model.stopLoad = false;
        model.pagina = 0;

        filtersRender();
        dataLoad();
    });

    // CLICK EN DOC PARA POPUP FICHA
    $('body').on('click', '.doc, .tech, .news', function(e) {
        let id = $(this).data('id');
        let origen_id = $(this).data('origen');
        fichaLoad(id, origen_id, function() {
            fichaRender();
            $('#uxFicha').modal('show');
        });
    });

    // CLICK EN MEDIA-PREVIEW
    $('body').on('click', '.media', function(e) {
        let id = $(this).data('id');
        let origen_id = $(this).data('origen');
        let row = $(this).data('row');
        $('.media-preview').removeClass('show');

        $('.media-border-active').toggleClass('media-border-active media-border');
        $(this).find('.media-border').toggleClass('media-border media-border-active');

        fichaLoad(id, origen_id, function() {
            let imagenes = ``;
            $.each(model.ficha.linkimagenes, function(index, value) {
                if (index > 4)
                    return;

                let linkimg = value.recurso_path_url;
                imagenes += `
            <div style="width: 18%; display: inline-block;">
                <div 
                    class="media-extra" 
                    data-link="${linkimg}" 
                    data-target="#uxPreview_${row}" 
                    data-media="1"
                    style="
                        cursor: pointer;
                        width: 100%;
                        height:60px;
                        background-image: url('${linkimg}');
                        background-repeat: no-repeat;
                        background-position: center center;
                        background-size: cover;    
                    "></div>
            </div>
        `
            });
            
            /*  Si el recurso es formato video o audio no tiene preview, se asigna una por defecto  
             *  background-image: url('${model.ficha.linkimagen}');
             * */
            
            preview_media = '';
            console.log('categoria_media:'+model.ficha.categoria_media);
            
            tipos = ['2','3'];//audio o video
            
            if((model.ficha.categoria_media == 2)||(model.ficha.categoria_media == 3))
            {
                preview_media = './images/play.png';
            }
            else
            {
                preview_media = model.ficha.linkimagen;
            };
            

            let html = `
        <div class="row">
            <div class="col-sm-6">
                <div class="preview-image preview-pop"
                title="Ver imagen"
                src="${model.ficha.linkimagen}" 
                data-media="${model.ficha.categoria_media}"
                style="
                    width: 100%;
                    height:260px;
                    cursor: pointer;
                    background-image: url('${preview_media}');
                    background-repeat: no-repeat;
                    background-position: center center;
                    background-size: cover;    
                "></div>
            </div>
            <div class="col-sm-6" style="max-height: 260px; overflow-y: scroll;">
                <div class="preview-datos">
                    <div class="preview-title">${model.ficha.title}</div>
                    <div class="preview-estudio">${model.ficha.estudio}</div>
                    <div class="preview-autores">Autores: ${model.ficha.autores}</div>
                    <div class="preview-fecha">Fecha: ${model.ficha.fecha}</div>
                    <div class="preview-tema-subtema">Área/Tema: ${model.ficha.tema_subtema}</div>
                    <div class="preview-proyecto">Proyecto: ${model.ficha.proyecto}</div>
                    <div class="preview-imagenes" style="overflow: hide;">
                        ${imagenes}
                    </div>
                    <a class="media-preview-link btn btn-warning btn-xs" data-solapa="1" data-mode="0" data-mode_id="${model.ficha.estudio_id}">Imagenes asociadas</a>
                    </div>
                </div>
        </div>
    `;
            $('#uxPreview_' + row).html(html);

            $('body, html').animate({
                scrollTop: $('#uxPreview_' + row).offset().top - 300
            }, 500);

            $("[title]").tooltipster({
                animation: 'fade',
                delay: 200,
                theme: 'tooltipster-default',
                trigger: 'hover'
            });
        });
    });

    $('body').on('click', '.media-extra', function(e) {
        let target = $(this).data('target');
        let linkcss = $(this).css('background-image');
        let link = $(this).data('link');
        let media = $(this).data('media');
        $(target).find('.preview-image').css('background-image', linkcss);
        $(target).find('.preview-image').attr('src', link);
        $(target).find('.preview-image').data('media', media);
    });

    //-----------------------------------------------------
    function init() {
        var urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('s')) {
            let s = urlParams.get('s');
            model.filters.searchText = s;
            $('#main-search').val(s);
            $('#main-search').focus();
        }
        if (urlParams.has('o')) {
            let o = urlParams.get('o');
            model.filters.orden = o;
            $('#uxOrden').selectpicker('val', o);
        }

        if (urlParams.has('solapa')) {
            let n = parseInt(urlParams.get('solapa'));
            setSolapa(n);
        }

        if (urlParams.has('mode')) {
            model.filters.mode = urlParams.get('mode');
        }

        if (urlParams.has('mode_id')) {
            model.filters.mode_id = urlParams.get('mode_id');
        }

        model.filters.groups = initFiltersGroups();
        dataLoad();
    }

    function getQty() {
        // DEVUELVE EL VALOR DEL MODELO DE ACUERDO A LA SOLAPA ACTIVA
        if (model.tab == 0) return model.qty0;
        else if (model.tab == 1) return model.qty1;
        else if (model.tab == 2) return model.qty2;
        else return model.qty3;
    }

    /*     function filtersLoad() {
            model.filters.groups = initFiltersGroups();
            $.getJSON(model.apiUrlBase + '/mediateca_filtros.php', function(data) {
                $.each(data, function(index, value) {
                    let gindex = 0;

                    if (value.filtro_id == 0) gindex = 0; //'Proyecto'
                    else if (value.filtro_id == 1) gindex = 1; //'Área de gestion'
                    else if (value.filtro_id == 5) gindex = 2; //'Recursos Audiovisuales'
                    else if (value.filtro_id == 2) gindex = 3; //'Recursos tecnicos'
                    else if (value.filtro_id == 3) gindex = 4; //'tema'
                    else if (value.filtro_id == 4) gindex = 5; //'subtema'

                    model.filters.groups[gindex].items.push({
                        id: value.valor_id,
                        label: value.valor_desc,
                        checked: false,
                        parentId: value.parent_valor_id,
                        total: value.total
                    });
                });

                filtersRender();
            });
        }
     */
    function filtersMerge(data) {
        $.each(data, function(index, value) {
            let gindex = 0;
            if (value.filtro_id == 0) gindex = 0; //'Proyecto'
            else if (value.filtro_id == 1) gindex = 1; //'Área de gestion'
            else if (value.filtro_id == 5) gindex = 2; //'Recursos Audiovisuales'
            else if (value.filtro_id == 2) gindex = 3; //'Recursos tecnicos'
            else if (value.filtro_id == 3) gindex = 4; //'tema'
            else if (value.filtro_id == 4) gindex = 5; //'subtema'

            let key = `[${gindex}][${value.valor_id}][${value.valor_desc}]`;
            let item = getFilterItemIndex(gindex, key);

            if (item == null) {
                // ITEM NO EXISTE, LO AGREGA
                model.filters.groups[gindex].items.push({
                    key: key,
                    id: value.valor_id,
                    label: value.valor_desc,
                    checked: false,
                    parentId: value.parent_valor_id,
                    total: value.total
                });
            } else {
                // ITEM SI EXISTE, SOLO ACTUALIZA TOTALES
                item.total = value.total;
            }
        });

        filtersRender();
    }

    //##########################
    function getFilterItemIndex(group, key) {
        let qty = model.filters.groups[group].items.length;
        for (var i = 0; i < qty; i++) {
            let value = model.filters.groups[group].items[i];
            if (value.key == key) {
                return model.filters.groups[group].items[i];
            }
        }

        return null;
    }

    function dataLoad() {
        if (model.stopLoad)
            return;

        // VALIDACION FECHAS CARGADAS
        if (model.filters.dateStart == '' && model.filters.dateEnd != '')
            return;
        if (model.filters.dateStart != '' && model.filters.dateEnd == '')
            return;

        var url = model.apiUrlBase + '/mediateca_find_pag.php?' + makeUrlFilter();
        console.log(url);

        // BLOCK UI
        HoldOn.open({ theme: "sk-rect" });

        $.getJSON(url, function(data) {
            HoldOn.close();

            if (data == null) {
                return;
            }

            filtersMerge(data.filtros);

            model.tab = data.solapa;
            model.paginas = data.paginas;
            model.pagina = data.pagina;
            model.salto = data.rec_per_page;
            model.qty0 = data.registros_total_0;
            model.qty1 = data.registros_total_1;
            model.qty2 = data.registros_total_2;
            model.qty3 = data.registros_total_3;
            model.filters.mode_label = data.mode_label;
            model.data.docs = [];
            model.data.medias = [];
            model.data.techs = [];
            model.data.news = [];
            $.each(data.recordset, function(index, value) {
                if (value.Solapa == 0) {
                    model.data.docs.push({
                        id: value.Id,
                        origen_id: value.origen_id,
                        link_preview: model.apiUrlBase + '/mediateca_preview.php?r=' + value.Id + '&origen_id=' + value.origen_id,
                        title: value.Titulo,
                        autores: value.Autores,
                        description: value.Descripcion,
                        estudio: value.estudios_id,
                        ico: value.ico,
                        estudios: value.estudios
                    });
                } else if (value.Solapa == 1) {
                    model.data.medias.push({
                        id: value.Id,
                        origen_id: value.origen_id,
                        link_preview: model.apiUrlBase + '/mediateca_preview.php?r=' + value.Id + '&origen_id=' + value.origen_id,
                        link: value.LinkImagen,
                        title: value.Titulo,
                        estudio: value.estudios_id,
                        tema: value.tema,
                        autores: value.Autores,
                        fecha: value.Fecha
                    });
                } else if (value.Solapa == 2) {
                    model.data.techs.push({
                        id: value.Id,
                        origen_id: value.origen_id,
                        link_preview: model.apiUrlBase + '/mediateca_preview.php?r=' + value.Id + '&origen_id=' + value.origen_id,
                        title: value.Titulo,
                        autores: value.Autores,
                        description: value.Descripcion,
                        estudio: value.estudios_id,
                        ico: value.ico,
                        estudios: value.estudios
                    });
                } else if (value.Solapa == 3) {
                    model.data.news.push({
                        id: value.Id,
                        origen_id: value.origen_id,
                        link_preview: model.apiUrlBase + '/mediateca_preview.php?r=' + value.Id + '&origen_id=' + value.origen_id,
                        title: value.Titulo,
                        fecha: value.fecha,
                        description: value.Descripcion,
                        estudio: value.estudios_id,
                        ico: value.ico
                    });
                }
            });
            dataRender();
        });
    }

    function fichaLoad(id, origen_id, callbackRender) {
        let qs = {
            id: id,
            origen_id: origen_id
        };
        let url = model.apiUrlBase + '/mediateca_ficha.php?' + jQuery.param(qs);

        $.getJSON(url, function(data) {
            model.ficha = {
                id: data.id,
                link_preview: model.apiUrlBase + '/mediateca_preview.php?r=' + data.id + '&origen_id=' + data.origen_id,
                origen_id: data.origen_id,
                title: data.titulo,
                temporal: data.temporal,
                autores: data.autores,
                description: data.descripcion,
                estudio: data.estudio,
                linkimagen: data.linkdescarga,
                linkvisor: data.linkvisor,
                linkdescarga: data.linkdescarga,
                fecha: data.fecha,
                tema_subtema: data.tema_subtema,
                proyecto: data.proyecto,
                estudio_id: data.estudio_id,
                linkimagenes: data.linkimagenes,
                categoria_media: data.categoria_media
            };

            callbackRender();
        });
    }

    function setSolapa(solapa) {
        $(`a[data-tab="${model.tab}"]`).removeClass('active');
        model.tab = solapa;
        $(`a[data-tab="${model.tab}"]`).addClass('active');
    }

    function filtersReset() {
        model.filters.searchText = '';
        model.filters.mode = -1;
        model.filters.mode_id = 0;
        model.filters.mode_label = '';

        $('#uxSearchText').val('');
        $('#uxDesde').datepicker('clearDates');
        $('#uxHasta').datepicker('clearDates');
        uncheckAllGroups();
    }

    function dataRender() {
        if (model.tab == 0) {
            docsRender();
        } else if (model.tab == 1)
            mediasRender();
        else if (model.tab == 2)
            techsRender();
        else if (model.tab == 3)
            newsRender();

        $('#uxQtyDocs').html(`(${model.qty0})`);
        $('#uxQtyMedias').html(`(${model.qty1})`);
        $('#uxQtyTechs').html(`(${model.qty2})`);
        $('#uxQtyNews').html(`(${model.qty3})`);

        checkedsRender();
        pagerRender('#uxPager1');
        pagerRender('#uxPager2');

        $('.pinned').hcSticky('refresh');

        $("[title]").tooltipster({
            animation: 'fade',
            delay: 200,
            theme: 'tooltipster-default',
            trigger: 'hover'
        });
    }

    function clearPage() {
        model.pagina == 0;
    }

    function pagerRender(qs) {
        let html = '';

        if (getQty() <= model.filters.salto) {
            $(qs).html('');
            $(qs).hide();
            return;
        }

        let rango = 8;
        let min = 0;
        let max = rango - 1;

        html = `
    <div class="row pager">
        <div class="col-md-12 pager-numbers">
`;

        html += `
    <a href="#" class="page-number" data-page="0">
        <i class="fa fa-angle-double-left"></i>            
    </a>
`;

        min = model.pagina - (rango / 2);
        if (min < 0) min = 0;

        max = model.pagina + (rango / 2) + 1;
        if (max > model.paginas) max = model.paginas;

        if (min > 0)
            html += `...`;

        for (let x = min; x < max; x++) {
            html += htmlPagerNumber(x);
        }

        if (max < model.paginas - 1)
            html += `...`;

        html += `
    <a href="#" class="page-number" data-page="${model.paginas - 1}">
        <i class="fa fa-angle-double-right"></i>            
    </a>
`;

        html += `
        </div>
    </div>
`;

        $(qs).html(html);
        $(qs).show();
    }

    function htmlPagerNumber(pagina) {
        return `
    <a href="#" class="page-number${pagina == model.pagina ? '-active' : ''}" data-page="${pagina}">${pagina + 1}</a>
`;
    }

    function filtersRender() {
        let html = '';
        html += `<div class="accordion" id="uxFilters" class="pinned">`;
        $.each(model.filters.groups, function(gindex, group) {
            if (group.visible) {
                html += `
            <div class="card">
                <div class="card-header" id="group-${gindex}-header">
                    <button 
                        id="group-${gindex}-title" 
                        class="group-title btn btn-link" type="button" 
                        data-target="#group-${gindex}-body" 
                        data-group="${gindex}"
                        >
                    </button>
                </div>

                <div id="group-${gindex}-body" class="collapse ${group.collapsed ? '' : 'show'}"
                    data-parent="#uxFilters">
                    <div data-simplebar class="card-body group-container-items" style="max-height: 180px; overflow-y: auto;">
                        <ul class="list-group">
        `;

                $.each(group.items, function(iindex, item) {
                    if (!item.checked && item.total > 0) {
                        html += `
                <button type="button" class="filters-group-item list-group-item list-group-item-action" 
                    data-group="${gindex}" 
                    data-item="${iindex}">${item.label} (${item.total})</button>
                `;
                    }
                });

                html += `
                        </ul>
                    </div>
                </div>
            </div>
        `;
            }
        });

        html += `
    <div class="card">
        <div class="card-header" id="group-desde-header" style="padding: 7px 4px 3px 16px;">
            <div class="row">
                <div class="col-md-4">
                    Desde:
                </div>
                <div class="col-md-8 text-right">
                    <input id="uxDesde" value="${model.filters.dateStart}" type="text" class="date" style='border: none; width: 100px;'>
                    <span id="uxDesdeIcon" style="cursor: pointer;"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
        </div>
    </div>
`

        html += `
    <div class="card">
        <div class="card-header" id="group-hasta-header" style="padding: 7px 4px 3px 16px;">
            <div class="row">
                <div class="col-md-4">
                    Hasta:
                </div>
                <div class="col-md-8 text-right">
                    <input id="uxHasta" value="${model.filters.dateEnd}" type="text" class="date" style='border: none; width: 100px;'>
                    <span id="uxHastaIcon" style="cursor: pointer;"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
        </div>
    </div>
`

        html += `</div>`;
        $('#uxFilters-box').html(html);

        groupsTitleRender();

        // BIND EVENTS DATE PICKER
        $('.date').datepicker({
            format: "dd/mm/yyyy",
            language: "es",
            autoclose: true,
            clearBtn: true,
            todayHighlight:true,
            toggleActive: true
        });

        $('#uxDesdeIcon').on('click', function() {
            $('#uxDesde').focus();
            $('#uxDesde').datepicker('show');
        });

        $('#uxHastaIcon').on('click', function() {
            $('#uxHasta').focus();
            $('#uxHasta').datepicker('show');
        });

        $('#uxDesde').on('changeDate', function(e) {
            let d = moment($('#uxDesde').val(), 'DD/MM/YYYY');
            let h = moment($('#uxHasta').val(), 'DD/MM/YYYY');

            if (d.isValid() && h.isValid() && d > h) {
                alert('La fecha desde no puede ser superior a la fecha hasta!');
                $('#uxDesde').val('');
                return;
            }

            model.filters.dateStart = $('#uxDesde').val();
            dataLoad();
        });

        $('#uxHasta').on('changeDate', function(e) {
            let d = moment($('#uxDesde').val(), 'DD/MM/YYYY');
            let h = moment($('#uxHasta').val(), 'DD/MM/YYYY');

            if (d.isValid() && h.isValid() && h < d) {
                alert('La fecha hasta no puede ser inferior a la fecha desde!');
                $('#uxHasta').val('');
                return;
            }

            model.filters.dateEnd = $('#uxHasta').val();
            dataLoad();
        });
    }

    function checkedsRender() {
        $('#uxFiltersChecked').html('');

        if (model.filters.searchText) {
            $('#uxFiltersChecked').append(`
                <a class="btn btn-warning btn-xs"
                data-estudio="-1"> 
                    Busqueda: ${model.filters.searchText}
                </a>
            `)
        }

        // FECHAS
        if (model.filters.dateStart != '') {
            $('#uxFiltersChecked').append(`
                <a class="btn btn-warning btn-xs">${model.filters.dateStart} - ${model.filters.dateEnd}</a>
            `)
        }

        if (model.filters.mode_label) {
            let nombre = '';
            let title = model.filters.mode_label;

            if (title.length > 25) {
                nombre = title.substr(0, 25) + '...';
            } else {
                nombre = title;
            }

            $('#uxFiltersChecked').append(`
        <a class="btn btn-warning btn-xs" ${nombre != model.filters.mode_label ? `title="${model.filters.mode_label}"` : ``} data-estudio="1">Estudio: ${nombre}</a>
    `)

}

$.each(model.filters.groups, function (gindex, group) {
    $.each(group.items, function (iindex, item) {
        if (item.checked) {
            $('#uxFiltersChecked').append(`
                <a class="filters-checked btn btn-warning btn-xs" data-group="${gindex}" data-item="${iindex}">${item.label} (${item.total}) <i class="fa fa-times" style="padding-right: 6px;"></i></a>
            `)
        }
    });
});

// RESET FILTROS, TODOS
if ($('#uxFiltersChecked').html()) {
    $('#uxFiltersChecked').append(`
        <a class="filters-clear filters-checked btn btn-danger btn-xs" style="color: #fff;" data-estudio="-2">Limpiar filtros</a>
    `)
}
}

function fichaRender() {
let htmlLinkVisor = '';
if (model.ficha.linkvisor != '')
    htmlLinkVisor = `<a href="${model.ficha.linkvisor}" target="_blank" class="btn btn-xs btn-warning">Visualizar</a>`;

let htmlLinkDescarga = '';
if (model.ficha.linkdescarga != '' && model.ficha.linkdescarga != model.ficha.linkvisor)
    htmlLinkDescarga = `<a href="${model.ficha.linkdescarga}" target="_blank" class="btn btn-xs btn-warning">Descargar</a>`;

let html = '';
html += `
    <div class="row">
        <div class="col-md-4">
            <div class="ficha-preview">
                <img src="${model.ficha.link_preview}" class="pop" />
            </div>
        </div>
        <div class="col-md-8">
            <div class="ficha-title">${model.ficha.title}</div>
            <div class="ficha-temporal">${model.ficha.temporal}</div>
            <div class="ficha-autores">${model.ficha.autores}</div>
            <div class="ficha-description">${model.ficha.description}</div>
            ${htmlLinkVisor}
            ${htmlLinkDescarga}
        </div>
    </div>
`;
$('#uxFicha .modal-body').html(html);
}

function docsRender() {
let html = '';
let tituloTmp = ''
$.each(model.data.docs, function (index, doc) {
    let title = doc.title.split('- Estudio:')
    if(title[0] !== tituloTmp){
    tituloTmp = title[0]

    let optionEstudios = ''    
    $.each(doc.estudios, function (index, estudio) {
            optionEstudios += `<option value=${estudio.Estudio_ID}> ${estudio.Estudio}</option>`        
    })

    links = `
        <div class="col-3 " style="padding-right: 0px; width: 90%;"> </div>
        <div class=" col-9">
            <div>
                <select class="form-select-sm custom-select select-estudios" id="select-estudios${doc.id}" data-id="${doc.id}" style="width: 80%;">
                    <option selected disabled> Seleccione un estudio... </option>
                    <b>${optionEstudios}</b>
                </select>
            </div>
            <div class="doc-links">
                <a data-solapa="1" data-mode="0" data-mode_id="" class="mt-1 btn btn-dark estudios-link text-white disabled links-modal${doc.id}">
                    RECURSOS AUDIOVISUALES
                </a>
                <a data-solapa="2" data-mode="0" data-mode_id="" class="mt-1 btn btn-dark estudios-link text-white disabled links-modal${doc.id}">
                    RECURSOS TÉCNICOS
                </a>
                <a data-solapa="0" data-mode="1" data-mode_id="" class="mt-1 btn btn-dark estudios-link text-white disabled links-modal${doc.id}">
                    RECURSOS ASOCIADOS
                </a>
            </div>
        </div>
    `;


    html += `
    <div id="ficha">
        <div class="doc row" data-id="${doc.id}" data-origen="${doc.origen_id}">
            <div class="col-3" style="padding-right: 0px;">
                <div class="doc-preview">
                    <img src="${doc.link_preview}" />
                </div>
            </div>
            <div class="col-9" style="margin-left: 0px;">
                <div class="doc-title">
                    <div class="doc-title-icon">
                        <img src="${doc.ico}" />
                    </div>
                    <div class="doc-title-text">
                        ${title}
                    </div>
                </div>
                <div class="doc-autores">${doc.autores}</div>
                <div class="doc-description">${doc.description}</div>
            </div>
        </div>
            <div class="doc row fichaBtn">
            ${links}
        </div>
    </div>
    `;
}   
});

if (html == '') {
    html = '<h2 class="sin-resultados">No se encontraron resultados con los filtros seleccionados</h2>'
}

$('#uxData').html(html);

//CHANGE DEL SELECT DEL ESTUDIO EN MODAL
$('.select-estudios').on('change', function() {
    let docEstudio = $(this).val()
    let dataId = $(this).data('id')

    if(docEstudio > 0){
        $('.links-modal'+dataId).removeClass('disabled')
        $('.links-modal'+dataId).attr('data-mode_id', docEstudio)
    }else{
        $('.links-modal'+dataId).addClass('disabled')
    }
    
});
}

function mediasRender() {
let html = '';
html += `<div class="container">`;
html += `<div class="row">`;

let row = 0;
let col = 0;
$.each(model.data.medias, function (index, item) {
    let i = `
        <div class="media col-sm-2" data-toggle="collapse" href="#uxPreview_${row}" data-id="${item.id}" data-origen="${item.origen_id}" data-row="${row}">
            <div class="media-border">
                <div class="media-img" style="background-image: url('${item.link_preview}');">
                </div>
                <div class="media-info">
                    ${item.title.substr(0, 40)}<br />
                    ${item.tema.substr(0, 40)}<br />
                </div>
            </div>
        </div>
    `;
    html += i;

    col++;
    if (col == 6) {
        html += `
            <div id="uxPreview_${row}" class="collapse col-sm-12 media-preview">
            </div>
        `;
        row++;
        col = 0;
    }
});

html += `
    <div id="uxPreview_${row}" class="collapse col-sm-12 media-preview">
    </div>
`;
html += `</div>`;
html += `</div>`;

if (row == 0 && col == 0) {
    html = '<h2 class="sin-resultados">No se encontraron resultados con los filtros seleccionados</h2>'
}

$('#uxData').html(html);
}

function techsRender() {
let html = '';
let tituloTmp = ''
$.each(model.data.techs, function (index, doc) {
    let title = doc.title.split('- Estudio:')
    if(title[0] !== tituloTmp){
    tituloTmp = title[0]
    
    let links = '';
    if (doc.estudio > 0) {

        let optionEstudios = ''    
        $.each(doc.estudios, function (index, estudio) {
                optionEstudios += `<option value=${estudio.Estudio_ID}> ${estudio.Estudio}</option>`        
        })


        links = `
            <div class="col-3 " style="padding-right: 0px; width: 90%;"> </div>
            <div class=" col-9" >
                <div>
                    <select class="form-select-sm custom-select select-estudios" id="select-estudios${doc.id}" data-id="${doc.id}" style="width: 80%;">
                        <option selected disabled> Seleccione un estudio... </option>
                        <b>${optionEstudios}</b>
                    </select>
                </div>
                <div class="doc-links">
                    <a data-solapa="0" data-mode="0" data-mode_id="" class="mt-1 btn btn-dark estudios-link text-white disabled links-modal${doc.id}">
                    DOCUMENTOS ASOCIADOS</a>
                    <a data-solapa="2" data-mode="1" data-mode_id="" class="mt-1 btn btn-dark estudios-link text-white disabled links-modal${doc.id}">
                    RECURSOS ASOCIADOS</a>
                </div>
            </div>
        `;
    }

    html += `
    <div id="ficha">
        <div class="doc row" data-id="${doc.id}" data-origen="${doc.origen_id}">
            <div class="col-3 " style="padding-right: 0px;">
                <div class="doc-preview">
                    <img src="${doc.link_preview}" />
                </div>
            </div>
            <div class="col-9 ">
                <div class="doc-title">
                    <div class="doc-title-icon"> <img src="${doc.ico}" /> </div>
                    <div class="doc-title-text"> ${title}  </div>
                </div>
                <div>
                    <div class="doc-autores">${doc.autores}</div>
                    <div class="doc-description">${doc.description}</div>
                </div>
            </div>
        </div>
        <div class="doc row fichaBtn" style="padding-top: 0px;">
            ${links}
        </div>
    </div>
    `;
}
});

if (html == '') {
    html = '<h2 class="sin-resultados">No se encontraron resultados con los filtros seleccionados</h2>'
}

$('#uxData').html(html);

//CHANGE DEL SELECT DEL ESTUDIO EN MODAL
$('.select-estudios').on('change', function() {
    let docEstudio = $(this).val()
    let dataId = $(this).data('id')

    if(docEstudio > 0){
        $('.links-modal'+dataId).removeClass('disabled')
        $('.links-modal'+dataId).attr('data-mode_id', docEstudio)
    }else{
        $('.links-modal'+dataId).addClass('disabled')
    }
    
});
}

function newsRender() {
let html = '';

$.each(model.data.news, function (index, news) {
    html += `
        <div class="news row" data-id="${news.id}" data-origen="${news.origen_id}">
            <div class="col-3" style="padding-right: 0px;">
                <div class="news-preview">
                    <img src="${news.link_preview}" />
                </div>
            </div>
            <div class="col-9" style="margin-left: 0px;">
                <div class="news-title">
                    <div class="news-title-icon">
                        <img src="${news.ico}" />
                    </div>
                    <div class="news-title-text">
                        ${news.title}
                    </div>
                </div>
                <div class="news-fecha">${moment(news.fecha).format('DD [de] MMMM [de] YYYY')}</div>
                <div class="news-description">${news.description}</div>
            </div>
        </div>
    `;
});

if (html == '') {
    html = '<h2 class="sin-resultados">No se encontraron resultados con los filtros seleccionados</h2>'
}

$('#uxData').html(html);
}

function uncheckAllGroups() {
$.each(model.filters.groups, function (gindex, group) {
    $.each(group.items, function (iindex, item) {
        item.checked = false;
    });
});
}

function collapseAllGroups() {
$.each(model.filters.groups, function (gindex, group) {
    group.collapsed = true;
});
}

function qtyItemsVisibles(group) {
let qty = 0;
$.each(group.items, function (iindex, item) {
    qty = qty + ((!item.checked && item.total > 0) ? 1 : 0);
});
return qty;
}

function idItemsChecked(group) {
let qs = '';
$.each(group.items, function (iindex, item) {
    if (item.checked) {
        qs += item.id + ',';
    }
});

if (qs != '')
    qs = qs.substr(0, qs.length - 1);

return qs;
}

function groupsTitleRender() {
$.each(model.filters.groups, function (gindex, group) {
    let html = `
        <div class="row">
            <div class="col-md-10 filter-title">
                ${group.title} (${qtyItemsVisibles(group)})
            </div>
            <div class="col-md-2 text-right filter-title" style="padding-right: 4px;">
                ${group.collapsed ? '<i class="fa fa-plus-circle"></i>' : '<i class="fa fa-minus-circle"></i>'}
            </div>
        </div>
    `;
    $(`#group-${gindex}-title`).html(html);
});
}

function makeUrlFilter() {
let params = {
    s: model.filters.searchText,
    o: model.filters.orden,
    ds: model.filters.dateStart != '' ? moment(model.filters.dateStart, 'DD/MM/YYYY').format(
        'DD/MM/YYYY') : '',
    de: model.filters.dateEnd != '' ? moment(model.filters.dateEnd, 'DD/MM/YYYY').format(
        'DD/MM/YYYY') : '',
    proyecto: idItemsChecked(model.filters.groups[0]),
    documento: idItemsChecked(model.filters.groups[model.tab + 1]),
    tema: idItemsChecked(model.filters.groups[4]),
    subtema: idItemsChecked(model.filters.groups[5]),
    mode: model.filters.mode,
    mode_id: model.filters.mode_id,
    solapa: model.tab,
    pagina: model.pagina,
    salto: model.salto
};
return jQuery.param(params);
}

function initFiltersGroups() {
return [{
        title: 'Obra/Proyecto',
        collapsed: false,
        visible: true,
        items: []
    },
    {
        title: '&Aacute;rea de Gestión',
        collapsed: true,
        visible: true,
        items: []
    },
    {
        title: 'Recursos Audiovisuales',
        collapsed: true,
        visible: false,
        items: []
    },
    {
        title: 'Recursos Técnicos',
        collapsed: true,
        visible: false,
        items: []
    },
    {
        title: 'Área Temática',
        collapsed: true,
        visible: true,
        items: []
    },
    {
        title: 'Tema',
        collapsed: true,
        visible: true,
        items: []
    },
];
}
});
