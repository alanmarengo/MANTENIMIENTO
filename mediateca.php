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
            <div class="col-md-6" style="display: flex; flex-flow: row wrap; align-items: right;">
                <label style="line-height: 40px; padding-right: 6px;">Ordenar por:</label>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        A - Z
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">A - Z</a>
                        <a class="dropdown-item" href="#">Z - A</a>
                        <a class="dropdown-item" href="#">Mas visitados</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div class="col-md-12 page-tabs">
        <ul class="nav nav-tabs" id="uxTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="uxDocsTab" data-toggle="tab" href="#uxDocsTabContent" role="tab">
                    DOCUMENTOS <span id="uxQtyDocs"></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="uxMediasTab" data-toggle="tab" href="#uxMediasTabContent" role="tab">
                    RECURSOS AUDIOVISUALES <span id="uxQtyMedias"></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="uxTechsTab" data-toggle="tab" href="#uxTechsTabContent" role="tab">
                    RECURSOS TECNICOS <span id="uxQtyTechs"></span>
                </a>
            </li>
        </ul>

        <div class="tab-content" id="uxTabsContent">
            <div class="tab-pane fade show active" id="uxDocsTabContent" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                    <div class="col-md-3">
                        <div class="filters-header">Refina sus resultados</div>
                        <div id="uxFilters"></div>
                    </div>
                    <div class="col-md-9">
                        <div id="uxFiltersChecked"></div>
                        <div id="uxDocs"></div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="uxMediasTabContent" role="tabpanel">...</div>
            <div class="tab-pane fade" id="uxTechsTabContent" role="tabpanel">...</div>
        </div>



    </div>




</div>

<script type='text/javascript'>
$(document).ready(function() {
    var model = {
        apiUrlBase: 'http://observatorio.atic.com.ar',
        filters: {
            orden: 0,
            searchText: '',
            dateStart: '', // USAR MOMENTJS
            dateEnd: '', // USAR MOMENTJS
            groups: initFiltersGroups()
        },
        data: null
    };

    init();

    // TEXT SEARCH
    $('#uxSearchButton').on('click', function() {
        model.filters.searchText = $('#uxSearchText').val();
        dataLoad()
    });

    // REMOVE FILTER
    $('#uxDocsTabContent').on('click', '.filters-checked', function() {
        let group = $(this).data('group');
        let item = $(this).data('item');
        model.filters.groups[group].items[item].checked = false;
        filtersRender();
        dataLoad()
    });

    // ADD FILTER
    $('#uxFilters').on('click', '.filters-group-item', function() {
        let group = $(this).data('group');
        let item = $(this).data('item');
        model.filters.groups[group].items[item].checked = true;
        filtersRender();
        dataLoad()
    });

    // GROUP COLLAPSE
    $('#uxFilters').on('click', '.group-title', function() {
        let index = $(this).data('group');
        let collapsed = $($(this).data('target')).hasClass('show');
        let group = model.filters.groups[index];

        collapseAllGroups();
        group.collapsed = collapsed;
        groupsTitleRender();
    });






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
                model.filters.groups[gindex].items.push(
                    {
                        id: value.valor_id,
                        label: value.valor_desc,
                        checked: false
                    }
                );
            });
            filtersRender();
        });
    }

    function dataLoad() {
        // AJAX...
        model.data = fakeData();
        dataRender();

        $('#uxUrl').html(makeUrlFilter());
    }

    function dataRender() {
        docsRender();
        //mediasRender();
        //techsRender();

        $('#uxSearchText').focus();
    }

    function filtersRender() {
        let html = '';
        html += `<div class="accordion" id="uxFilters">`;
        $.each(model.filters.groups, function(gindex, group) {
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
                        <div class="card-body">
                            <ul class="list-group">
            `;

            $.each(group.items, function(iindex, item) {
                if (!item.checked) {
                    html += `
                        <button type="button" class="filters-group-item list-group-item list-group-item-action" data-group="${gindex}" data-item="${iindex}">${item.label}</button>
                    `
                }
            });

            html += `
                            </ul>
                        </div>
                    </div>
                </div>
            `;
        });
        html += `</div>`;
        $('#uxFilters').html(html);

        groupsTitleRender();
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
        $('#uxQtyDocs').html(`(${model.data.docs.length})`);
        checkedsRender();

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
        $('#uxDocs').html(html);
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
            ds: moment('01/05/2019', 'DD/MM/YYYY').format('DD/MM/YYYY'),
            de: moment('31/05/2019', 'DD/MM/YYYY').format('DD/MM/YYYY'),
            g0: idItemsChecked(model.filters.groups[0]),
            g1: idItemsChecked(model.filters.groups[1]),
            g2: idItemsChecked(model.filters.groups[2]),
            g3: idItemsChecked(model.filters.groups[3]),
        };
        return jQuery.param(params);
    }

    function initFiltersGroups() {
        return [
            {
                title: 'Documentos',
                collapsed: false,
                items: []
            },
            {
                title: 'Proyecto',
                collapsed: true,
                items: []
            },
            {
                title: 'Tema',
                collapsed: true,
                items: []
            },
            {
                title: 'Subtema',
                collapsed: true,
                items: []
            },
        ];
    }

    function fakeFilters() {
        return [{
                title: 'Documentos',
                collapsed: false,
                items: [{
                        id: 1,
                        label: 'Externos',
                        checked: true
                    },
                    {
                        id: 2,
                        label: 'Proyecto',
                        checked: false
                    },
                    {
                        id: 3,
                        label: 'Ambiente PGA',
                        checked: false
                    },
                    {
                        id: 4,
                        label: 'Ambientes Complementarios',
                        checked: false
                    }
                ]
            },
            {
                title: 'Proyecto',
                collapsed: true,
                items: [{
                        id: 1,
                        label: 'item #1',
                        checked: false
                    },
                    {
                        id: 2,
                        label: 'item #2',
                        checked: false
                    },
                    {
                        id: 3,
                        label: 'item #3',
                        checked: false
                    },
                    {
                        id: 4,
                        label: 'item #4',
                        checked: false
                    },
                    {
                        id: 5,
                        label: 'item #5',
                        checked: false
                    },
                    {
                        id: 6,
                        label: 'item #6',
                        checked: false
                    },
                ]
            },
            {
                title: 'Tema',
                collapsed: true,
                items: [{
                    id: 1,
                    label: 'item',
                    checked: false
                }, ]
            },
            {
                title: 'Subtema',
                collapsed: true,
                items: [{
                    id: 1,
                    label: 'item',
                    checked: false
                }, ]
            },
            {
                title: 'Temporada',
                collapsed: true,
                items: [{
                    id: 1,
                    label: 'item',
                    checked: false
                }, ]
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