$(document).ready(function() {
    var model = {
        apiUrlBase: GlobaApiUrl,
        tab: 0,
        paginas: 0,
        qty0: 0,
        qty1: 0,
        qty2: 0,
        estudio_nombre: '',
        stopLoad: false,
        filters: {
            pagina: 0,
            salto: 20,

            orden: 0,
            searchText: '',
            dateStart: '',
            dateEnd: '',
            estudio: null,
            groups: initFiltersGroups()
        },
        data: {
            docs: [],
            medias: [],
            techs: [],
        },
        ficha: null
    };

    init();

    // POP IMAGE
    $('body').on('click', '.pop', function() {
        $('.imagepreview').attr('src', $(this).attr('src'));
        $('#imagemodal').modal('show');
    });

    // CHANGE PAGE
    $('body').on('click', '.page-number', function() {
        let pagina = $(this).data('page');
        model.pagina = pagina;
        dataLoad();
        dataRender();
    });

    // REMOVE FILTER
    $('body').on('click', '.filters-checked', function() {
        let estudio = $(this).data('estudio');
        let group = $(this).data('group');
        let item = $(this).data('item');

        if (estudio == 1) {
            setEstudio(null);
            model.estudio_nombre = '';
        } else {
            model.filters.groups[group].items[item].checked = false;
        }

        //setEstudio(null);
        filtersRender();
        model.pagina = 0;
        dataLoad();
    });

    // ADD FILTER
    $('body').on('click', '.filters-group-item', function(e) {
        let group = $(this).data('group');
        let item = $(this).data('item');
        model.filters.groups[group].items[item].checked = true;
        //setEstudio(null);
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

        model.stopLoad = true;
        setSolapa($(this).data('solapa'));
        setEstudio($(this).data('estudio'));
        model.stopLoad = false;
        model.pagina = 0;

        if (model.tab == 0) {
            model.ra = 1;
        }

        filtersRender();
        dataLoad();
    });

    // CLICK EN DOC PARA POPUP FICHA
    $('body').on('click', '.doc, .tech', function(e) {
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
                        <div class="media-extra" data-link="${linkimg}" data-target="#uxPreview_${row}" style="
                                cursor: pointer;
                                width: 100%;
                                height:60px;
                                background-image: url(${linkimg});
                                background-repeat: no-repeat;
                                background-position: center center;
                                background-size: cover;    
                            "></div>
                    </div>
                `
            });

            let html = `
                <div class="row">
                    <div class="col-sm-6">
                        <div class="preview-image pop"
                        src="${model.ficha.linkimagen}" 
                        style="
                            width: 100%;
                            height:260px;
                            background-image: url(${model.ficha.linkimagen});
                            background-repeat: no-repeat;
                            background-position: center center;
                            background-size: cover;    
                        "></div>
                    </div>
                    <div class="col-sm-6" style="max-height: 260px; overflow-y: scroll;">
                        <div class="preview-datos">
                            <div class="preview-title">${model.ficha.title}</div>
                            <div class="preview-estudio">${model.ficha.estudio}</div>
                            <div class="preview-autores">Autores: ${model.ficha.authors}</div>
                            <div class="preview-fecha">Fecha: ${model.ficha.fecha}</div>
                            <div class="preview-tema-subtema">Tema/Subtema: ${model.ficha.tema_subtema}</div>
                            <div class="preview-proyecto">Proyecto: ${model.ficha.proyecto}</div>
                            <div class="preview-imagenes" style="overflow: hide;">
                                ${imagenes}
                            </div>
                            <a class="media-preview-link btn btn-warning btn-xs" data-solapa="1" data-estudio="${model.ficha.estudio_id}">Imagenes asociadas</a>
                            </div>
                        </div>
                </div>
            `;
            $('#uxPreview_' + row).html(html);

            $('body, html').animate({
                scrollTop: $('#uxPreview_' + row).offset().top - 300
            }, 500);

        });
    });

    $('body').on('click', '.media-extra', function(e) {
        let target = $(this).data('target');
        let linkcss = $(this).css('background-image');
        let link = $(this).data('link');
        $(target).find('.preview-image').css('background-image', linkcss);
        $(target).find('.preview-image').attr('src', link);
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

        filtersLoad();
        dataLoad();
    }

    function getQty() {
        if (model.tab == 0) return model.qty0;
        else if (model.tab == 1) return model.qty1;
        else return model.qty2;
    }

    function filtersLoad() {
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
                    parentId: value.parent_valor_id
                });
            });

            filtersRender();
        });
    }

    function isParentChecked(parentId) {

    }

    function dataLoad() {
        if (model.stopLoad)
            return;

        var url = model.apiUrlBase + '/mediateca_find_pag.php?' + makeUrlFilter();
        //console.log(url);

        $.getJSON(url, function(data) {
            model.solapa = data.solapa;
            model.paginas = data.paginas;
            model.pagina = data.pagina;
            model.salto = data.rec_per_page;
            model.qty0 = data.registros_total_0;
            model.qty1 = data.registros_total_1;
            model.qty2 = data.registros_total_2;
            model.estudio_nombre = data.estudio_nombre;

            model.ra = 0;
            model.data.docs = [];
            model.data.medias = [];
            model.data.techs = [];
            $.each(data.recordset, function(index, value) {
                if (value.Solapa == 0) {
                    model.data.docs.push({
                        id: value.Id,
                        origen_id: value.origen_id,
                        link_preview: model.apiUrlBase + '/mediateca_preview.php?r=' + value.Id + '&origen_id=' + value.origen_id,
                        title: value.Titulo,
                        authors: value.Autores,
                        description: value.Descripcion,
                        estudio: value.estudios_id
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
                        autor: 'autor',
                        fecha: 'fecha'
                    });
                } else if (value.Solapa == 2) {
                    model.data.techs.push({
                        id: value.Id,
                        origen_id: value.origen_id,
                        link_preview: model.apiUrlBase + '/mediateca_preview.php?r=' + value.Id + '&origen_id=' + value.origen_id,
                        title: value.Titulo,
                        authors: value.Autores,
                        description: value.Descripcion,
                        estudio: value.estudios_id
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
                authors: data.autores,
                description: data.descripcion,
                estudio: data.estudio,
                linkimagen: data.linkdescarga,
                linkvisor: data.linkvisor,
                linkdescarga: data.linkdescarga,
                fecha: data.fecha,
                tema_subtema: data.tema_subtema,
                proyecto: data.proyecto,
                estudio_id: data.estudio_id,
                linkimagenes: data.linkimagenes
            };

            callbackRender();
        });
    }

    function setSolapa(solapa) {
        $(`a[data-tab="${model.tab}"]`).removeClass('active');
        model.tab = solapa;
        $(`a[data-tab="${model.tab}"]`).addClass('active');
    }

    function setEstudio(estudio) {
        //if (estudio)
        //    filtersReset();

        model.filters.estudio = estudio;
    }

    function filtersReset() {
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

        $('#uxQtyDocs').html(`(${model.qty0})`);
        $('#uxQtyMedias').html(`(${model.qty1})`);
        $('#uxQtyTechs').html(`(${model.qty2})`);

        checkedsRender();

        pagerRender('#uxPager1');
        pagerRender('#uxPager2');
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
        html += `<div class="accordion" id="uxFilters">`;
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
                    if (!item.checked) {
                        html += `
                        <button type="button" class="filters-group-item list-group-item list-group-item-action" 
                            data-group="${gindex}" 
                            data-item="${iindex}">${item.label}</button>
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
        $('#uxFilters').html(html);

        groupsTitleRender();

        // BIND EVENTS DATE PICKER
        $('.date').datepicker({
            format: "dd/mm/yyyy",
            language: "es",
            autoclose: true,
            clearBtn: true,
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

    function subtemaIncluded(id) {
        //alert(JSON.stringify(model.filters.groups[3]))

        //$.each(model.filters.groups[3].items, function(index, value) {
        //    if (value.checked)
        //        alert(value.id)
        //});

        //.............

        return true;
    }

    function checkedsRender() {
        $('#uxFiltersChecked').html('');

        if (model.estudio_nombre != '') {
            $('#uxFiltersChecked').append(`
                <a class="filters-checked btn btn-success btn-xs" style="color: #fff;" data-estudio="1">${model.estudio_nombre} <i class="fa fa-times" style="padding: 0px 6px;"></i></a>
            `)
        }

        $.each(model.filters.groups, function(gindex, group) {
            $.each(group.items, function(iindex, item) {
                if (item.checked) {
                    $('#uxFiltersChecked').append(`
                        <a class="filters-checked btn btn-warning btn-xs" data-group="${gindex}" data-item="${iindex}">${item.label} <i class="fa fa-times" style="padding-right: 6px;"></i></a>
                    `)
                }
            });
        });
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
                    <div class="ficha-estudio">${model.ficha.estudio}</div>
                    <div class="ficha-authors">${model.ficha.authors}</div>
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

        $.each(model.data.docs, function(index, doc) {
            html += `
                <div class="doc row" data-id="${doc.id}" data-origen="${doc.origen_id}">
                    <div class="col-3" style="padding-right: 0px;">
                        <div class="doc-preview">
                            <img src="${doc.link_preview}" />
                        </div>
                    </div>
                    <div class="col-9" style="margin-left: 0px;">
                        <div class="doc-title">
                            <img class="doc-icon" src="./images/pdf.png" style="width: 40px; height: auto;" />
                            ${doc.title}
                        </div>
                        <div class="doc-authors">${doc.authors}</div>
                        <div class="doc-description">${doc.description}</div>
                        <div class="doc-links" style="z-index:999;">
                            <a data-solapa="1" data-estudio="${doc.estudio}" class="btn btn-dark estudios-link">RECURSOS AUDIOVISUALES</a>
                            <a data-solapa="2" data-estudio="${doc.estudio}" class="btn btn-dark estudios-link">RECURSOS TÉCNICOS</a>
                            <a data-solapa="0" data-estudio="${doc.estudio}" class="btn btn-dark estudios-link">RECURSOS ASOCIADOS</a>
                        </div>
                    </div>
                </div>
            `;
        });

        if (html == '') {
            html = '<h2 class="sin-resultados">No se encontraron resultados con los filtros seleccionados</h2>'
        }

        $('#uxData').html(html);
    }

    function mediasRender() {
        let html = '';
        html += `<div class="container">`;
        html += `<div class="row">`;

        let row = 0;
        let col = 0;
        $.each(model.data.medias, function(index, item) {
            let i = `
                <div class="media col-sm-2" data-toggle="collapse" href="#uxPreview_${row}" data-id="${item.id}" data-origen="${item.origen_id}" data-row="${row}">
                    <div class="media-border">
                        <div class="media-img" style="background-image: url(${item.link_preview});">
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
        $.each(model.data.techs, function(index, doc) {
            html += `
                <div class="doc row" data-id="${doc.id}" data-origen="${doc.origen_id}">
                <div class="col-3" style="padding-right: 0px;">
                    <div class="doc-preview">
                        <img src="${doc.link_preview}" />
                    </div>
                </div>
                <div class="col-9">
                        <div class="doc-title">
                            <img class="doc-icon" src="./images/pdf.png" style="width: 40px; height: auto;" />
                            ${doc.title}
                        </div>
                        <div class="doc-authors">${doc.authors}</div>
                        <div class="doc-description">${doc.description}</div>
                        <div class="doc-links">
                            <a data-solapa="0" data-estudio="${doc.estudio}" class="btn btn-dark estudios-link">DOCUMENTOS ASOCIADOS</a>
                            <a data-solapa="0" data-estudio="${doc.estudio}" class="btn btn-dark estudios-link">RECURSOS ASOCIADOS</a>
                        </div>
                    </div>
                </div>
            `;
        });

        if (html == '') {
            html = '<h2 class="sin-resultados">No se encontraron resultados con los filtros seleccionados</h2>'
        }

        $('#uxData').html(html);

        /*
            let html = '';
            $.each(model.data.techs, function(index, item) {
                html += `
                    <div class="tech row" data-id="${item.id}" data-origen="${item.origen_id}" style="margin-bottom: 6px; margin-left: 0px; cursor: pointer;">
                        <span class="badge badge-warning" style="color: #fff; font-size: 100%; padding: 8px; margin-right: 6px;">${item.metatag}</span>
                        ${item.title}
                    </div>
                `;
            });
            $('#uxData').html(html);
        */
    }

    function uncheckAllGroups() {
        $.each(model.filters.groups, function(gindex, group) {
            $.each(group.items, function(iindex, item) {
                item.checked = false;
            });
        });
    }

    function collapseAllGroups() {
        $.each(model.filters.groups, function(gindex, group) {
            group.collapsed = true;
        });
    }

    function qtyItemsNotChecked(group) {
        let qty = 0;
        $.each(group.items, function(iindex, item) {
            qty = qty + (!item.checked ? 1 : 0);
        });
        return qty;
    }

    function idItemsChecked(group) {
        let qs = '';
        $.each(group.items, function(iindex, item) {
            if (item.checked) {
                qs += item.id + ',';
            }
        });

        if (qs != '')
            qs = qs.substr(0, qs.length - 1);

        return qs;
    }

    function groupsTitleRender() {
        $.each(model.filters.groups, function(gindex, group) {
            let html = `
                <div class="row">
                    <div class="col-md-10 filter-title">
                        ${group.title} (${qtyItemsNotChecked(group)})
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
            estudio_id: model.filters.estudio,
            ra: model.ra,

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
                title: 'Area de Gestión',
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
                title: 'Tema',
                collapsed: true,
                visible: true,
                items: []
            },
            {
                title: 'Subtema',
                collapsed: true,
                visible: true,
                items: []
            },
        ];
    }
});