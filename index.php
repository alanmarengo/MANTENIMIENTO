<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ieasa - Observatorio Ambiental</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="./fontawesome-5.8.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="./fonts/gotham/gotham.css"/>
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="./css/bootstrapfix.navbar.css" />
    <link rel="stylesheet" type="text/css" href="./css/site.css" />

    <script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/popper-1.12.9.min.js"></script>

    <script src="./js/openlayers/ol.js" type="text/javascript"></script>

    <script src="./js/map.js" type="text/javascript"></script>

    <script type="text/javascript">
    $(document).ready(function() {});
    </script>
</head>

<body>
    <nav class="navbar navbar-dark bg-light" id="nav-1">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="fa fa-navicon"></i>
            </span>
        </button>

        <a class="navbar-brand" href="#">
            Observatorio
            <img src="./images/ieasa_logo.png" id="logo_ieasa" height="30">
        </a>

        <div class="nav navbar-expand navbar-right" style="display: inline-block;" id="navIcons">
            <ul class="navbar-nav">
                <li class="nav-item nav-item-search">
                    <a class="nav-link nav-item-button nav-link-button">
                        <i class="fa fa-search"></i>
                        <input type="text" placeholder="Buscar en todo el sitio">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-item-button nav-link-button" href="#">
                        <i class="fa fa-question-circle"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-item-button nav-link-button" href="#">
                        <i class="fa fa-user"></i>
                    </a>
                </li>
            </ul>
        </div>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
        </div>
    </nav>


<div id="page_index">
    <div id="main-slider" class="carousel slide" data-ride="carousel" data-interval="3000">
        <ol class="carousel-indicators">
            <li data-target="#main-slider" data-slide-to="0" class="active"></li>
            <li data-target="#main-slider" data-slide-to="1"></li>
            <li data-target="#main-slider" data-slide-to="2"></li>
            <li data-target="#main-slider" data-slide-to="3"></li>
            <li data-target="#main-slider" data-slide-to="4"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="./images/index/slide1.jpg" alt="...">
                <div class="carousel-caption">
                    <p>GEOVISOR DE INFORMACION INTEGRADA</p>
                </div>                
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="./images/index/slide2.jpg" alt="...">
                <div class="carousel-caption">
                    <p>SABIAS DE LA EXISTENCIA DE LA LAMPREA<br /> EN EL RIO SANTA CRUZ?</p>
                </div>                
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="./images/index/slide3.jpg" alt="...">
                <div class="carousel-caption">
                    <p>CAMPO DE HIELO PATAGONIA SUR (HPS)</p>
                </div>                
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="./images/index/slide4.jpg" alt="...">
                <div class="carousel-caption">
                    <p>NUESTRO COMPROMISO CON EL MACA TOBIANO</p>
                </div>                
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="./images/index/slide5.jpg" alt="...">
                <div class="carousel-caption">
                    <p>MISION DE IEASA</p>
                </div>                
            </div>
        </div>
        <a class="carousel-control-prev" href="#main-slider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#main-slider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Siguiente</span>
        </a>
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="row modulo-row">
                <div class="col-md-6 modulo-wrap modulo-1">
                    <div class="modulo-opacity"></div>
                    <div class="modulo-text">
                        IEASA EN EL TERRITORIO
                    </div>
                    <div class="modulo-hover">
                        <p class="modulo-hover-text">
                            Mapa de proyectos, obras en construcción y operación de IEASA.
                            <br />
                            <a href="#" class="modulo-hover-icon">
                                <i class="fa fa-plus-circle fa-2x"></i>
                            </a>
                        </p>
                    </div>
                </div>
                <div class="col-md-6 modulo-wrap modulo-2">
                    <div class="modulo-opacity"></div>
                    <div class="modulo-text">
                        OBSERVATORIO AHRSC
                    </div>
                    <div class="modulo-hover">
                        <p class="modulo-hover-text">
                            Ámbito de estudio y evaluación de la información estratégica de los AHRSC desde el punto de vista ambiental y del proyecto. Proporciona distintos instrumentos que facilitan el acceso y la divulgación pública del conocimiento para la implementación de una gestión sostenible.
                            <br />
                            <a href="#" class="modulo-hover-icon">
                                <i class="fa fa-plus-circle fa-2x"></i>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row modulo-row">
                <div class="col-md-6 modulo-wrap modulo-3">
                    <div class="modulo-opacity"></div>
                    <div class="modulo-text">
                        INDICADORES AMBIENTALES AHRSC
                    </div>
                    <div class="modulo-hover">
                        <p class="modulo-hover-text">
                            Permite realizar el seguimiento de parámetros y variables de los programas del Plan de Gestión Ambiental (PGA) de los Aprovechamientos del Río Santa Cruz para comprender los fenómenos ambientales y territoriales.
                            <br />
                            <a href="#" class="modulo-hover-icon">
                                <i class="fa fa-plus-circle fa-2x"></i>
                            </a>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 modulo-wrap modulo-4">
                            <div class="modulo-opacity"></div>
                            <div class="modulo-text">
                                HIGIENE Y SEGURIDAD LABORAL
                            </div>
                            <div class="modulo-hover">
                                <p class="modulo-hover-text">
                                    Acciones de prevención de riesgos del trabajo.
                                    <br />
                                    <a href="#" class="modulo-hover-icon">
                                        <i class="fa fa-plus-circle fa-2x"></i>
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-12 modulo-wrap modulo-5">
                            <div class="modulo-opacity"></div>
                            <div class="modulo-text">
                                PLAN DE GESTION DE CALIDAD
                            </div>
                            <div class="modulo-hover">
                                <p class="modulo-hover-text">
                                    Accedé al Plan de Gestión de Calidad  de las obras.
                                    <br />
                                    <a href="#" class="modulo-hover-icon">
                                        <i class="fa fa-plus-circle fa-2x"></i>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row modulo-row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 modulo-wrap modulo-6">
                            <div class="modulo-opacity"></div>
                            <div class="modulo-text">
                                COMUNICACION Y GESTION PARTICIPATIVA
                            </div>
                            <div class="modulo-hover">
                                <p class="modulo-hover-text">
                                    Acciones de comunicación, relación con actores sociales y participación comunitaria.
                                    <br />
                                    <a href="#" class="modulo-hover-icon">
                                        <i class="fa fa-plus-circle fa-2x"></i>
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-12 modulo-wrap modulo-7">
                            <div class="modulo-opacity"></div>
                            <div class="modulo-text">
                                EXPLORA LAS OBRAS DE LOS AHRSC EN 2D Y 3D
                            </div>
                            <div class="modulo-hover">
                                <p class="modulo-hover-text">
                                    <a href="#" class="modulo-hover-icon">
                                        <i class="fa fa-plus-circle fa-2x"></i>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 modulo-wrap modulo-8">
                    <div class="modulo-opacity"></div>
                    <div class="modulo-text">
                        APROVECHAMIENTOS HIDROELECTRICOS DEL RIO SANTA CRUZ
                    </div>
                    <div class="modulo-hover">
                        <p class="modulo-hover-text">
                            Ingresá a la información del proyecto de las presas Cóndor Cliff (CC) y La Barrancosa (LB), que proveerán electricidad al Sistema Argentino de Interconexión (SADI).
                            <br />
                            <a href="#" class="modulo-hover-icon">
                                <i class="fa fa-plus-circle fa-2x"></i>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row modulo-row">
                <div class="col-md-4 modulo-wrap modulo-9">
                    <div class="modulo-opacity"></div>
                    <div class="modulo-text">
                        EL RIO SANTA CRUZ EN NUMEROS
                    </div>
                    <div class="modulo-hover">
                        <p class="modulo-hover-text">
                            Encontrá y visualizá información sobre recursos hídricos, modelos, información hidrometeorológica, sedimentológica e hidroambiental del río Santa (...)
                            <br />
                            <a href="#" class="modulo-hover-icon">
                                <i class="fa fa-plus-circle fa-2x"></i>
                            </a>
                        </p>
                    </div>
                </div>
                <div class="col-md-4 modulo-wrap modulo-10">
                    <div class="modulo-opacity"></div>
                    <div class="modulo-text">
                        PLAN DE GESTION AMBIENTAL<br />
                        (PGA - AHRSC)
                    </div>
                    <div class="modulo-hover">
                        <p class="modulo-hover-text">
                            Facilita el seguimiento de las acciones que brindan sostenibilidad al proyecto en sus distintas etapas. Planifica y ejecuta monitoreos sistemáticos para  el estudio de la evolución del ambiente.
                            <br />
                            <a href="#" class="modulo-hover-icon">
                                <i class="fa fa-plus-circle fa-2x"></i>
                            </a>
                        </p>
                    </div>
                </div>
                <div class="col-md-4 modulo-wrap modulo-11">
                    <div class="modulo-opacity"></div>
                    <div class="modulo-text">
                        SIT SANTA CRUZ
                    </div>
                    <div class="modulo-hover">
                        <p class="modulo-hover-text">
                            Información espacial de la provincia de Santa Cruz, orientada a la gestión, análisis y ajuste de políticas en campos específicos de interés para la administración pública (...)
                            <br />
                            <a href="#" class="modulo-hover-icon">
                                <i class="fa fa-plus-circle fa-2x"></i>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 side-right">
            <div class="row">
                <div class="col-md-12 link-wrap link-1">
                    <div class="link-text">
                        RECURSOS EN MEDIATECA
                    </div>
                    <div class="link-hover">
                        <p class="link-hover-text">
                        Accedé a informes, materiales audiovisuales, gráficos, información geográfica y datos estadísticos
                        </p>
                    </div>
                </div>
                <div class="col-md-12 link-wrap link-2">
                    <div class="link-text">
                        HERRAMIENTAS GEOGRÁFICAS
                    </div>
                    <div class="link-hover">
                        <p class="link-hover-text">
                        Accedé a la información georreferenciada para realizar consultas y gestionar datos en geovisores 
                        </p>
                    </div>
                </div>
                <div class="col-md-12 link-wrap link-3">
                    <div class="link-text">
                        INDICADORES
                    </div>
                    <div class="link-hover">
                        <p class="link-hover-text">
                        Accedé a paneles de indicadores desarrollados para el seguimiento de los proyectos y el análisis ambiental
                        </p>
                    </div>
                </div>
                <div class="col-md-12 link-wrap link-4">
                    <div class="link-text">
                        ESTADÍSTICAS
                    </div>
                    <div class="link-hover">
                        <p class="link-hover-text">
                        Accedé a los datos generados en el desarrollo de los proyectos para su consulta y tratamiento
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row footer">
        <div class="col-md-3" style="padding: 10px;">
            <img src="./images/logo-footer.jpg" style="width: 100%; max-width: 250px; height: auto;" />
        </div>
        <div class="col-md-3" style="font-size: .9em; padding: 10px;">
            <b>CONTACTO</b>
            <br />
            <br />
            <b>TELEFONO</b><br />
            (+54 11) 5276-4050 INT: 127<br />
            <br />
            <b>DIRECCION</b><br />
            AV. PASEO COLON 505 PISO 6,<br />
            CIUDAD DE BUENOS AIRES, ARGENTINA
        </div>
        <div class="col-md-3" style="font-size: .9em; padding: 10px;">
            <b>ENLACES</b>
            <br />
            <br />
        </div>
        <div class="col-md-3 social-media" style="padding: 10px;">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-youtube"></a>
            <a href="#" class="fab fa-twitter"></a>
        </div>
    </div>


</div>

    <script type='text/javascript'>
        $(document).ready(function () {
            $('.modulo-wrap').hover( 
                function () {
                    $(this).find('.modulo-text').hide();
                },
                function () {
                    $(this).find('.modulo-text').show();
                }
            )
            $('.link-wrap').hover( 
                function () {
                    $(this).find('.link-text').hide();
                },
                function () {
                    $(this).find('.link-text').show();
                }
            )
        });
    </script>
</body>

</html>