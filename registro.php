<?php

if (isset($_COOKIE["lotto_lg"])) {
    header("Location: index.html");
}

?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Registrarse</title>
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
                                        <li class="lavel-1 with--drop slide--megamenu" id="transmision"><a href="cartones.html"><span>Transmisión en vivo</span></a>
                                        </li>
                                        <!--<li class="lavel-1 with--drop slide-dropdown"><a href="#"><span>Transmisión en vivo</span></a>
                                            <ul class="dropdown__menu">
                                                <li><a href="shop-minimal.html"><span>Transmisión en vivo</span></a></li>
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
                                                <input class="input-login" type="text" name="login-form-email" id="login-form-email" placeholder="Correo electrónico" required>
                                                <input class="input-login" type="password" name="login-form-password" id="" placeholder="Contraseña" required>
                                                <input type="submit" hidden id="enviar_login">
                                            </form>
                                        </div>
                                        <div class="olvide-input">
                                            <a href="#" id="recuperarPass">¿Olvidaste tu contraseña?</a>
                                        </div>
                                    </div>
                                    <button class="btn-seguir2 mt--20" id="iniciarSesion">Iniciar sesión</button>
                                    <button class="mt--20 ml--10 mr--10" id="registrarse">Registrarse</button>
                                    <div style="display: none;" id="usuario" class="">
                                        <p></p>
                                        <button class="btn-seguir2" id="salir">Cerrar sesión</button>
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
                                                                    <span>1 ×</span>
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
                                                                    <span>1 ×</span>
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
                                                                    <span>1 ×</span>
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
                            <input type="search" placeholder="Enter search keyword…">
                        </label>
                        <button class="search-submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Brook Search Popup -->

        <!-- Start Breadcaump Area -->
        <div class="breadcaump-area pt--200 pb--50 pt-xs-20 pb-xs-20 bg_color--1 breadcaump-title-bar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcaump-inner text-center">
                            <h1 class="heading heading-h1">Registro</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcaump Area -->

        <!-- Page Conttent -->
        <main class="page-content">
            <!-- My Account Page -->
            <div class="my-account-area pt--50 pb--150 bg_color--1 pt-xs-20">
                <div class="container">
                    <div class="row">
                        <!-- Login Form -->
                        <!--<div class="col-lg-6">
                            <div class="login-form-wrapper">
                                <form action="javascript:void(0);" class="sn-form sn-form-boxed" id="formLogin">
                                    <div class="sn-form-inner">
                                        <div class="single-input">
                                            <label for="login-form-email">Correo *</label>
                                            <input type="text" name="login-form-email" id="login-form-email" required>
                                        </div>
                                        <div class="single-input">
                                            <label for="login-form-password">Contraseña *</label>
                                            <input type="password" name="login-form-password" id="login-form-password" required>
                                        </div>
                                        <div class="single-input">
                                            <button type="submit" class="mr-3" id="btnLogin">
                                                <span>Iniciar sesión</span>
                                            </button>
                                        </div>
                                        <div class="single-input">
                                            <a href="#" id="recuperarPass">¿Olvidaste tu contraseña?</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>-->
                        <!--// Login Form -->

                        <!-- Register Form -->
                        <div class="col-lg-8 mt_md--40 mt_sm--40" style="margin:auto;">
                            <div class="login-form-wrapper">
                                <form action="javascript:void(0);" class="sn-form sn-form-boxed" id="formRegistro">
                                    <div class="sn-form-inner">
                                        <div class="single-input">
                                            <label for="register-form-nombre">Nombre</label>
                                            <input type="text" name="register-form-nombre" id="register-form-nombre" required>
                                        </div>
                                        <div class="single-input">
                                            <label for="register-form-apellido">Apellido</label>
                                            <input type="text" name="register-form-apellido" id="register-form-apellido" required>
                                        </div>
                                        <div class="single-input">
                                            <label for="register-form-telefono">Teléfono</label>
                                            <input type="text" name="register-form-telefono" id="register-form-telefono" required maxlength="10">
                                        </div>
                                        <div class="single-input">
                                            <label for="register-form-email">Correo</label>
                                            <input type="text" name="register-form-email" id="register-form-email" required>
                                        </div>
                                        <div class="single-input">
                                            <label for="register-form-password">Contraseña</label>
                                            <input type="password" name="register-form-password" id="register-form-password" required>
                                        </div>
                                        <div class="single-input">
                                            <button type="submit" id="btnRegistro">
                                                <span>Registrarse</span>
                                            </button>
                                        </div>
                                    </div>
                                    <input type="submit" name="" hidden id="enviarRegistro">
                                </form>
                            </div>
                        </div>
                        <!--// Register Form -->
                    </div>
                </div>
            </div>
            <!--// My Account Page -->

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
                                <p class="m-0">© 2020 Lotería Mexicana. Todos los derechos reservados.</p>
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
    <script type="text/javascript" src="server/controllers/get.js"></script>
    <script type="text/javascript" src="server/controllers/index_1658177167.js"></script>
    <script type="text/javascript" src="server/controllers/ajax_cart.js"></script>
    <script type="text/javascript" src="server/controllers/login_1658177167.js"></script>
</body>

</html>