<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ieasa - Observatorio Ambiental</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="./fontawesome-5.8.1/css/all.min.css" />
    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/bootstrapfix.navbar.css" />
    <link rel="stylesheet" href="./css/site.css" />

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


    <div id="main-slider" class="carousel slide" data-ride="carousel">
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
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="./images/index/slide2.jpg" alt="...">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="./images/index/slide3.jpg" alt="...">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="./images/index/slide4.jpg" alt="...">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="./images/index/slide5.jpg" alt="...">
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

<div id="page">
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-6">1</div>
                <div class="col-md-6">2</div>
            </div>
            <div class="row">
                <div class="col-md-8">3</div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">4</div>
                        <div class="col-md-12">5</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">4</div>
                        <div class="col-md-12">5</div>
                    </div>
                </div>
                <div class="col-md-6">3</div>
            </div>
            <div class="row">
                <div class="col-md-4">3</div>
                <div class="col-md-4">3</div>
                <div class="col-md-4">3</div>
            </div>
        </div>
        <div class="col-md-3 side-right">
            <div class="row">
                <div class="col-md-12">6</div>
                <div class="col-md-12">7</div>
                <div class="col-md-12">8</div>
                <div class="col-md-12">9</div>
            </div>
        </div>
    </div>

    <div class="row footer">
        <div class="col-md-3 themed-grid-col" style="padding: 10px;">
            <img src="./images/logo-footer.jpg" style="width: 100%; max-width: 250px; height: auto;" />
        </div>
        <div class="col-md-3 themed-grid-col" style="font-size: .9em; padding: 10px;">
            <b>DIRECCION</b><br />
            AV. PASEO COLON 505 PISO 6,<br />
            CIUDAD DE BUENOS AIRES, ARGENTINA
        </div>
        <div class="col-md-3 themed-grid-col" style="font-size: .9em; padding: 10px;">
            <b>TELEFONO</b><br />
            (+54 11) 5276-4050 INT: 127
        </div>
        <div class="col-md-3 social-media" style="padding: 10px;">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-youtube"></a>
            <a href="#" class="fab fa-twitter"></a>
        </div>
    </div>


</div>


    <!-- <div class="grid-container">
        <div class="item-paneles">
            <div class="grid-left">
            
            </div>
        </div>
        <div class="item-acciones">
            <div class="grid-right">
                <div class="item-mediateca">
                    b
                </div>
                <div class="item-geovisores">
                    c
                </div>
                <div class="item-indicadores">
                    d
                </div>
                <div class="item-enlaces">
                    e
                </div>
            </div>
        </div>
    </div> -->



</body>

</html>