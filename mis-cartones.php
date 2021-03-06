<?php

if (!isset($_COOKIE["lotto_lg"]))
    header("Location: login-register.php?r=cartones");
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Mis cartones</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="img/icon.png">

    <!-- Plugins -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/revoulation.css">
    <link rel="stylesheet" href="css/plugins.css">

    <!-- Style Css -->
    <link rel="stylesheet" href="style.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="css/custom.css">
</head>

<body class="template-color-1 template-font-1">
    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

    <!-- Start PReloader -->
    <div id="page-preloader" class="page-loading clearfix">
        <div class="page-load-inner">
            <div class="preloader-wrap">
                <div class="wrap-2">
                    <div><img src="img/icons/brook-preloader.gif" alt="Brook Preloader"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- End PReloader -->

    <!-- Wrapper -->
    <div id="wrapper" class="wrapper brown-3">

        <!-- Header -->
        <header class="br_header header-default position-from--top header-transparent light-logo--version haeder-fixed-width headroom--sticky header-mega-menu clearfix">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="header__wrapper mr--0">
                            <!-- Header Left -->
                            <div class="header-left">
                                <div class="logo">
                                    <a href="index.html">
                                        <img src="img/logo-loteria.png" alt="Brook Images">
                                    </a>
                                </div>
                            </div>
                            <!-- Mainmenu Wrap -->
                            <div class="mainmenu-wrapper d-none d-lg-block">
                                <nav class="page_nav">
                                    <ul class="mainmenu">

                                        <li class="lavel-1 with--drop slide--megamenu"><a href="index.html"><span>Inicio</span></a>
                                        </li>
                                        <li class="lavel-1 with--drop slide--megamenu"><a href="cartones.html"><span>Comprar Cartones</span></a>
                                        </li>
                                        <li class="lavel-1 with--drop slide--megamenu" id="transmision"><a href="cartones.html"><span>Transmisi??n en vivo</span></a>
                                        </li>
                                        <!--<li class="lavel-1 with--drop slide-dropdown"><a href="#"><span>Transmisi??n en vivo</span></a>
                                            <ul class="dropdown__menu">
                                                <li><a href="shop-minimal.html"><span>Transmisi??n en vivo</span></a></li>
                                                <li><a href="cart.html"><span>Transmisiones futuras</span></a></li>
                                                <li><a href="compare.html"><span>Historial de transmisiones</span></a></li>
                                            </ul>
                                        </li>-->
                                        <li class="lavel-1 with--drop slide--megamenu"><a href="mis-cartones.php"><span>Mis cartones</span></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="header-right have-not-flex d-sm-flex pl--0 pr_md--0 pr_sm--0">
                                <!-- End Minicart -->
                                <ul class="social-icon icon-size-medium text-center tooltip-layout d-none d-sm-flex" id="infoUsuario">
                                    <div class="contenedor-login mt--20">
                                        <div>
                                            <form id="login_form" action="javascript:void(0);">
                                                <input class="input-login" type="text" name="login-form-email" id="login-form-email" placeholder="Correo electr??nico" required>
                                                <input class="input-login" type="password" name="login-form-password" id="" placeholder="Contrase??a" required>
                                                <input type="submit" hidden id="enviar_login">
                                            </form>
                                        </div>
                                        <div class="olvide-input">
                                            <a href="#" id="recuperarPass">??Olvidaste tu contrase??a?</a>
                                        </div>
                                    </div>
                                    <button class="btn-seguir2 mt--20" id="iniciarSesion">Iniciar sesi??n</button>
                                    <button class="mt--20 ml--10 mr--10" id="registrarse">Registrarse</button>
                                    <div style="display: none;" id="usuario" class="">
                                        <p></p>
                                        <button class="btn-seguir2" id="salir">Cerrar sesi??n</button>
                                    </div>

                                </ul>
                                <!-- Start Hamberger -->
                                <!-- Start Minicart -->
                                <div class="mini-cart">
                                    <div id="minicart-trigger" class="minicart-trigger mini-cart-button" data-count="3">
                                        <button><i class="fas fa-shopping-cart"></i></button>
                                    </div>
                                    <div class="shopping-cart cart-box">
                                        <div class="shop-inner">
                                            <div class="header">
                                                <ul class="product-list">

                                                    <!-- Start Single Product -->
                                                    <li>
                                                        <div class="thumb">
                                                            <a href="single-product.html">
                                                                <img src="img/product/sm-image/sm-cat1-01.jpg" alt="Multipurpose template">
                                                            </a>
                                                        </div>
                                                        <div class="content">
                                                            <div class="inner">
                                                                <h4><a href="single-product.html">Bottle with Leather
                                                                        Grip</a></h4>
                                                                <div class="quatity">
                                                                    <span>1 ??</span>
                                                                    <span>39.00</span>
                                                                </div>
                                                            </div>
                                                            <button class="delete-btn"><i class="fas fa-times"></i></button>
                                                        </div>
                                                    </li>

                                                    <!-- Start Single Product -->
                                                    <li>
                                                        <div class="thumb">
                                                            <a href="single-product.html">
                                                                <img src="img/product/sm-image/sm-cat1-02.jpg" alt="Multipurpose template">
                                                            </a>
                                                        </div>
                                                        <div class="content">
                                                            <div class="inner">
                                                                <h4><a href="single-product.html">Crystal Glass Globe
                                                                        Desk Lamp</a></h4>
                                                                <div class="quatity">
                                                                    <span>1 ??</span>
                                                                    <span>39.00</span>
                                                                </div>
                                                            </div>
                                                            <button class="delete-btn"><i class="fas fa-times"></i></button>
                                                        </div>
                                                    </li>

                                                    <!-- Start Single Product -->
                                                    <li>
                                                        <div class="thumb">
                                                            <a href="single-product.html">
                                                                <img src="img/product/sm-image/sm-cat1-03.jpg" alt="Multipurpose template">
                                                            </a>
                                                        </div>
                                                        <div class="content">
                                                            <div class="inner">
                                                                <h4><a href="single-product.html">Gold Plated Desk
                                                                        Lantern Lamp</a></h4>
                                                                <div class="quatity">
                                                                    <span>1 ??</span>
                                                                    <span>39.00</span>
                                                                </div>
                                                            </div>
                                                            <button class="delete-btn brook-transition"><i class="fas fa-times"></i></button>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="footer">
                                                <div class="total">Total: <span>225.00</span></div>
                                                <a class="cart-btn brook-transition" href="checkout.html">Check out</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="manu-hamber popup-mobile-click d-block d-lg-none light-version pl_md--20 pl_sm--20">
                                    <div>
                                        <i></i>
                                    </div>
                                </div>
                                <!-- End Hamberger -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!--// Header -->

        <!-- Start Popup Menu -->
        <div class="popup-mobile-manu popup-mobile-visiable">
            <div class="inner">
                <div class="mobileheader">
                    <div class="logo">
                        <a href="index.html">
                            <img src="img/logo-loteria.png" alt="Multipurpose">
                        </a>
                    </div>
                    <a class="mobile-close" href="#"></a>
                </div>
                <div class="menu-content">
                    <ul class="menulist object-custom-menu">
                        <a href="index.html">
                            <li class="has-mega-menu"><span>Inicio</span>
                            </li>
                        </a>
                        <a href="tienda.php">
                            <li class="has-mega-menu"><span>Comprar Cartas</span>
                            </li>
                        </a>
                        <a href="juego.php">
                            <li class="has-mega-menu"><span>Seguir Sorteo</span>
                            </li>
                        </a>
                        <a href="mis-cartones.php">
                            <li class="has-mega-menu"><span>Mis cartones</span>
                            </li>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Popup Menu -->

        <!-- Start Brook Search Popup -->
        <div class="brook-search-popup">
            <div class="inner">
                <div class="search-header">
                    <div class="logo">
                        <a href="index.html">
                            <img src="img/logo/brook-black.png" alt="logo images">
                        </a>
                    </div>
                    <a href="#" class="search-close"></a>
                </div>
                <div class="search-content">
                    <form action="#">
                        <label>
                            <input type="search" placeholder="Enter search keyword???">
                        </label>
                        <button class="search-submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Brook Search Popup -->

        <!-- Start Breadcaump Area -->
        <div class="breadcaump-area pt--200 pb--50 bg_color--1 breadcaump-title-bar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcaump-inner text-center">
                            <h1 class="heading heading-h1">Mis cartones</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcaump Area -->

        <!-- Page Conttent -->
        <main class="page-content">

            <!-- Start My Account Area -->
            <div class="my-account-area pt--10 pb--90 pt-xs-20 pb-xs-150">
                <div class="container">
                    <div class="row">
                        <div class="ml-auto mr-auto col-lg-12">
                            <div class="checkout-wrapper">
                                <div id="faq" class="panel-group">
                                    <div id="contenedorAcordeones"></div>

                                    <!--div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">
                                                <span>3</span>
                                                <a data-toggle="collapse" data-parent="#faq" href="#my-account-3">Mis
                                                    tarjetas </a>
                                            </h5>
                                        </div>
                                        <div id="my-account-3" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="billing-information-wrapper">
                                                    <div class="account-info-wrapper">
                                                        <h4>Mis tarjetas</h4>
                                                    </div>

                                                    <div id="contenedorAcordeones"></div>

                                                    <div class="billing-back-btn">
                                                        <div class="billing-back">
                                                            <a href="#">
                                                                <i class="fas fa-arrow-up"></i> back</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div-->
                                    <!--<div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">
                                                <span>4</span>
                                                <a href="wishlist.html">Modify your wish list </a>
                                            </h5>
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End My Account Area -->

        </main>
        <!--// Page Conttent -->

        <!-- Footer -->
        <footer id="page-footer-wrapper" class="page-footer-wrapper page-footer bg_color--4 fixed-footer">
            <!-- Start Copyright Area -->
            <div class="copyright copyright--2 plr_sm--30">
                <div class="container ptb--40">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="copyright-left text-left">
                                <p class="m-0">?? 2020 Loter??a Mexicana. Todos los derechos reservados.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12" id="aviso_legales">
                            <div class="copyright-left text-right">
                                <a href="#">Aviso de privacidad</a>

                                <a href="#" id="legales">Legales</a>
                            </div>
                        </div>
                        <!--
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="copyright-right text-right">
                            <div class="input-box">
                                <input type="email" placeholder="Your e-mail">
                                <button><i class="ion-android-arrow-forward"></i></button>
                            </div>
                        </div>
                    </div>-->
                    </div>
                </div>
            </div>
            <!-- End Copyright Area -->
        </footer>
        <!--// Footer -->

    </div>


    <!--// Wrapper -->

    <!-- Js Files -->
    <script src="js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

    <!-- REVOLUTION JS FILES -->
    <script src="js/jquery.themepunch.tools.min.js"></script>
    <script src="js/jquery.themepunch.revolution.min.js"></script>

    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
    <script src="js/revolution.extension.actions.min.js"></script>
    <script src="js/revolution.extension.carousel.min.js"></script>
    <script src="js/revolution.extension.kenburn.min.js"></script>
    <script src="js/revolution.extension.layeranimation.min.js"></script>
    <script src="js/revolution.extension.migration.min.js"></script>
    <script src="js/revolution.extension.navigation.min.js"></script>
    <script src="js/revolution.extension.parallax.min.js"></script>
    <script src="js/revolution.extension.slideanims.min.js"></script>
    <script src="js/revolution.extension.video.min.js"></script>
    <script src="js/revoulation.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.3.16/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="server/controllers/barcodes.js"></script>
    <script type="text/javascript" src="server/controllers/index_1658177167.js"></script>
    <script type="text/javascript" src="server/controllers/ajax_cart.js"></script>
    <script type="text/javascript" src="server/controllers/mis-cartones.js"></script>


    <style type="text/css">
        .item {
            padding: 0px 5px;
            margin: 3px 0px !important;
        }

        .logo {
            padding: 0px;
        }

        .logo img {
            float: left;
        }

        .cabecera,
        .product-main-image {
            margin-right: 0px;
            margin-left: 0px;
        }

        .product {
            box-shadow: 0px 1px 2px 0px rgba(60, 64, 67, 0.3), 0px 1px 3px 1px rgba(60, 64, 67, 0.15);

        }

        .mini-cart .shopping-cart {
            display: none !important;
        }

        .invalido {
            background-color: #e4e4e4;
            opacity: .6;
        }
    </style>

</body>

</html>