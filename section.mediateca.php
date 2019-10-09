<div class="row" id="page_mediateca">
    <div class="col-md-12 page-title page-title-sticky">
        Recursos en Mediateca
    </div>

    <div class="col-md-12 page-search" style="display: none;">
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
        </div>
    </div>

    <div class="col-md-12 page-tabs">
        <div class="row" style="background-color: #ddd;">
            <div class="col-md-10">
                <ul class="nav nav-tabs" style="padding-top: 10px;">
                    <li class="nav-item">
                        <a class="nav-link active" data-tab="0" href="#">DOCUMENTOS <span id="uxQtyDocs"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-tab="1" href="#">RECURSOS AUDIOVISUALES <span id="uxQtyMedias"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-tab="2" href="#">RECURSOS TÉCNICOS <span id="uxQtyTechs"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-tab="3" href="#">NOTICIAS <span id="uxQtyNews"></span></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-2 text-right" style="padding: 16px 50px 10px 20px; background-color: #ddd;">
                <select id="uxOrden" class="selectpicker" data-width="150">
                    <option>Ordenar por</option>
                    <option value="0">A - Z</option>
                    <option value="1">Z - A</option>
                    <option value="2">MÁS VISTOS</option>
                    <option value="3">MENOS VISTOS</option>
                    <option value="4">RECIENTES</option>
                    <option value="5">ANTIGUOS</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="x0 col-md-3" style="position: relative;">
                <div id="uxFilters-box" class="pinned" style="position: absolute;"></div>
            </div>
            <div class="col-md-9">
                <div id="uxFiltersChecked"></div>
                <div id="uxPager1" style="padding-bottom: 12px; display: none;"></div>
                <div id="uxData"></div>
                <div id="uxPager2" style="padding: 12px; display: none;"></div>
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


<div class="modal fade" id="previewmodal" style="margin-top: 100px;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-lg2">
        <div class="modal-content" style="background-color: transparent; border: none;">
            <div class="modal-body">
                <button id="uxPreviewClose" type="button" class="close" data-dismiss="modal" style="color: #fff; font-size: 50px;"><span aria-hidden="true">&times;</span></button>
                <div style="text-align: center;">
                    <div id="preview"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="./js/hc-sticky.js" type="text/javascript"></script>
<script src="./js/site.mediateca.js" type='text/javascript'>
</script>
