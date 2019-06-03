<?php include("./header.php"); ?>

<div class="row" id="page_mediateca">
    <div class="col-md-12 page-title">
        Recursos en Mediateca
    </div>
    <div class="col-md-12 page-search">
        <div class="row">

            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input id="uxSearchText" name="uxSearchText" type="text" class="form-control">
                    <div class="input-group-append">
                        <span class="input-group-text" id="uxSearchButton">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
                <div id="uxUrl"></div>
            </div>

            <div class="col-md-6 text-right">
                <select id="uxOrden" class="selectpicker">
                    <option value="0">A - Z</option>
                    <option value="1">Z - A</option>
                    <option value="2">Más vistos</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-12 page-tabs">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-tab="0" href="#">DOCUMENTOS <span id="uxQtyDocs"></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-tab="1" href="#">RECURSOS AUDIOVISUALES <span id="uxQtyMedias"></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-tab="2" href="#">RECURSOS TECNICOS <span id="uxQtyTechs"></span></a>
            </li>
        </ul>

        <div class="row">
            <div id="x0" class="col-md-3">
                <div class="filters-header">Refina sus resultados</div>
                <div id="uxFilters"></div>
            </div>
            <div class="col-md-9">
                <div id="uxFiltersChecked"></div>
                <div id="uxData"></div>
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
$(document).ready(function() {
    var model = {
        apiUrlBase: 'http://observatorio.atic.com.ar',
        tab: 0,
        filters: {
            orden: 0,
            searchText: '',
            dateStart: '', 
            dateEnd: '',
            groups: initFiltersGroups()
        },
        data: {
            docs: [],
            medias: [],
            techs: [],
        }
    };

    init();

    // TEXT SEARCH
    $('#uxSearchButton').on('click', function() {
        model.filters.searchText = $('#uxSearchText').val();
        dataLoad()
    });

    // REMOVE FILTER
    $('body').on('click', '.filters-checked', function() {
        let group = $(this).data('group');
        let item = $(this).data('item');
        model.filters.groups[group].items[item].checked = false;
        filtersRender();
        dataLoad()
    });

    // ADD FILTER
    $('body').on('click', '.filters-group-item', function(e) {
        let group = $(this).data('group');
        let item = $(this).data('item');
        model.filters.groups[group].items[item].checked = true;
        filtersRender();
        dataLoad()
    });

    // GROUP COLLAPSE
    $('body').on('click', '.group-title', function() {
        let index = $(this).data('group');
        let collapsed = $($(this).data('target')).hasClass('show');
        let group = model.filters.groups[index];

        collapseAllGroups();
        group.collapsed = collapsed;
        groupsTitleRender();
    });

    // ORDEN
    $('#uxOrden').on('change', function() {
        model.filters.orden = $('#uxOrden').val();
        dataLoad()
    });

    // CLICK ON TAB
    $('a[data-tab]').on('click', function (e) {
        $(`a[data-tab="${model.tab}"]`).removeClass('active');
        model.tab = $(this).data('tab');
        $(`a[data-tab="${model.tab}"]`).addClass('active');
        
        if (model.tab == 2) {
            model.filters.groups[1].visible = false;
            model.filters.groups[2].visible = true;
        }
        else {
            model.filters.groups[1].visible = true;
            model.filters.groups[2].visible = false;
        }

        filtersRender();
        dataRender();
    })

    //-----------------------------------------------------
    function init() {
        filtersLoad();
        dataLoad();
    }

    function filtersLoad() {
        model.filters.groups = initFiltersGroups();
        $.getJSON(model.apiUrlBase + '/mediateca_filtros.php', function(data) {
            $.each(data, function(index, value) {
                let gindex = value.filtro_id;
                model.filters.groups[gindex].items.push({
                    id: value.valor_id,
                    label: value.valor_desc,
                    checked: false
                });
            });
            filtersRender();
        });
    }

    function dataLoad() {
        let url = model.apiUrlBase + '/mediateca_find.php?' + makeUrlFilter();
        $('#uxUrl').html(url);

        $.getJSON(url, function(data) {
            model.data.docs = [];
            model.data.medias = [];
            model.data.techs = [];
            $.each(data, function(index, value) {
                if (value.Solapa == 0) {
                    model.data.docs.push({
                        id: value.Id,
                        title: value.Titulo,
                        authors: value.Autores,
                        description: value.Descripcion
                    });
                }
                else if (value.Solapa == 1) {
                    model.data.medias.push({
                        id: value.Id,
                        link: value.LinkImagen,
                        title: value.Titulo
                    });
                }
                else if (value.Solapa == 2) {
                    model.data.techs.push({
                        id: value.Id,
                        metatag: value.MetaTag,
                        title: value.Titulo,
                        description: value.Descripcion
                    });
                }
            });
            dataRender();
        });
    }

    function dataRender() {
        if (model.tab == 0)
            docsRender();
        else if (model.tab == 1)
            mediasRender();
        else if (model.tab == 2)
            techsRender();

        $('#uxQtyDocs').html(`(${model.data.docs.length})`);
        $('#uxQtyMedias').html(`(${model.data.medias.length})`);
        $('#uxQtyTechs').html(`(${model.data.techs.length})`);

        $('#uxSearchText').focus();
    }

    function filtersRender() {
        let html = '';
        html += `<div class="accordion" id="uxFilters">`;
        $.each(model.filters.groups, function(gindex, group) {
            if (group.visible) {
                html += `
                    <div class="card">
                        <div class="card-header" id="group-${gindex}-header">
                            <button id="group-${gindex}-title" class="group-title btn btn-link" type="button" data-toggle="collapse"
                                data-target="#group-${gindex}-body" data-group="${gindex}">
                                ...
                            </button>
                        </div>

                        <div id="group-${gindex}-body" class="collapse ${group.collapsed ? '' : 'show'}"
                            data-parent="#uxFilters">
                            <div class="card-body group-container-items" style="max-height: 14em; overflow-y: scroll;">
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
                <div class="card-header" id="group-desde-header" style="padding: 5px 4px 5px 16px;">
                    <div class="row">
                        <div class="col-md-4">
                            Desde:
                        </div>
                        <div class="col-md-8 text-right">
                            <input id="uxDesde" value="${model.filters.dateStart}" type="text" class="date" style='border: none; width: 100px;'>
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>
                </div>
            </div>
        `

        html += `
            <div class="card">
                <div class="card-header" id="group-hasta-header" style="padding: 5px 4px 5px 16px;">
                    <div class="row">
                        <div class="col-md-4">
                            Hasta:
                        </div>
                        <div class="col-md-8 text-right">
                            <input id="uxHasta" value="${model.filters.dateEnd}" type="text" class="date" style='border: none; width: 100px;'>
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>
                </div>
            </div>
        `
        html += `</div>`;
        $('#uxFilters').html(html);

        groupsTitleRender();
        checkedsRender();

        // BIND EVENTS DATE PICKER
        $('.date').datepicker({
            format: "dd/mm/yyyy",
            language: "es",
            autoclose: true
        });

        $('#uxDesde').on('changeDate', function(e) {
            model.filters.dateStart = $('#uxDesde').val();
            dataLoad()
        });

        $('#uxHasta').on('changeDate', function(e) {
            model.filters.dateEnd = $('#uxHasta').val();
            dataLoad()
        });
    }

    function checkedsRender() {
        $('#uxFiltersChecked').html('');
        $.each(model.filters.groups, function(gindex, group) {
            $.each(group.items, function(iindex, item) {
                if (item.checked) {
                    $('#uxFiltersChecked').append(`
                        <a class="filters-checked btn btn-warning" data-group="${gindex}" data-item="${iindex}">${item.label} <i class="fa fa-times"></i></a>
                    `)
                }
            });
        });
    }

    function docsRender() {
        let html = '';
        $.each(model.data.docs, function(index, doc) {
            html += `
                <div class="doc">
                    <div class="doc-title">
                        <img class="doc-icon" src="./images/icon-pdf-file.png" />
                        ${doc.title}
                    </div>
                    <div class="doc-authors">${doc.authors}</div>
                    <div class="doc-description">${doc.description}</div>
                    <div class="doc-links">
                        <a class="btn btn-dark">RECURSOS AUDIOVISUALES</a>
                        <a class="btn btn-dark">RECURSOS TECNICOS</a>
                        <a class="btn btn-dark">RECURSOS ASOCIADOS</a>
                    </div>
                </div>
            `;
        });
        $('#uxData').html(html);
    }

    function mediasRender() {
        let html = '';
        $.each(model.data.medias, function(index, item) {
            html += `
                <div class="media">
                </div>
            `;
        });
        $('#uxData').html(html);
    }

    function techsRender() {
        let html = '';
        $.each(model.data.techs, function(index, item) {
            html += `
                <div class="tech row" style="margin-bottom: 6px; margin-left: 0px;">
                        <span class="badge badge-warning" style="color: #fff; font-size: 100%; padding: 8px; margin-right: 6px;">${item.title}</span>
                        ${item.description}
                </div>
            `;
        });
        $('#uxData').html(html);
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
            let html =
                `${group.title} (${qtyItemsNotChecked(group)}) <i class="fa fa-${group.collapsed ? 'plus' : 'minus'}-circle"></i>`;
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
            documento: idItemsChecked(model.filters.groups[model.tab == 0 ? 1 : 2]),
            tema: idItemsChecked(model.filters.groups[3]),
            subtema: idItemsChecked(model.filters.groups[4]),
        };
        return jQuery.param(params);
    }

    function initFiltersGroups() {
        return [{
                title: 'Proyecto',
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
                title: 'Recursos técnicos',
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








    function fakeData() {
        return {
            docs: fakeDocs(),
            medias: [],
            techs: [],
        }
    }

    function fakeDocs() {
        return [{
                id: 1,
                title: 'TITULO DEL DOCUMENTO 1',
                authors: 'autores',
                description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ut pretium justo. Pellentesque pellentesque eu dolor et auctor. Phasellus dolor augue, sodales in vehicula a, feugiat suscipit velit. In hac habitasse platea dictumst. Nam vitae ultrices dolor. Donec facilisis, diam placerat sagittis iaculis, lacus mi convallis urna, sit amet elementum mi lacus non purus. Donec purus tellus, malesuada sed tempus a, scelerisque a ligula. Aliquam pulvinar urna a vehicula condimentum.'
            },
            {
                id: 2,
                title: 'TITULO DEL DOCUMENTO 2',
                authors: 'autores',
                description: 'Quisque mattis sagittis cursus. Fusce at maximus tellus. Phasellus et purus mauris. In rutrum aliquam feugiat. Curabitur quis ipsum id velit pretium ornare. Nulla in sollicitudin enim, quis consectetur diam. Etiam at orci pharetra, convallis lectus et, aliquet velit. Sed magna risus, consectetur et diam eu, varius condimentum ex.'
            },
            {
                id: 3,
                title: 'TITULO DEL DOCUMENTO 3',
                authors: 'autores',
                description: 'Curabitur enim est, imperdiet vel nulla ut, congue efficitur lorem. In et tempor leo. Phasellus suscipit nulla arcu, eu hendrerit libero tincidunt at. Sed sodales ultrices ante, non rutrum nunc iaculis quis. Aenean dignissim finibus augue maximus fermentum. Vestibulum vel turpis quis orci tempor fringilla eu quis sapien. Curabitur nec sem tincidunt, eleifend odio vitae, posuere quam.'
            }
        ];
    }
});
</script>

<?php include("./footer.php"); ?>