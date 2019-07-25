<div class="row" id="page_mediateca">
    <div class="col-md-12 page-title">
        Recursos en Mediateca
    </div>
    <div class="col-md-12 page-search">
        <div class="row">

            <div class="col-md-4">
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

            <div class="col-md-8 text-right">
                Ordenar por:
                <select id="uxOrden" class="selectpicker">
                    <option value="0">A - Z</option>
                    <option value="1">Z - A</option>
                    <option value="2">Más vistos</option>
                    <option value="3">Menos vistos</option>
                    <option value="4">Recientes</option>
                    <option value="5">Antiguos</option>
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

    <div class="modal fade" id="uxFicha" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("./widget-links.php"); ?>

<script src="./js/site.mediateca.js" type='text/javascript'>
</script>