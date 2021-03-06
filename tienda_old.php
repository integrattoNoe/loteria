<?php
if (isset($_GET["game"]))
    $idGame = $_GET["game"];
else
    $idGame = "";
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Tienda</title>
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

        <!-- Page Conttent -->
        <main class="page-content">
            <!-- Start Shop Minimal Area -->
            <div class="brook-shop-minimal ptb--150 bg_color--1 pt-xs-50">
                <div class="container" style="max-width: 90%;">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            if ($idGame == "") {
                            ?>
                                <div id="juegos" class="col-md-6 mb--30">
                                    <h3>Selecciona un juego</h3>
                                    <select class="custom-select" id="elegirJuego">
                                        <option selected>Elige...</option>
                                    </select>
                                </div>
                                <script type="text/javascript">
                                    getSorteos2();
                                    var sorteos2;

                                    function getSorteos2() {
                                        fetch('server/api/sorteos.php')
                                            .then(function(response) {
                                                return response.json();
                                            })
                                            .then(function(myJson) {
                                                if (myJson.code == 200) {
                                                    sorteos2 = myJson.data
                                                    renderSorteos2()
                                                    console.log("Toal: " + sorteos2.length)
                                                    //renderSorteos(myJson.data);
                                                } else
                                                    alert(myJson.msg);
                                            });
                                    }

                                    function renderSorteos2() {
                                        var sorteo;

                                        for (var i in sorteos2) {
                                            sorteo = sorteos2[i];
                                            var elem = "<option value='" + sorteo.ID + "'>" + sorteo.Game_name + "</option>";
                                            jQuery("#elegirJuego").append(elem);
                                        }
                                    }
                                </script>
                            <?php
                            }
                            ?>

                            <!--
                            <div class="archive-shop-actions mb--30">
                                <div class="row align-items-center">

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="archive-shop-inner text-center text-sm-left">
                                            <p class="bk_pra">Showing 1???8 of 10 results</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="archive-shop-inner text-center text-sm-right mt_mobile--20">
                                            <select>
                                                <option>Sort by popularity</option>
                                                <option>Sort by average rating</option>
                                                <option>Sort by price: low to high</option>
                                                <option>Sort by price: high to low</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>-->


                            <!-- Start Shop Minimal Product -->
                            <div class="shop-minimal-product">
                                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb--30 mt--30">
                                    <button class="btn-seguir2" id="volver">
                                        <a href="cartones.html"><i class="fas fa-arrow-left"></i>Volver a partidas</a>
                                    </button>
                                </div>
                                <div class="row row--25">
                                    <!-- Start Single Product -->

                                    <!-- End Single Product -->
                                    <!-- Start Pagenation Area -->

                                    <!-- End Pagenation Area -->

                                </div>

                                <div class="row">
                                    <div class="col-lg-12" id="paginador">
                                        <!--<div class="brook-pagination-wrapper text-center pt--80" id="paginador">
                                            <ul class="brook-pagination">
                                                <li class="active"><a href="#">1</a></li>
                                                <li><a href="#">2</a></li>
                                                <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                            </ul>
                                        </div>-->
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb--30 mt--30">
                                    <button class="btn-seguir2" id="volver">
                                        <a href="cartones.html"><i class="fas fa-arrow-left"></i>Volver a partidas</a>
                                    </button>
                                </div>
                            </div>
                            <!-- End Shop Minimal Product -->
                        </div>
                        <div class="col-lg-4 mt_md--60 mt_sm--60" style="display: none;">
                            <!-- Start Sidebar Area -->
                            <div class="shop-sidebar-container">
                                <div class="shop-sidebar-wrapper">

                                    <!-- Start Single Widget -->
                                    <div class="shop-sidebar search">
                                        <h5 class="widget-title">Search</h5>
                                        <form class="inner" action="#">
                                            <div class="search-box">
                                                <input type="text" placeholder="Enter search keyword???">
                                                <button><span class="fa fa-search"></span></button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- End Single Widget -->

                                    <!-- Start Single Widget -->
                                    <div class="shop-sidebar related-product-inner mt--50 wow move-up">
                                        <h5 class="widget-title">Top rated products</h5>

                                        <ul class="related-product">

                                            <!-- Start Single Product -->
                                            <li>
                                                <div class="product-item">
                                                    <div class="thumbnail">
                                                        <a href="single-product.html">
                                                            <img src="img/product/md-image/product-1.jpg" alt="multi-purpose">
                                                        </a>
                                                    </div>
                                                    <div class="info">
                                                        <h5 class="heading heading-h5"><a href="single-product.html">White
                                                                Ceramic Pot with Stand </a></h5>
                                                        <ul class="rating">
                                                            <li><i class="fas fa-star"></i></li>
                                                            <li><i class="fas fa-star"></i></li>
                                                            <li><i class="fas fa-star"></i></li>
                                                            <li><i class="fas fa-star"></i></li>
                                                            <li><i class="fas fa-star"></i></li>
                                                        </ul>
                                                        <div class="price"><span>$89.00</span> <span class="new-price">$58.00</span></div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- End Single Product -->

                                            <!-- Start Single Product -->
                                            <li>
                                                <div class="product-item">
                                                    <div class="thumbnail">
                                                        <a href="single-product.html">
                                                            <img src="img/product/md-image/product-2.jpg" alt="multi-purpose">
                                                        </a>
                                                    </div>
                                                    <div class="info">
                                                        <h5 class="heading heading-h5"><a href="single-product.html">
                                                                Metallic Gold Table Lamp</a></h5>
                                                        <div class="price"><span>$89.00</span> <span class="new-price">$58.00</span></div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- End Single Product -->

                                            <!-- Start Single Product -->
                                            <li>
                                                <div class="product-item">
                                                    <div class="thumbnail">
                                                        <a href="single-product.html">
                                                            <img src="img/product/md-image/product-3.jpg" alt="multi-purpose">
                                                        </a>
                                                    </div>
                                                    <div class="info">
                                                        <h5 class="heading heading-h5"><a href="single-product.html">
                                                                Bottle with Leather Grip </a></h5>
                                                        <div class="price"><span>$89.00</span> <span class="new-price">$58.00</span></div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- End Single Product -->

                                            <!-- Start Single Product -->
                                            <li>
                                                <div class="product-item">
                                                    <div class="thumbnail">
                                                        <a href="single-product.html">
                                                            <img src="img/product/md-image/product-4.jpg" alt="multi-purpose">
                                                        </a>
                                                    </div>
                                                    <div class="info">
                                                        <h5 class="heading heading-h5"><a href="single-product.html">White
                                                                Sand Hourglass</a></h5>
                                                        <ul class="rating">
                                                            <li><i class="fas fa-star"></i></li>
                                                            <li><i class="fas fa-star"></i></li>
                                                            <li><i class="fas fa-star"></i></li>
                                                            <li><i class="fas fa-star"></i></li>
                                                            <li><i class="fas fa-star"></i></li>
                                                        </ul>
                                                        <div class="price"><span>$89.00</span> <span class="new-price">$58.00</span></div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- End Single Product -->

                                            <!-- Start Single Product -->
                                            <li>
                                                <div class="product-item">
                                                    <div class="thumbnail">
                                                        <a href="single-product.html">
                                                            <img src="img/product/md-image/product-5.jpg" alt="multi-purpose">
                                                        </a>
                                                    </div>
                                                    <div class="info">
                                                        <h5 class="heading heading-h5"><a href="single-product.html">Gold
                                                                Plated Desk Lantern Lamp </a></h5>
                                                        <ul class="rating">
                                                            <li><i class="fas fa-star"></i></li>
                                                            <li><i class="fas fa-star"></i></li>
                                                            <li><i class="fas fa-star"></i></li>
                                                            <li><i class="fas fa-star"></i></li>
                                                            <li><i class="fas fa-star"></i></li>
                                                        </ul>
                                                        <div class="price"><span>$89.00</span> <span class="new-price">$58.00</span></div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- End Single Product -->

                                        </ul>
                                    </div>
                                    <!-- End Single Widget -->

                                    <!-- Start Single Widget -->
                                    <div class="shop-sidebar related-product-inner mt--50 wow move-up">
                                        <h5 class="widget-title">Filter by price</h5>

                                        <div class="content-shopby">
                                            <div class="price_filter s-filter clear">
                                                <form action="#" method="GET">
                                                    <div id="slider-range"></div>
                                                    <div class="slider__range--output">
                                                        <div class="price__output--wrap">
                                                            <div class="price--output">
                                                                <span>Price :</span><input type="text" id="amount" readonly>
                                                            </div>
                                                            <div class="price--filter">
                                                                <a href="#">Filter</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Single Widget -->

                                    <!-- Start Single Widget -->
                                    <div class="shop-sidebar banner mt--50 wow move-up">
                                        <div class="inner">
                                            <div class="thumb">
                                                <img class="w-100" src="img/blog/big-img/banner-image.jpg" alt="banner">
                                            </div>
                                            <div class="content">
                                                <h4 class="heading heading-h4 text-white">Spot for banner</h4>
                                                <div class="banner-btn mt--25">
                                                    <a class="brook-btn bk-btn-theme btn-sd-size btn-rounded space-between" href="#">Purchase</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Start Single Widget -->
                                    <div class="shop-sidebar tag mt--50 wow move-up">
                                        <h5 class="widget-title">Tags</h5>
                                        <div class="inner">
                                            <ul class="tagcloud">
                                                <li><a href="#">architecture</a></li>
                                                <li><a href="#">business</a></li>
                                                <li><a href="#">format</a></li>
                                                <li><a href="#">indie musician</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- End Single Widget -->

                                    <!-- End Single Widget -->
                                    <!-- Start Single Widget -->
                                    <div class="shop-sidebar instagram mt--50 wow move-up">
                                        <h5 class="widget-title">Instagram</h5>

                                        <div class="instagram-grid-wrap instagram-grid-5 inner">
                                            <!-- Start Single Instagram -->
                                            <div class="item-grid grid-style--1">
                                                <div class="thumb">
                                                    <a href="#">
                                                        <img src="img/instagram/instagram-1/instagram-md-1.jpg" alt="instagram images">
                                                    </a>
                                                    <div class="item-info">
                                                        <div class="inner">
                                                            <a href="#"><i class="fas fa-heart"></i>1k</a>
                                                            <a href="#"><i class="fas fa-comment-dots"></i>9</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Start Single Instagram -->

                                            <!-- Start Single Instagram -->
                                            <div class="item-grid grid-style--1">
                                                <div class="thumb">
                                                    <a href="#">
                                                        <img src="img/instagram/instagram-1/instagram-md-2.jpg" alt="instagram images">
                                                    </a>
                                                    <div class="item-info">
                                                        <div class="inner">
                                                            <a href="#"><i class="fas fa-heart"></i>4k</a>
                                                            <a href="#"><i class="fas fa-comment-dots"></i>9</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Start Single Instagram -->

                                            <!-- Start Single Instagram -->
                                            <div class="item-grid grid-style--1">
                                                <div class="thumb">
                                                    <a href="#">
                                                        <img src="img/instagram/instagram-1/instagram-md-3.jpg" alt="instagram images">
                                                    </a>
                                                    <div class="item-info">
                                                        <div class="inner">
                                                            <a href="#"><i class="fas fa-heart"></i>1k</a>
                                                            <a href="#"><i class="fas fa-comment-dots"></i>9</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Start Single Instagram -->

                                            <!-- Start Single Instagram -->
                                            <div class="item-grid grid-style--1">
                                                <div class="thumb">
                                                    <a href="#">
                                                        <img src="img/instagram/instagram-1/instagram-md-4.jpg" alt="instagram images">
                                                    </a>
                                                    <div class="item-info">
                                                        <div class="inner">
                                                            <a href="#"><i class="fas fa-heart"></i>1k</a>
                                                            <a href="#"><i class="fas fa-comment-dots"></i>9</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Start Single Instagram -->

                                            <!-- Start Single Instagram -->
                                            <div class="item-grid grid-style--1">
                                                <div class="thumb">
                                                    <a href="#">
                                                        <img src="img/instagram/instagram-1/instagram-md-5.jpg" alt="instagram images">
                                                    </a>
                                                    <div class="item-info">
                                                        <div class="inner">
                                                            <a href="#"><i class="fas fa-heart"></i>1k</a>
                                                            <a href="#"><i class="fas fa-comment-dots"></i>9</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Start Single Instagram -->

                                            <!-- Start Single Instagram -->
                                            <div class="item-grid grid-style--1">
                                                <div class="thumb">
                                                    <a href="#">
                                                        <img src="img/instagram/instagram-1/instagram-md-6.jpg" alt="instagram images">
                                                    </a>
                                                    <div class="item-info">
                                                        <div class="inner">
                                                            <a href="#"><i class="fas fa-heart"></i>1k</a>
                                                            <a href="#"><i class="fas fa-comment-dots"></i>9</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Start Single Instagram -->
                                        </div>
                                    </div>
                                    <!-- End Single Widget -->

                                </div>
                            </div>
                            <!-- End Sidebar Area -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- End Shop Minimal Area -->

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


    <div class="row" id="tarjetas">
        <!--<div class="tarjeta col-md-4">
            <div class="row cabecera">
                <div class="logo col-md-8"></div>
                <div class="codigo col-md-4"></div>
            </div>
            <div class="row cuerpo">
            </div>
        </div>-->
    </div>

    <di class="row" id="temporal">

    </di>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.3.16/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="server/controllers/barcodes.js"></script>
    <script type="text/javascript" src="server/controllers/get.js"></script>
    <script type="text/javascript" src="server/controllers/html2canvas.js"></script>
    <script type="text/javascript" src="server/controllers/dom-to-image.js"></script>
    <script type="text/javascript" src="server/controllers/index_1658177167.js"></script>
    <script type="text/javascript" src="server/controllers/ajax_cart.js"></script>
    <script type="text/javascript" src="server/controllers/pagination.js"></script>
    <script type="text/javascript" src="server/controllers/catalogo.js"></script>
    <!--<script type="text/javascript" src="server/controllers/catalogo2.js"></script>-->
    <style type="text/css">
        .producto {
            max-height: calc(100vh - 260px);
            margin-bottom: 50px;
        }

        .item {
            padding: 0px;
            display: flex;
        }

        .item img {
            box-shadow: 0px 1px 2px 0px rgba(60, 64, 67, 0.3), 0px 1px 3px 1px rgba(60, 64, 67, 0.15);
            max-width: 87%;
            margin: auto;
        }

        .cabecera .logo {
            padding: 0px;
            max-height: 70px;
            display: flex;
            align-items: center;
            /* max-height: 60px;*/
        }

        .cabecera {
            max-height: 70px;
        }

        .cabecera,
        .product-main-image {
            margin-right: 0px;
            margin-left: 0px;
        }

        .product {
            box-shadow: 0px 1px 2px 0px rgba(60, 64, 67, 0.3), 0px 1px 3px 1px rgba(60, 64, 67, 0.15);
            border-radius: 10px;

        }

        .mini-cart .shopping-cart {
            display: none !important;
        }

        .product-main-image {
            /*background: #fbeeee;*/
            border-radius: 10px;
            padding: 0px 20px;

        }

        .thumbnail {
            padding: 5px;
        }

        .cabecera .codigo {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 5px 0px;
            max-height: 70px;
        }

        .cabecera .logo {
            padding: 5px 0px;
        }

        .codigo img {
            /*max-width: 70%; */
            max-height: 100%;
        }

        .logo img {
            /*max-width: 30%;*/
            max-height: 100%;
        }

        .product .product-thumbnail {
            margin-bottom: 0px;
        }

        .btn-comprar {
            padding: 10px 15px;
            border-radius: 10px;
            font-weight: bold;
            background-color: #000;
            border: none;
            max-height: 50px;
            color: #fff;
            margin-top: 10px;
        }

        .product-info {
            padding-bottom: 10px;
        }

        @media (min-width: 992px) {
            .producto {
                max-height: 100vh;
            }
        }


        @media (max-width: 420px) {
            .item img {
                max-width: 80%;
            }

            .codigo img,
            .logo img {
                max-height: 80%;
            }

            .item {
                margin: 4px 0px !important;
            }

            .producto {
                max-height: calc(100vh - 40px);
            }

            .header-default .header-right .mini-cart-button::after {
                position: absolute;
                top: -1px;
                right: -15px;
                padding: 4px 0px;
                min-width: 18px;
                height: 18px;
                border-radius: 100%;
                font-weight: 500;
                font-size: 12px;
                line-height: 12px;
                /* background-color: rgba(0, 0, 0, 0); */
                color: #fff;
                background: red;
            }
        }

        @media (max-width: 320px) {

            .codigo img,
            .logo img {
                max-height: 60%;
            }

            .product .product-info h5.heading a {}

            .pt-xs-50 {
                padding-top: 35px;
            }

            .btn-comprar {
                padding: 5px 10px;
                margin-top: 1px;
                font-size: 14px;
            }

            .product .product-info h5.heading {
                margin-bottom: 5px;
                font-size: 14px;
            }

            .product .product-info h5.heading a {
                font-size: 14px;
            }
        }

        .btn-seguir.seguir1 {
            margin-top: 15px;
            margin-bottom: 30px;
            display: inline-block;
            border-radius: 5px;
            padding: 10px 0px;
            max-width: 200px;
        }
    </style>

    <div id="preloader" class="clearfix">
        <div class="page-load-inner">
            <div class="preloader-wrap">
                <div class="wrap-2">
                    <div class=""> <img src="img/icons/brook-preloader.gif" alt="Brook Preloader"></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>