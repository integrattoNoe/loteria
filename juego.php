<?php
if (!isset($_COOKIE["lotto_lg"]))
  header("Location: login-register.php?r=game&id=" . $_GET['g']);
?>

<!doctype html>
<html class="no-js juego page-cartones bg-xs-white" lang="zxx">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Juego - Lotería Mexicana</title>
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
  <link rel="stylesheet" type="text/css" href="server/controllers/slick/slick.css" />
  <link rel="stylesheet" type="text/css" href="server/controllers/slick/slick-theme.css" />
  <link rel="stylesheet" type="text/css" href="server/controllers/fontawesome-free-5/css/all.css" />
  <style type="text/css">
    .item {
      padding: 0px 5px;
      margin: 3px 0px !important;
    }

    .logo {
      padding: 0px;
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

    #misOtrasCartas .activo {
      opacity: 1 !important;
      border: 3px solid red;
    }

    #misOtrasCartas .contenedorCarta {
      opacity: .5;
    }

    .slick-prev:before,
    .slick-next:before {
      color: red !important;
    }

    .img-carta img {
      /*max-width: 200px;*/
      margin: auto;
    }

    .nextArrowBtn {
      position: absolute;
      z-index: 1000;
      top: 50%;
      right: 0;
      color: #BFAFB2;
      cursor: pointer;
      font-size: 25px;
      color: #000;
    }

    .prevArrowBtn {
      position: absolute;
      z-index: 1000;
      top: 50%;
      left: 0;
      color: #BFAFB2;
      cursor: pointer;
      font-size: 25px;
      color: #000;
    }

    .icon-box.with-padding .inner {
      padding: 30px 35px 64px;
    }

    .icon-box .inner .icon {
      font-size: 80px;
      /* margin-bottom: 22px; */
      color: #0038E3;
    }

    .contenedor-actual {
      padding-top: 0px !important;
    }
  </style>

</head>

<body class="template-color-3 template-font-1 page-cartones bg-xs-white">
  <!--div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&autoLogAppEvents=1&version=v7.0&appId=311979809924193"></script-->
  <div id="fb-root"></div>
  <script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>
  <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

  <!-- Add your site or application content here -->

  <div id="page-preloader" class="page-loading clearfix">
    <div class="page-load-inner">
      <div class="preloader-wrap">
        <div class="wrap-2">
          <div class=""> <img src="img/icons/brook-preloader.gif" alt="Brook Preloader"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Wrapper -->
  <div id="wrapper" class="wrapper all-wrapper page-cartones bg-xs-white">

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
              <img src="img/logo-loteria.png" alt="logo images">
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


    <!-- Page Conttent -->
    <main class="page-content">

      <!-- Start Icon Boxes -->
      <div id="" class="brook-icon-boxes-area ptb--160 ptb-md--160 ptb-sm--160 pt-xs-120">
        <div class="container-fluid contenedor-juego ">
          <div class="row">
            <div id="vacio" style="display: none; width: 100%; text-align: center;">
              <div class="container">
                <h3>No tienes tarjetas para este juego :(</h3>
                <p><button class="brook-btn bk-btn-theme btn-sd-size btn-rounded space-between" id="irTienda">Conseguir tarjetas</button></p>
              </div>
            </div>
            <div id="vacio2" style="display: none; width: 100%; text-align: center;">
              <div class="container">
                <h3>Debes iniciar sesión para entrar al juego</h3>
                <p><button class="brook-btn bk-btn-theme btn-sd-size btn-rounded space-between" id="sesion1">Iniciar sesión</button></p>
              </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-6 p-xs-0 contenedor-frame">
              <h3 id="nombrePartida"></h3>
              <h4 id="fechaHora"></h4>
              <!--<iframe width="100%" height="315" src="https://www.youtube.com/embed/uQL-yLT4TqU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
              <!--iframe width="100%" height="315" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" class="embed-responsive-item" data-allowfullscreen="1" id="transmisionIframe" data-autoplay="true"></iframe-->
              <!-- Your embedded video player code -->
              <!-- Your embedded video player code -->
              <div class="fb-video" data-href="" data-autoplay="true" data-width="500" data-show-text="false" data-allowfullscreen="true" id="transmisionIframe">
                <div class="fb-xfbml-parse-ignore">
                  <!--blockquote cite="https://fb.watch/dH2sxyjUJM/"> <a href = "https://fb.watch/dH2sxyjUJM/"> How to Share With Just Friends </a> <p> How to share with just friends. </p>Posted by < a href = "https://www.facebook.com/facebook/"> Facebook < /a> on Friday, December 5, 2014 </blockquote-->
                </div>
              </div>

            </div>


            <!----MAZO ACTUAL---->
            <div class="col-lg-4 col-md-4 col-sm-12 col-6 contenedor-actual bg-white rounder-container contenedor-arrastra bg-gris-xs">
              <div class="row1 mt--0 contenedor-cartas p--sm-5 p-xs-0 m-xs-0">
                <div class="col-lg-3 col-md-3 col-sm-3 col-3 p-0 contenedor-cartas01">
                  <!-- Start Single Icon Boxes -->
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="inner">
                      <div class="icon contenedor-carta01">
                        <img class="img-carta01" src="img/bg-mano.png" alt="icon box">
                        <span class="no-carta01">02</span>
                        <p class="titulo-carta01 text-center" href="#"><b>LA MANO</b></p>

                        <!---- FRIJOL ---->
                        <img class="frijol" src="img/frijol.png" alt="frijol">
                        <!-- END FRIJOL ---->

                      </div>
                    </div>
                  </div>
                  <!-- End Single Icon Boxes -->
                </div>
                <div class="contenedor-cartas01 col-lg-3 col-md-3 col-sm-3 col-3 p-0">
                  <!-- Start Single Icon Boxes -->
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="inner">
                      <div class="icon contenedor-carta01">
                        <img class="img-carta01" src="img/bg-mano.png" alt="icon box">
                        <span class="no-carta01">02</span>
                        <p class="titulo-carta01 text-center" href="#"><b>LA MANO</b></p>

                        <!---- FRIJOL ---->
                        <img class="frijol" src="img/frijol.png" alt="frijol">
                        <!-- END FRIJOL ---->
                      </div>
                    </div>
                  </div>
                  <!-- End Single Icon Boxes -->
                </div>
                <div class="contenedor-cartas01 col-lg-3 col-md-3 col-sm-3 col-3 p-0">
                  <!-- Start Single Icon Boxes -->
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="inner">
                      <div class="icon contenedor-carta01">
                        <img class="img-carta01" src="img/bg-mano.png" alt="icon box">
                        <span class="no-carta01">02</span>
                        <p class="titulo-carta01 text-center" href="#"><b>LA MANO</b></p>

                        <!---- FRIJOL ---->
                        <img class="frijol" src="img/frijol.png" alt="frijol">
                        <!-- END FRIJOL ---->
                      </div>
                    </div>
                  </div>
                  <!-- End Single Icon Boxes -->
                </div>
                <div class="contenedor-cartas01 col-lg-3 col-md-3 col-sm-3 col-3 p-0">
                  <!-- Start Single Icon Boxes -->
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="inner">
                      <div class="icon contenedor-carta01">
                        <img class="img-carta01" src="img/bg-mano.png" alt="icon box">
                        <span class="no-carta01">02</span>
                        <p class="titulo-carta01 text-center" href="#"><b>LA MANO</b></p>

                        <!---- FRIJOL ---->
                        <img class="frijol" src="img/frijol.png" alt="frijol">
                        <!-- END FRIJOL ---->
                      </div>
                    </div>
                  </div>
                  <!-- End Single Icon Boxes -->
                </div>
                <div class="contenedor-cartas01 col-lg-3 col-md-3 col-sm-3 col-3 p-0">
                  <!-- Start Single Icon Boxes -->
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="inner">
                      <div class="icon contenedor-carta01">
                        <img class="img-carta01" src="img/bg-mano.png" alt="icon box">
                        <span class="no-carta01">02</span>
                        <p class="titulo-carta01 text-center" href="#"><b>LA MANO</b></p>

                        <!---- FRIJOL ---->
                        <img class="frijol" src="img/frijol.png" alt="frijol">
                        <!-- END FRIJOL ---->
                      </div>
                    </div>
                  </div>
                  <!-- End Single Icon Boxes -->
                </div>
                <div class="contenedor-cartas01 col-lg-3 col-md-3 col-sm-3 col-3 p-0">
                  <!-- Start Single Icon Boxes -->
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="inner">
                      <div class="icon contenedor-carta01">
                        <img class="img-carta01" src="img/bg-mano.png" alt="icon box">
                        <span class="no-carta01">02</span>
                        <p class="titulo-carta01 text-center" href="#"><b>LA MANO</b></p>

                        <!---- FRIJOL ---->
                        <img class="frijol" src="img/frijol.png" alt="frijol">
                        <!-- END FRIJOL ---->
                      </div>
                    </div>
                  </div>
                  <!-- End Single Icon Boxes -->
                </div>
                <div class="contenedor-cartas01 col-lg-3 col-md-3 col-sm-3 col-3 p-0">
                  <!-- Start Single Icon Boxes -->
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="inner">
                      <div class="icon contenedor-carta01">
                        <img class="img-carta01" src="img/bg-mano.png" alt="icon box">
                        <span class="no-carta01">02</span>
                        <p class="titulo-carta01 text-center" href="#"><b>LA MANO</b></p>

                        <!---- FRIJOL ---->
                        <img class="frijol" src="img/frijol.png" alt="frijol">
                        <!-- END FRIJOL ---->
                      </div>
                    </div>
                  </div>
                  <!-- End Single Icon Boxes -->
                </div>
                <div class="contenedor-cartas01 col-lg-3 col-md-3 col-sm-3 col-3 p-0">
                  <!-- Start Single Icon Boxes -->
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="inner">
                      <div class="icon contenedor-carta01">
                        <img class="img-carta01" src="img/bg-mano.png" alt="icon box">
                        <span class="no-carta01">02</span>
                        <p class="titulo-carta01 text-center" href="#"><b>LA MANO</b></p>

                        <!---- FRIJOL ---->
                        <img class="frijol" src="img/frijol.png" alt="frijol">
                        <!-- END FRIJOL ---->
                      </div>
                    </div>
                  </div>
                  <!-- End Single Icon Boxes -->
                </div>
                <div class="contenedor-cartas01 col-lg-3 col-md-3 col-sm-3 col-3 p-0">
                  <!-- Start Single Icon Boxes -->
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="inner">
                      <div class="icon contenedor-carta01">
                        <img class="img-carta01" src="img/bg-mano.png" alt="icon box">
                        <span class="no-carta01">02</span>
                        <p class="titulo-carta01 text-center" href="#"><b>LA MANO</b></p>

                        <!---- FRIJOL ---->
                        <img class="frijol" src="img/frijol.png" alt="frijol">
                        <!-- END FRIJOL ---->
                      </div>
                    </div>
                  </div>
                  <!-- End Single Icon Boxes -->
                </div>
                <div class="contenedor-cartas01 col-lg-3 col-md-3 col-sm-3 col-3 p-0">
                  <!-- Start Single Icon Boxes -->
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="inner">
                      <div class="icon contenedor-carta01">
                        <img class="img-carta01" src="img/bg-mano.png" alt="icon box">
                        <span class="no-carta01">02</span>
                        <p class="titulo-carta01 text-center" href="#"><b>LA MANO</b></p>

                        <!---- FRIJOL ---->
                        <img class="frijol" src="img/frijol.png" alt="frijol">
                        <!-- END FRIJOL ---->
                      </div>
                    </div>
                  </div>
                  <!-- End Single Icon Boxes -->
                </div>
                <div class="contenedor-cartas01 col-lg-3 col-md-3 col-sm-3 col-3 p-0">
                  <!-- Start Single Icon Boxes -->
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="inner">
                      <div class="icon contenedor-carta01">
                        <img class="img-carta01" src="img/bg-mano.png" alt="icon box">
                        <span class="no-carta01">02</span>
                        <p class="titulo-carta01 text-center" href="#"><b>LA MANO</b></p>

                        <!---- FRIJOL ---->
                        <img class="frijol" src="img/frijol.png" alt="frijol">
                        <!-- END FRIJOL ---->
                      </div>
                    </div>
                  </div>
                  <!-- End Single Icon Boxes -->
                </div>
                <div class="contenedor-cartas01 col-lg-3 col-md-3 col-sm-3 col-3 p-0">
                  <!-- Start Single Icon Boxes -->
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="inner">
                      <div class="icon contenedor-carta01">
                        <img class="img-carta01" src="img/bg-mano.png" alt="icon box">
                        <span class="no-carta01">02</span>
                        <p class="titulo-carta01 text-center" href="#"><b>LA MANO</b></p>

                        <!---- FRIJOL ---->
                        <img class="frijol" src="img/frijol.png" alt="frijol">
                        <!-- END FRIJOL ---->
                      </div>
                    </div>
                  </div>
                  <!-- End Single Icon Boxes -->
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-sm-4 col-md-12 col-xs-12 p-0">
              <!---- OTRAS CARTAS ---->
              <div class="col-lg-12 col-md-12 col-sm-8 col-12 contenedor-otras">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="brook-section-title mb--0">
                      <h4 class=" font-largm mb--0"><b>Mis otras cartas</b></h4>
                    </div>
                  </div>
                </div>

                <div class="mt--0 contenedor-cartas-s pt--30 pb--30">
                  <div class="" id="misOtrasCartas">



                  </div>


                  <!-- Start Single Team -->
                  <!--<div class="team team__style--3 move-up wow">
                                        <div class="thumb">
                                            
                                        </div>
                                    </div>-->
                  <!-- End Single Team -->
                </div>
              </div>

              <!---- CARTA TIEMPO ---->
              <div class="col-lg-12 col-md-12 col-sm-12 col-12 p-0 contenedor-mazo">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                  <div class="brook-section-title text-center mb--0">
                    <!--<h3 class="heading heading-cartas font-largm mb--0">Mazo de cartas</h3>-->
                  </div>
                </div>
                <!-- Start Single Icon Boxes -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-12  mt--15">
                  <div class="icon-box text-center no-border with-padding mt--10">
                    <div class="inner">
                      <!--<h3 id="cantadasAlert"></h3>
                                        <div class="icon img-carta" id="cartaActual">
                                        </div>-->

                      <div class="icon text-left">
                        <div class="row1">
                          <div class="col-lg-12 col-md-12 col-12 col-12 p-0">
                            <h4 class="" href="#"><b>Últimas cantadas</b></h4>
                          </div>
                          <div class="col-lg-12 col-md-12 col-12 col-12 p-0">
                            <div id="anteriores"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Single Icon Boxes -->
              </div>

            </div>

          </div>
        </div>
      </div>
      <!-- End Icon Boxes -->

    </main>
    <!--// Page Conttent -->
  </div>

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
  <script type="text/javascript" src="server/controllers/slick/slick.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.3.16/dist/sweetalert2.all.min.js"></script>
  <script type="text/javascript" src="server/controllers/barcodes.js"></script>
  <script type="text/javascript" src="server/controllers/get.js"></script>
  <script type="text/javascript" src="server/controllers/index_1658177167.js"></script>
  <script type="text/javascript" src="server/controllers/juego_1655424000.js"></script>


  <style type="text/css">
    .frijolito {
      position: absolute;
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
      margin: auto;
    }
  </style>
  <style type="text/css">
    .nextArrowBtn {
      position: absolute;
      z-index: 1000;
      top: 50%;
      right: -30px;
      color: #BFAFB2;
      cursor: pointer;
      font-size: 25px;
      color: #000;
    }

    .prevArrowBtn {
      position: absolute;
      z-index: 1000;
      top: 50%;
      left: -30px;
      color: #BFAFB2;
      cursor: pointer;
      font-size: 25px;
      color: #000;
    }

    .team {
      width: 90% !important;
      visibility: visible;
      background: #e2e2e2;
      padding: 10px;
      min-height: 250px;
      margin: auto;
      display: flex !important;
      flex-flow: column;
      justify-content: center;
      align-items: center;
      border-radius: 10px;

    }

    .slick-list {
      padding: 30px 0px;
    }

    .img-carta {
      padding: 5px;
      display: flex !important;
      justify-content: center;
      align-items: center;
    }

    .product-main-image {
      padding: 10px 0px;
    }

    .slick-list {
      padding: 0px;
    }

    .contenedor-cartas-s {
      padding: 0px 5px;
    }

    .img-carta {
      min-height: 150px;
    }

    .img-carta img {
      padding-top: 0px;
    }

    .brook-icon-boxes-area {
      padding-bottom: 0px;
    }

    .ganador {
      text-align: center;
    }

    .mainCard .ganador p {
      margin: 0;
      font-size: 20px;
      background: #4CAF50;
      border-radius: 10px;
      color: #fff;
      padding: 5px 0px;
      margin-bottom: 10px;
    }

    .otherCard .ganador p {
      margin: 0;
      font-size: 16px;
      background: #4CAF50;
      border-radius: 5px;
      color: #fff;
      padding: 2px 0px;
      margin-bottom: 10px;
    }
  </style>


  <div id="ganadorAnim">
    <div class="confetti-149"></div>
    <div class="confetti-148"></div>
    <div class="confetti-147"></div>
    <div class="confetti-146"></div>
    <div class="confetti-145"></div>
    <div class="confetti-144"></div>
    <div class="confetti-143"></div>
    <div class="confetti-142"></div>
    <div class="confetti-141"></div>
    <div class="confetti-140"></div>
    <div class="confetti-139"></div>
    <div class="confetti-138"></div>
    <div class="confetti-137"></div>
    <div class="confetti-136"></div>
    <div class="confetti-135"></div>
    <div class="confetti-134"></div>
    <div class="confetti-133"></div>
    <div class="confetti-132"></div>
    <div class="confetti-131"></div>
    <div class="confetti-130"></div>
    <div class="confetti-129"></div>
    <div class="confetti-128"></div>
    <div class="confetti-127"></div>
    <div class="confetti-126"></div>
    <div class="confetti-125"></div>
    <div class="confetti-124"></div>
    <div class="confetti-123"></div>
    <div class="confetti-122"></div>
    <div class="confetti-121"></div>
    <div class="confetti-120"></div>
    <div class="confetti-119"></div>
    <div class="confetti-118"></div>
    <div class="confetti-117"></div>
    <div class="confetti-116"></div>
    <div class="confetti-115"></div>
    <div class="confetti-114"></div>
    <div class="confetti-113"></div>
    <div class="confetti-112"></div>
    <div class="confetti-111"></div>
    <div class="confetti-110"></div>
    <div class="confetti-109"></div>
    <div class="confetti-108"></div>
    <div class="confetti-107"></div>
    <div class="confetti-106"></div>
    <div class="confetti-105"></div>
    <div class="confetti-104"></div>
    <div class="confetti-103"></div>
    <div class="confetti-102"></div>
    <div class="confetti-101"></div>
    <div class="confetti-100"></div>
    <div class="confetti-99"></div>
    <div class="confetti-98"></div>
    <div class="confetti-97"></div>
    <div class="confetti-96"></div>
    <div class="confetti-95"></div>
    <div class="confetti-94"></div>
    <div class="confetti-93"></div>
    <div class="confetti-92"></div>
    <div class="confetti-91"></div>
    <div class="confetti-90"></div>
    <div class="confetti-89"></div>
    <div class="confetti-88"></div>
    <div class="confetti-87"></div>
    <div class="confetti-86"></div>
    <div class="confetti-85"></div>
    <div class="confetti-84"></div>
    <div class="confetti-83"></div>
    <div class="confetti-82"></div>
    <div class="confetti-81"></div>
    <div class="confetti-80"></div>
    <div class="confetti-79"></div>
    <div class="confetti-78"></div>
    <div class="confetti-77"></div>
    <div class="confetti-76"></div>
    <div class="confetti-75"></div>
    <div class="confetti-74"></div>
    <div class="confetti-73"></div>
    <div class="confetti-72"></div>
    <div class="confetti-71"></div>
    <div class="confetti-70"></div>
    <div class="confetti-69"></div>
    <div class="confetti-68"></div>
    <div class="confetti-67"></div>
    <div class="confetti-66"></div>
    <div class="confetti-65"></div>
    <div class="confetti-64"></div>
    <div class="confetti-63"></div>
    <div class="confetti-62"></div>
    <div class="confetti-61"></div>
    <div class="confetti-60"></div>
    <div class="confetti-59"></div>
    <div class="confetti-58"></div>
    <div class="confetti-57"></div>
    <div class="confetti-56"></div>
    <div class="confetti-55"></div>
    <div class="confetti-54"></div>
    <div class="confetti-53"></div>
    <div class="confetti-52"></div>
    <div class="confetti-51"></div>
    <div class="confetti-50"></div>
    <div class="confetti-49"></div>
    <div class="confetti-48"></div>
    <div class="confetti-47"></div>
    <div class="confetti-46"></div>
    <div class="confetti-45"></div>
    <div class="confetti-44"></div>
    <div class="confetti-43"></div>
    <div class="confetti-42"></div>
    <div class="confetti-41"></div>
    <div class="confetti-40"></div>
    <div class="confetti-39"></div>
    <div class="confetti-38"></div>
    <div class="confetti-37"></div>
    <div class="confetti-36"></div>
    <div class="confetti-35"></div>
    <div class="confetti-34"></div>
    <div class="confetti-33"></div>
    <div class="confetti-32"></div>
    <div class="confetti-31"></div>
    <div class="confetti-30"></div>
    <div class="confetti-29"></div>
    <div class="confetti-28"></div>
    <div class="confetti-27"></div>
    <div class="confetti-26"></div>
    <div class="confetti-25"></div>
    <div class="confetti-24"></div>
    <div class="confetti-23"></div>
    <div class="confetti-22"></div>
    <div class="confetti-21"></div>
    <div class="confetti-20"></div>
    <div class="confetti-19"></div>
    <div class="confetti-18"></div>
    <div class="confetti-17"></div>
    <div class="confetti-16"></div>
    <div class="confetti-15"></div>
    <div class="confetti-14"></div>
    <div class="confetti-13"></div>
    <div class="confetti-12"></div>
    <div class="confetti-11"></div>
    <div class="confetti-10"></div>
    <div class="confetti-9"></div>
    <div class="confetti-8"></div>
    <div class="confetti-7"></div>
    <div class="confetti-6"></div>
    <div class="confetti-5"></div>
    <div class="confetti-4"></div>
    <div class="confetti-3"></div>
    <div class="confetti-2"></div>
    <div class="confetti-1"></div>
    <div class="confetti-0"></div>
  </div>

  <style type="text/css">
    #ganadorAnim {
      position: absolute;
      min-height: 100vh;
      z-index: 9;
      width: 100vw;
      display: none;
      top: 0;
    }

    [class|=confetti] {
      position: absolute;
    }

    .confetti-0 {
      width: 1px;
      height: 0.4px;
      background-color: #263672;
      top: -10%;
      left: 46%;
      opacity: 1.179791915;
      transform: rotate(343.5674097657deg);
      -webkit-animation: drop-0 4.1976007711s 0.5095335565s infinite;
      animation: drop-0 4.1976007711s 0.5095335565s infinite;
    }

    @-webkit-keyframes drop-0 {
      100% {
        top: 110%;
        left: 59%;
      }
    }

    @keyframes drop-0 {
      100% {
        top: 110%;
        left: 59%;
      }
    }

    .confetti-1 {
      width: 2px;
      height: 0.8px;
      background-color: #ffbf00;
      top: -10%;
      left: 22%;
      opacity: 0.5047853041;
      transform: rotate(282.9645353386deg);
      -webkit-animation: drop-1 4.0757607051s 0.8057421539s infinite;
      animation: drop-1 4.0757607051s 0.8057421539s infinite;
    }

    @-webkit-keyframes drop-1 {
      100% {
        top: 110%;
        left: 31%;
      }
    }

    @keyframes drop-1 {
      100% {
        top: 110%;
        left: 31%;
      }
    }

    .confetti-2 {
      width: 8px;
      height: 3.2px;
      background-color: #ffbf00;
      top: -10%;
      left: 77%;
      opacity: 0.7512050283;
      transform: rotate(119.244043546deg);
      -webkit-animation: drop-2 4.0582654599s 0.181525523s infinite;
      animation: drop-2 4.0582654599s 0.181525523s infinite;
    }

    @-webkit-keyframes drop-2 {
      100% {
        top: 110%;
        left: 87%;
      }
    }

    @keyframes drop-2 {
      100% {
        top: 110%;
        left: 87%;
      }
    }

    .confetti-3 {
      width: 1px;
      height: 0.4px;
      background-color: #d13447;
      top: -10%;
      left: 50%;
      opacity: 0.6517538426;
      transform: rotate(186.7435347247deg);
      -webkit-animation: drop-3 4.4493988534s 0.1998613798s infinite;
      animation: drop-3 4.4493988534s 0.1998613798s infinite;
    }

    @-webkit-keyframes drop-3 {
      100% {
        top: 110%;
        left: 60%;
      }
    }

    @keyframes drop-3 {
      100% {
        top: 110%;
        left: 60%;
      }
    }

    .confetti-4 {
      width: 1px;
      height: 0.4px;
      background-color: #d13447;
      top: -10%;
      left: 46%;
      opacity: 1.4794963691;
      transform: rotate(214.9644302686deg);
      -webkit-animation: drop-4 4.8599105767s 0.1776190295s infinite;
      animation: drop-4 4.8599105767s 0.1776190295s infinite;
    }

    @-webkit-keyframes drop-4 {
      100% {
        top: 110%;
        left: 54%;
      }
    }

    @keyframes drop-4 {
      100% {
        top: 110%;
        left: 54%;
      }
    }

    .confetti-5 {
      width: 4px;
      height: 1.6px;
      background-color: #ffbf00;
      top: -10%;
      left: 26%;
      opacity: 0.6686208342;
      transform: rotate(32.7845193788deg);
      -webkit-animation: drop-5 4.3406779074s 0.7920790387s infinite;
      animation: drop-5 4.3406779074s 0.7920790387s infinite;
    }

    @-webkit-keyframes drop-5 {
      100% {
        top: 110%;
        left: 33%;
      }
    }

    @keyframes drop-5 {
      100% {
        top: 110%;
        left: 33%;
      }
    }

    .confetti-6 {
      width: 7px;
      height: 2.8px;
      background-color: #ffbf00;
      top: -10%;
      left: 67%;
      opacity: 1.1027704231;
      transform: rotate(35.9474308392deg);
      -webkit-animation: drop-6 4.2936449987s 0.7358219544s infinite;
      animation: drop-6 4.2936449987s 0.7358219544s infinite;
    }

    @-webkit-keyframes drop-6 {
      100% {
        top: 110%;
        left: 69%;
      }
    }

    @keyframes drop-6 {
      100% {
        top: 110%;
        left: 69%;
      }
    }

    .confetti-7 {
      width: 8px;
      height: 3.2px;
      background-color: #d13447;
      top: -10%;
      left: 1%;
      opacity: 1.0043647868;
      transform: rotate(119.912250545deg);
      -webkit-animation: drop-7 4.9278229745s 0.0659775325s infinite;
      animation: drop-7 4.9278229745s 0.0659775325s infinite;
    }

    @-webkit-keyframes drop-7 {
      100% {
        top: 110%;
        left: 5%;
      }
    }

    @keyframes drop-7 {
      100% {
        top: 110%;
        left: 5%;
      }
    }

    .confetti-8 {
      width: 1px;
      height: 0.4px;
      background-color: #d13447;
      top: -10%;
      left: 85%;
      opacity: 1.1681679855;
      transform: rotate(343.3967109461deg);
      -webkit-animation: drop-8 4.9364065754s 0.911074513s infinite;
      animation: drop-8 4.9364065754s 0.911074513s infinite;
    }

    @-webkit-keyframes drop-8 {
      100% {
        top: 110%;
        left: 89%;
      }
    }

    @keyframes drop-8 {
      100% {
        top: 110%;
        left: 89%;
      }
    }

    .confetti-9 {
      width: 7px;
      height: 2.8px;
      background-color: #d13447;
      top: -10%;
      left: 100%;
      opacity: 1.2789427398;
      transform: rotate(259.874947994deg);
      -webkit-animation: drop-9 4.1828887842s 0.2968977513s infinite;
      animation: drop-9 4.1828887842s 0.2968977513s infinite;
    }

    @-webkit-keyframes drop-9 {
      100% {
        top: 110%;
        left: 113%;
      }
    }

    @keyframes drop-9 {
      100% {
        top: 110%;
        left: 113%;
      }
    }

    .confetti-10 {
      width: 5px;
      height: 2px;
      background-color: #d13447;
      top: -10%;
      left: 21%;
      opacity: 0.7245635759;
      transform: rotate(155.2735238783deg);
      -webkit-animation: drop-10 4.3529574933s 0.412277623s infinite;
      animation: drop-10 4.3529574933s 0.412277623s infinite;
    }

    @-webkit-keyframes drop-10 {
      100% {
        top: 110%;
        left: 34%;
      }
    }

    @keyframes drop-10 {
      100% {
        top: 110%;
        left: 34%;
      }
    }

    .confetti-11 {
      width: 1px;
      height: 0.4px;
      background-color: #ffbf00;
      top: -10%;
      left: 49%;
      opacity: 0.9947992253;
      transform: rotate(178.4325884897deg);
      -webkit-animation: drop-11 4.7622036651s 0.9872556037s infinite;
      animation: drop-11 4.7622036651s 0.9872556037s infinite;
    }

    @-webkit-keyframes drop-11 {
      100% {
        top: 110%;
        left: 51%;
      }
    }

    @keyframes drop-11 {
      100% {
        top: 110%;
        left: 51%;
      }
    }

    .confetti-12 {
      width: 7px;
      height: 2.8px;
      background-color: #263672;
      top: -10%;
      left: 19%;
      opacity: 1.3758106933;
      transform: rotate(17.5317053978deg);
      -webkit-animation: drop-12 4.1909414365s 0.7233141091s infinite;
      animation: drop-12 4.1909414365s 0.7233141091s infinite;
    }

    @-webkit-keyframes drop-12 {
      100% {
        top: 110%;
        left: 26%;
      }
    }

    @keyframes drop-12 {
      100% {
        top: 110%;
        left: 26%;
      }
    }

    .confetti-13 {
      width: 6px;
      height: 2.4px;
      background-color: #ffbf00;
      top: -10%;
      left: 30%;
      opacity: 0.5822646373;
      transform: rotate(239.108841588deg);
      -webkit-animation: drop-13 4.8755367245s 0.6140268851s infinite;
      animation: drop-13 4.8755367245s 0.6140268851s infinite;
    }

    @-webkit-keyframes drop-13 {
      100% {
        top: 110%;
        left: 45%;
      }
    }

    @keyframes drop-13 {
      100% {
        top: 110%;
        left: 45%;
      }
    }

    .confetti-14 {
      width: 7px;
      height: 2.8px;
      background-color: #d13447;
      top: -10%;
      left: 80%;
      opacity: 1.3992840936;
      transform: rotate(3.9586766657deg);
      -webkit-animation: drop-14 4.5533026947s 0.6633948268s infinite;
      animation: drop-14 4.5533026947s 0.6633948268s infinite;
    }

    @-webkit-keyframes drop-14 {
      100% {
        top: 110%;
        left: 85%;
      }
    }

    @keyframes drop-14 {
      100% {
        top: 110%;
        left: 85%;
      }
    }

    .confetti-15 {
      width: 2px;
      height: 0.8px;
      background-color: #d13447;
      top: -10%;
      left: 84%;
      opacity: 1.416187105;
      transform: rotate(116.9912457078deg);
      -webkit-animation: drop-15 4.6304012653s 0.7504487272s infinite;
      animation: drop-15 4.6304012653s 0.7504487272s infinite;
    }

    @-webkit-keyframes drop-15 {
      100% {
        top: 110%;
        left: 89%;
      }
    }

    @keyframes drop-15 {
      100% {
        top: 110%;
        left: 89%;
      }
    }

    .confetti-16 {
      width: 5px;
      height: 2px;
      background-color: #ffbf00;
      top: -10%;
      left: 62%;
      opacity: 0.5944888918;
      transform: rotate(98.2835282873deg);
      -webkit-animation: drop-16 4.2094123849s 0.6089845801s infinite;
      animation: drop-16 4.2094123849s 0.6089845801s infinite;
    }

    @-webkit-keyframes drop-16 {
      100% {
        top: 110%;
        left: 70%;
      }
    }

    @keyframes drop-16 {
      100% {
        top: 110%;
        left: 70%;
      }
    }

    .confetti-17 {
      width: 2px;
      height: 0.8px;
      background-color: #d13447;
      top: -10%;
      left: 78%;
      opacity: 1.3276430058;
      transform: rotate(23.0816652494deg);
      -webkit-animation: drop-17 4.4732947027s 0.9862628678s infinite;
      animation: drop-17 4.4732947027s 0.9862628678s infinite;
    }

    @-webkit-keyframes drop-17 {
      100% {
        top: 110%;
        left: 90%;
      }
    }

    @keyframes drop-17 {
      100% {
        top: 110%;
        left: 90%;
      }
    }

    .confetti-18 {
      width: 5px;
      height: 2px;
      background-color: #ffbf00;
      top: -10%;
      left: 72%;
      opacity: 0.7008871828;
      transform: rotate(123.3375379985deg);
      -webkit-animation: drop-18 4.2954374676s 0.6103346945s infinite;
      animation: drop-18 4.2954374676s 0.6103346945s infinite;
    }

    @-webkit-keyframes drop-18 {
      100% {
        top: 110%;
        left: 87%;
      }
    }

    @keyframes drop-18 {
      100% {
        top: 110%;
        left: 87%;
      }
    }

    .confetti-19 {
      width: 4px;
      height: 1.6px;
      background-color: #ffbf00;
      top: -10%;
      left: 54%;
      opacity: 1.4170940958;
      transform: rotate(64.439991366deg);
      -webkit-animation: drop-19 4.0843289879s 0.9882429562s infinite;
      animation: drop-19 4.0843289879s 0.9882429562s infinite;
    }

    @-webkit-keyframes drop-19 {
      100% {
        top: 110%;
        left: 62%;
      }
    }

    @keyframes drop-19 {
      100% {
        top: 110%;
        left: 62%;
      }
    }

    .confetti-20 {
      width: 2px;
      height: 0.8px;
      background-color: #263672;
      top: -10%;
      left: 14%;
      opacity: 0.9103426147;
      transform: rotate(330.9581668815deg);
      -webkit-animation: drop-20 4.0025011911s 0.1197349976s infinite;
      animation: drop-20 4.0025011911s 0.1197349976s infinite;
    }

    @-webkit-keyframes drop-20 {
      100% {
        top: 110%;
        left: 19%;
      }
    }

    @keyframes drop-20 {
      100% {
        top: 110%;
        left: 19%;
      }
    }

    .confetti-21 {
      width: 8px;
      height: 3.2px;
      background-color: #d13447;
      top: -10%;
      left: 51%;
      opacity: 0.5721771012;
      transform: rotate(84.6944237172deg);
      -webkit-animation: drop-21 4.1388087337s 0.8980022642s infinite;
      animation: drop-21 4.1388087337s 0.8980022642s infinite;
    }

    @-webkit-keyframes drop-21 {
      100% {
        top: 110%;
        left: 62%;
      }
    }

    @keyframes drop-21 {
      100% {
        top: 110%;
        left: 62%;
      }
    }

    .confetti-22 {
      width: 3px;
      height: 1.2px;
      background-color: #d13447;
      top: -10%;
      left: 39%;
      opacity: 1.2450630534;
      transform: rotate(192.8374890482deg);
      -webkit-animation: drop-22 4.8844940467s 0.7054672091s infinite;
      animation: drop-22 4.8844940467s 0.7054672091s infinite;
    }

    @-webkit-keyframes drop-22 {
      100% {
        top: 110%;
        left: 44%;
      }
    }

    @keyframes drop-22 {
      100% {
        top: 110%;
        left: 44%;
      }
    }

    .confetti-23 {
      width: 5px;
      height: 2px;
      background-color: #d13447;
      top: -10%;
      left: 45%;
      opacity: 1.0319430276;
      transform: rotate(142.2066017626deg);
      -webkit-animation: drop-23 4.2575909704s 0.4941927616s infinite;
      animation: drop-23 4.2575909704s 0.4941927616s infinite;
    }

    @-webkit-keyframes drop-23 {
      100% {
        top: 110%;
        left: 52%;
      }
    }

    @keyframes drop-23 {
      100% {
        top: 110%;
        left: 52%;
      }
    }

    .confetti-24 {
      width: 6px;
      height: 2.4px;
      background-color: #ffbf00;
      top: -10%;
      left: 13%;
      opacity: 0.6129060661;
      transform: rotate(21.1439908698deg);
      -webkit-animation: drop-24 4.6863488836s 0.0449452005s infinite;
      animation: drop-24 4.6863488836s 0.0449452005s infinite;
    }

    @-webkit-keyframes drop-24 {
      100% {
        top: 110%;
        left: 25%;
      }
    }

    @keyframes drop-24 {
      100% {
        top: 110%;
        left: 25%;
      }
    }

    .confetti-25 {
      width: 1px;
      height: 0.4px;
      background-color: #ffbf00;
      top: -10%;
      left: 16%;
      opacity: 1.3988867344;
      transform: rotate(292.53719561deg);
      -webkit-animation: drop-25 4.4390018314s 0.9468238736s infinite;
      animation: drop-25 4.4390018314s 0.9468238736s infinite;
    }

    @-webkit-keyframes drop-25 {
      100% {
        top: 110%;
        left: 31%;
      }
    }

    @keyframes drop-25 {
      100% {
        top: 110%;
        left: 31%;
      }
    }

    .confetti-26 {
      width: 5px;
      height: 2px;
      background-color: #d13447;
      top: -10%;
      left: 71%;
      opacity: 1.4015106235;
      transform: rotate(302.475210428deg);
      -webkit-animation: drop-26 4.1427039007s 0.8368261036s infinite;
      animation: drop-26 4.1427039007s 0.8368261036s infinite;
    }

    @-webkit-keyframes drop-26 {
      100% {
        top: 110%;
        left: 80%;
      }
    }

    @keyframes drop-26 {
      100% {
        top: 110%;
        left: 80%;
      }
    }

    .confetti-27 {
      width: 5px;
      height: 2px;
      background-color: #ffbf00;
      top: -10%;
      left: 27%;
      opacity: 1.1378510545;
      transform: rotate(304.6808785742deg);
      -webkit-animation: drop-27 4.5540621235s 0.8129718925s infinite;
      animation: drop-27 4.5540621235s 0.8129718925s infinite;
    }

    @-webkit-keyframes drop-27 {
      100% {
        top: 110%;
        left: 28%;
      }
    }

    @keyframes drop-27 {
      100% {
        top: 110%;
        left: 28%;
      }
    }

    .confetti-28 {
      width: 6px;
      height: 2.4px;
      background-color: #263672;
      top: -10%;
      left: 26%;
      opacity: 1.16140049;
      transform: rotate(20.9785808926deg);
      -webkit-animation: drop-28 4.9945131955s 0.0032902884s infinite;
      animation: drop-28 4.9945131955s 0.0032902884s infinite;
    }

    @-webkit-keyframes drop-28 {
      100% {
        top: 110%;
        left: 29%;
      }
    }

    @keyframes drop-28 {
      100% {
        top: 110%;
        left: 29%;
      }
    }

    .confetti-29 {
      width: 5px;
      height: 2px;
      background-color: #263672;
      top: -10%;
      left: 25%;
      opacity: 1.0913502067;
      transform: rotate(306.5338207441deg);
      -webkit-animation: drop-29 4.9644778634s 0.0231428347s infinite;
      animation: drop-29 4.9644778634s 0.0231428347s infinite;
    }

    @-webkit-keyframes drop-29 {
      100% {
        top: 110%;
        left: 29%;
      }
    }

    @keyframes drop-29 {
      100% {
        top: 110%;
        left: 29%;
      }
    }

    .confetti-30 {
      width: 3px;
      height: 1.2px;
      background-color: #ffbf00;
      top: -10%;
      left: 9%;
      opacity: 1.2492101237;
      transform: rotate(274.9646680482deg);
      -webkit-animation: drop-30 4.0483607576s 0.1908317801s infinite;
      animation: drop-30 4.0483607576s 0.1908317801s infinite;
    }

    @-webkit-keyframes drop-30 {
      100% {
        top: 110%;
        left: 24%;
      }
    }

    @keyframes drop-30 {
      100% {
        top: 110%;
        left: 24%;
      }
    }

    .confetti-31 {
      width: 6px;
      height: 2.4px;
      background-color: #d13447;
      top: -10%;
      left: 77%;
      opacity: 1.3656833571;
      transform: rotate(229.9601317863deg);
      -webkit-animation: drop-31 4.3479834977s 0.904994859s infinite;
      animation: drop-31 4.3479834977s 0.904994859s infinite;
    }

    @-webkit-keyframes drop-31 {
      100% {
        top: 110%;
        left: 86%;
      }
    }

    @keyframes drop-31 {
      100% {
        top: 110%;
        left: 86%;
      }
    }

    .confetti-32 {
      width: 7px;
      height: 2.8px;
      background-color: #ffbf00;
      top: -10%;
      left: 23%;
      opacity: 1.1633576578;
      transform: rotate(143.3572310835deg);
      -webkit-animation: drop-32 4.8719034284s 0.7449858209s infinite;
      animation: drop-32 4.8719034284s 0.7449858209s infinite;
    }

    @-webkit-keyframes drop-32 {
      100% {
        top: 110%;
        left: 34%;
      }
    }

    @keyframes drop-32 {
      100% {
        top: 110%;
        left: 34%;
      }
    }

    .confetti-33 {
      width: 6px;
      height: 2.4px;
      background-color: #263672;
      top: -10%;
      left: 59%;
      opacity: 1.3662137266;
      transform: rotate(194.4338720722deg);
      -webkit-animation: drop-33 4.9296365653s 0.6798428044s infinite;
      animation: drop-33 4.9296365653s 0.6798428044s infinite;
    }

    @-webkit-keyframes drop-33 {
      100% {
        top: 110%;
        left: 64%;
      }
    }

    @keyframes drop-33 {
      100% {
        top: 110%;
        left: 64%;
      }
    }

    .confetti-34 {
      width: 3px;
      height: 1.2px;
      background-color: #d13447;
      top: -10%;
      left: 68%;
      opacity: 1.2440925229;
      transform: rotate(299.5900652439deg);
      -webkit-animation: drop-34 4.3277193571s 0.3089843737s infinite;
      animation: drop-34 4.3277193571s 0.3089843737s infinite;
    }

    @-webkit-keyframes drop-34 {
      100% {
        top: 110%;
        left: 75%;
      }
    }

    @keyframes drop-34 {
      100% {
        top: 110%;
        left: 75%;
      }
    }

    .confetti-35 {
      width: 6px;
      height: 2.4px;
      background-color: #ffbf00;
      top: -10%;
      left: 65%;
      opacity: 1.1678849458;
      transform: rotate(96.1339993292deg);
      -webkit-animation: drop-35 4.510909727s 0.0478257885s infinite;
      animation: drop-35 4.510909727s 0.0478257885s infinite;
    }

    @-webkit-keyframes drop-35 {
      100% {
        top: 110%;
        left: 78%;
      }
    }

    @keyframes drop-35 {
      100% {
        top: 110%;
        left: 78%;
      }
    }

    .confetti-36 {
      width: 7px;
      height: 2.8px;
      background-color: #263672;
      top: -10%;
      left: 45%;
      opacity: 0.8147994193;
      transform: rotate(278.7477120724deg);
      -webkit-animation: drop-36 4.6735172545s 0.3698381432s infinite;
      animation: drop-36 4.6735172545s 0.3698381432s infinite;
    }

    @-webkit-keyframes drop-36 {
      100% {
        top: 110%;
        left: 58%;
      }
    }

    @keyframes drop-36 {
      100% {
        top: 110%;
        left: 58%;
      }
    }

    .confetti-37 {
      width: 6px;
      height: 2.4px;
      background-color: #263672;
      top: -10%;
      left: 56%;
      opacity: 1.0539419046;
      transform: rotate(88.4721841076deg);
      -webkit-animation: drop-37 4.5722710051s 0.5649370889s infinite;
      animation: drop-37 4.5722710051s 0.5649370889s infinite;
    }

    @-webkit-keyframes drop-37 {
      100% {
        top: 110%;
        left: 60%;
      }
    }

    @keyframes drop-37 {
      100% {
        top: 110%;
        left: 60%;
      }
    }

    .confetti-38 {
      width: 5px;
      height: 2px;
      background-color: #263672;
      top: -10%;
      left: 67%;
      opacity: 1.3137585747;
      transform: rotate(263.4256990375deg);
      -webkit-animation: drop-38 4.5014103555s 0.7315208317s infinite;
      animation: drop-38 4.5014103555s 0.7315208317s infinite;
    }

    @-webkit-keyframes drop-38 {
      100% {
        top: 110%;
        left: 69%;
      }
    }

    @keyframes drop-38 {
      100% {
        top: 110%;
        left: 69%;
      }
    }

    .confetti-39 {
      width: 2px;
      height: 0.8px;
      background-color: #263672;
      top: -10%;
      left: 77%;
      opacity: 0.6299027753;
      transform: rotate(157.3953942676deg);
      -webkit-animation: drop-39 4.8309803727s 0.8936021773s infinite;
      animation: drop-39 4.8309803727s 0.8936021773s infinite;
    }

    @-webkit-keyframes drop-39 {
      100% {
        top: 110%;
        left: 89%;
      }
    }

    @keyframes drop-39 {
      100% {
        top: 110%;
        left: 89%;
      }
    }

    .confetti-40 {
      width: 4px;
      height: 1.6px;
      background-color: #d13447;
      top: -10%;
      left: 17%;
      opacity: 0.5869953285;
      transform: rotate(277.0937312854deg);
      -webkit-animation: drop-40 4.5504548995s 0.7975053218s infinite;
      animation: drop-40 4.5504548995s 0.7975053218s infinite;
    }

    @-webkit-keyframes drop-40 {
      100% {
        top: 110%;
        left: 19%;
      }
    }

    @keyframes drop-40 {
      100% {
        top: 110%;
        left: 19%;
      }
    }

    .confetti-41 {
      width: 4px;
      height: 1.6px;
      background-color: #263672;
      top: -10%;
      left: 68%;
      opacity: 0.5363903231;
      transform: rotate(155.6135940351deg);
      -webkit-animation: drop-41 4.3643665587s 0.3871465106s infinite;
      animation: drop-41 4.3643665587s 0.3871465106s infinite;
    }

    @-webkit-keyframes drop-41 {
      100% {
        top: 110%;
        left: 69%;
      }
    }

    @keyframes drop-41 {
      100% {
        top: 110%;
        left: 69%;
      }
    }

    .confetti-42 {
      width: 2px;
      height: 0.8px;
      background-color: #263672;
      top: -10%;
      left: 20%;
      opacity: 1.2893647297;
      transform: rotate(76.7183497991deg);
      -webkit-animation: drop-42 4.5952910655s 0.7842752217s infinite;
      animation: drop-42 4.5952910655s 0.7842752217s infinite;
    }

    @-webkit-keyframes drop-42 {
      100% {
        top: 110%;
        left: 23%;
      }
    }

    @keyframes drop-42 {
      100% {
        top: 110%;
        left: 23%;
      }
    }

    .confetti-43 {
      width: 5px;
      height: 2px;
      background-color: #263672;
      top: -10%;
      left: 3%;
      opacity: 0.9317455291;
      transform: rotate(285.9293751307deg);
      -webkit-animation: drop-43 4.0295183223s 0.3195036189s infinite;
      animation: drop-43 4.0295183223s 0.3195036189s infinite;
    }

    @-webkit-keyframes drop-43 {
      100% {
        top: 110%;
        left: 4%;
      }
    }

    @keyframes drop-43 {
      100% {
        top: 110%;
        left: 4%;
      }
    }

    .confetti-44 {
      width: 2px;
      height: 0.8px;
      background-color: #ffbf00;
      top: -10%;
      left: 52%;
      opacity: 0.823158731;
      transform: rotate(322.3391307434deg);
      -webkit-animation: drop-44 4.900854983s 0.5660724134s infinite;
      animation: drop-44 4.900854983s 0.5660724134s infinite;
    }

    @-webkit-keyframes drop-44 {
      100% {
        top: 110%;
        left: 66%;
      }
    }

    @keyframes drop-44 {
      100% {
        top: 110%;
        left: 66%;
      }
    }

    .confetti-45 {
      width: 2px;
      height: 0.8px;
      background-color: #263672;
      top: -10%;
      left: 54%;
      opacity: 1.2398144685;
      transform: rotate(173.5450355694deg);
      -webkit-animation: drop-45 4.7141936351s 0.8182058468s infinite;
      animation: drop-45 4.7141936351s 0.8182058468s infinite;
    }

    @-webkit-keyframes drop-45 {
      100% {
        top: 110%;
        left: 55%;
      }
    }

    @keyframes drop-45 {
      100% {
        top: 110%;
        left: 55%;
      }
    }

    .confetti-46 {
      width: 8px;
      height: 3.2px;
      background-color: #d13447;
      top: -10%;
      left: 11%;
      opacity: 1.1224010991;
      transform: rotate(104.9569807935deg);
      -webkit-animation: drop-46 4.8045778387s 0.1872865747s infinite;
      animation: drop-46 4.8045778387s 0.1872865747s infinite;
    }

    @-webkit-keyframes drop-46 {
      100% {
        top: 110%;
        left: 24%;
      }
    }

    @keyframes drop-46 {
      100% {
        top: 110%;
        left: 24%;
      }
    }

    .confetti-47 {
      width: 7px;
      height: 2.8px;
      background-color: #ffbf00;
      top: -10%;
      left: 78%;
      opacity: 1.2174600696;
      transform: rotate(158.6166856215deg);
      -webkit-animation: drop-47 4.1254681235s 0.434546262s infinite;
      animation: drop-47 4.1254681235s 0.434546262s infinite;
    }

    @-webkit-keyframes drop-47 {
      100% {
        top: 110%;
        left: 84%;
      }
    }

    @keyframes drop-47 {
      100% {
        top: 110%;
        left: 84%;
      }
    }

    .confetti-48 {
      width: 7px;
      height: 2.8px;
      background-color: #d13447;
      top: -10%;
      left: 60%;
      opacity: 0.5159973522;
      transform: rotate(140.8051269301deg);
      -webkit-animation: drop-48 4.9254992664s 0.5275453402s infinite;
      animation: drop-48 4.9254992664s 0.5275453402s infinite;
    }

    @-webkit-keyframes drop-48 {
      100% {
        top: 110%;
        left: 64%;
      }
    }

    @keyframes drop-48 {
      100% {
        top: 110%;
        left: 64%;
      }
    }

    .confetti-49 {
      width: 7px;
      height: 2.8px;
      background-color: #263672;
      top: -10%;
      left: 59%;
      opacity: 0.8893644377;
      transform: rotate(266.0322257781deg);
      -webkit-animation: drop-49 4.6442112301s 0.2713427975s infinite;
      animation: drop-49 4.6442112301s 0.2713427975s infinite;
    }

    @-webkit-keyframes drop-49 {
      100% {
        top: 110%;
        left: 64%;
      }
    }

    @keyframes drop-49 {
      100% {
        top: 110%;
        left: 64%;
      }
    }

    .confetti-50 {
      width: 4px;
      height: 1.6px;
      background-color: #d13447;
      top: -10%;
      left: 34%;
      opacity: 0.922170408;
      transform: rotate(221.1610098978deg);
      -webkit-animation: drop-50 4.3933598534s 0.3051647804s infinite;
      animation: drop-50 4.3933598534s 0.3051647804s infinite;
    }

    @-webkit-keyframes drop-50 {
      100% {
        top: 110%;
        left: 46%;
      }
    }

    @keyframes drop-50 {
      100% {
        top: 110%;
        left: 46%;
      }
    }

    .confetti-51 {
      width: 1px;
      height: 0.4px;
      background-color: #263672;
      top: -10%;
      left: 34%;
      opacity: 0.9925371047;
      transform: rotate(259.4667798424deg);
      -webkit-animation: drop-51 4.0295908158s 0.113614873s infinite;
      animation: drop-51 4.0295908158s 0.113614873s infinite;
    }

    @-webkit-keyframes drop-51 {
      100% {
        top: 110%;
        left: 37%;
      }
    }

    @keyframes drop-51 {
      100% {
        top: 110%;
        left: 37%;
      }
    }

    .confetti-52 {
      width: 1px;
      height: 0.4px;
      background-color: #ffbf00;
      top: -10%;
      left: 32%;
      opacity: 0.7709090795;
      transform: rotate(98.5114631736deg);
      -webkit-animation: drop-52 4.8227212214s 0.1124919096s infinite;
      animation: drop-52 4.8227212214s 0.1124919096s infinite;
    }

    @-webkit-keyframes drop-52 {
      100% {
        top: 110%;
        left: 43%;
      }
    }

    @keyframes drop-52 {
      100% {
        top: 110%;
        left: 43%;
      }
    }

    .confetti-53 {
      width: 1px;
      height: 0.4px;
      background-color: #d13447;
      top: -10%;
      left: 91%;
      opacity: 1.025289228;
      transform: rotate(21.2521782582deg);
      -webkit-animation: drop-53 4.8159580648s 0.6313601129s infinite;
      animation: drop-53 4.8159580648s 0.6313601129s infinite;
    }

    @-webkit-keyframes drop-53 {
      100% {
        top: 110%;
        left: 98%;
      }
    }

    @keyframes drop-53 {
      100% {
        top: 110%;
        left: 98%;
      }
    }

    .confetti-54 {
      width: 7px;
      height: 2.8px;
      background-color: #263672;
      top: -10%;
      left: 44%;
      opacity: 1.0501280671;
      transform: rotate(292.2071282341deg);
      -webkit-animation: drop-54 4.0026660281s 0.6730089649s infinite;
      animation: drop-54 4.0026660281s 0.6730089649s infinite;
    }

    @-webkit-keyframes drop-54 {
      100% {
        top: 110%;
        left: 51%;
      }
    }

    @keyframes drop-54 {
      100% {
        top: 110%;
        left: 51%;
      }
    }

    .confetti-55 {
      width: 2px;
      height: 0.8px;
      background-color: #ffbf00;
      top: -10%;
      left: 3%;
      opacity: 1.0941629358;
      transform: rotate(225.9704174821deg);
      -webkit-animation: drop-55 4.1368576417s 0.2836692087s infinite;
      animation: drop-55 4.1368576417s 0.2836692087s infinite;
    }

    @-webkit-keyframes drop-55 {
      100% {
        top: 110%;
        left: 5%;
      }
    }

    @keyframes drop-55 {
      100% {
        top: 110%;
        left: 5%;
      }
    }

    .confetti-56 {
      width: 7px;
      height: 2.8px;
      background-color: #d13447;
      top: -10%;
      left: 6%;
      opacity: 1.2278384148;
      transform: rotate(136.6739389958deg);
      -webkit-animation: drop-56 4.8255624809s 0.7526709376s infinite;
      animation: drop-56 4.8255624809s 0.7526709376s infinite;
    }

    @-webkit-keyframes drop-56 {
      100% {
        top: 110%;
        left: 20%;
      }
    }

    @keyframes drop-56 {
      100% {
        top: 110%;
        left: 20%;
      }
    }

    .confetti-57 {
      width: 7px;
      height: 2.8px;
      background-color: #ffbf00;
      top: -10%;
      left: 22%;
      opacity: 0.6017614119;
      transform: rotate(198.9658804763deg);
      -webkit-animation: drop-57 4.5425979037s 0.7456413179s infinite;
      animation: drop-57 4.5425979037s 0.7456413179s infinite;
    }

    @-webkit-keyframes drop-57 {
      100% {
        top: 110%;
        left: 32%;
      }
    }

    @keyframes drop-57 {
      100% {
        top: 110%;
        left: 32%;
      }
    }

    .confetti-58 {
      width: 6px;
      height: 2.4px;
      background-color: #263672;
      top: -10%;
      left: 68%;
      opacity: 0.9028020906;
      transform: rotate(3.0022204702deg);
      -webkit-animation: drop-58 4.1183770278s 0.3762038332s infinite;
      animation: drop-58 4.1183770278s 0.3762038332s infinite;
    }

    @-webkit-keyframes drop-58 {
      100% {
        top: 110%;
        left: 78%;
      }
    }

    @keyframes drop-58 {
      100% {
        top: 110%;
        left: 78%;
      }
    }

    .confetti-59 {
      width: 6px;
      height: 2.4px;
      background-color: #263672;
      top: -10%;
      left: 43%;
      opacity: 0.7806629715;
      transform: rotate(292.5156768843deg);
      -webkit-animation: drop-59 4.0499764211s 0.4611457189s infinite;
      animation: drop-59 4.0499764211s 0.4611457189s infinite;
    }

    @-webkit-keyframes drop-59 {
      100% {
        top: 110%;
        left: 56%;
      }
    }

    @keyframes drop-59 {
      100% {
        top: 110%;
        left: 56%;
      }
    }

    .confetti-60 {
      width: 1px;
      height: 0.4px;
      background-color: #263672;
      top: -10%;
      left: 17%;
      opacity: 1.3946342337;
      transform: rotate(94.741460455deg);
      -webkit-animation: drop-60 4.2462704896s 0.4890546805s infinite;
      animation: drop-60 4.2462704896s 0.4890546805s infinite;
    }

    @-webkit-keyframes drop-60 {
      100% {
        top: 110%;
        left: 21%;
      }
    }

    @keyframes drop-60 {
      100% {
        top: 110%;
        left: 21%;
      }
    }

    .confetti-61 {
      width: 7px;
      height: 2.8px;
      background-color: #d13447;
      top: -10%;
      left: 36%;
      opacity: 0.9316097141;
      transform: rotate(46.4651082318deg);
      -webkit-animation: drop-61 4.490918064s 0.740001426s infinite;
      animation: drop-61 4.490918064s 0.740001426s infinite;
    }

    @-webkit-keyframes drop-61 {
      100% {
        top: 110%;
        left: 48%;
      }
    }

    @keyframes drop-61 {
      100% {
        top: 110%;
        left: 48%;
      }
    }

    .confetti-62 {
      width: 2px;
      height: 0.8px;
      background-color: #263672;
      top: -10%;
      left: 49%;
      opacity: 0.6454846642;
      transform: rotate(272.5921395184deg);
      -webkit-animation: drop-62 4.8991084112s 0.677023237s infinite;
      animation: drop-62 4.8991084112s 0.677023237s infinite;
    }

    @-webkit-keyframes drop-62 {
      100% {
        top: 110%;
        left: 51%;
      }
    }

    @keyframes drop-62 {
      100% {
        top: 110%;
        left: 51%;
      }
    }

    .confetti-63 {
      width: 8px;
      height: 3.2px;
      background-color: #263672;
      top: -10%;
      left: 31%;
      opacity: 0.7116808046;
      transform: rotate(103.2593691561deg);
      -webkit-animation: drop-63 4.2042762391s 0.064741901s infinite;
      animation: drop-63 4.2042762391s 0.064741901s infinite;
    }

    @-webkit-keyframes drop-63 {
      100% {
        top: 110%;
        left: 46%;
      }
    }

    @keyframes drop-63 {
      100% {
        top: 110%;
        left: 46%;
      }
    }

    .confetti-64 {
      width: 5px;
      height: 2px;
      background-color: #d13447;
      top: -10%;
      left: 55%;
      opacity: 0.7667542155;
      transform: rotate(314.7812050522deg);
      -webkit-animation: drop-64 4.8141695615s 0.8140669911s infinite;
      animation: drop-64 4.8141695615s 0.8140669911s infinite;
    }

    @-webkit-keyframes drop-64 {
      100% {
        top: 110%;
        left: 70%;
      }
    }

    @keyframes drop-64 {
      100% {
        top: 110%;
        left: 70%;
      }
    }

    .confetti-65 {
      width: 1px;
      height: 0.4px;
      background-color: #ffbf00;
      top: -10%;
      left: 46%;
      opacity: 0.9264177032;
      transform: rotate(303.9262856736deg);
      -webkit-animation: drop-65 4.9152874199s 0.31483023s infinite;
      animation: drop-65 4.9152874199s 0.31483023s infinite;
    }

    @-webkit-keyframes drop-65 {
      100% {
        top: 110%;
        left: 54%;
      }
    }

    @keyframes drop-65 {
      100% {
        top: 110%;
        left: 54%;
      }
    }

    .confetti-66 {
      width: 1px;
      height: 0.4px;
      background-color: #ffbf00;
      top: -10%;
      left: 37%;
      opacity: 0.8351891866;
      transform: rotate(251.0096710928deg);
      -webkit-animation: drop-66 4.0279739949s 0.9265833313s infinite;
      animation: drop-66 4.0279739949s 0.9265833313s infinite;
    }

    @-webkit-keyframes drop-66 {
      100% {
        top: 110%;
        left: 38%;
      }
    }

    @keyframes drop-66 {
      100% {
        top: 110%;
        left: 38%;
      }
    }

    .confetti-67 {
      width: 6px;
      height: 2.4px;
      background-color: #d13447;
      top: -10%;
      left: 21%;
      opacity: 0.5156914742;
      transform: rotate(322.1374519846deg);
      -webkit-animation: drop-67 4.8114023426s 0.6301524099s infinite;
      animation: drop-67 4.8114023426s 0.6301524099s infinite;
    }

    @-webkit-keyframes drop-67 {
      100% {
        top: 110%;
        left: 34%;
      }
    }

    @keyframes drop-67 {
      100% {
        top: 110%;
        left: 34%;
      }
    }

    .confetti-68 {
      width: 8px;
      height: 3.2px;
      background-color: #263672;
      top: -10%;
      left: 49%;
      opacity: 0.7911254757;
      transform: rotate(353.9398166969deg);
      -webkit-animation: drop-68 4.3120928997s 0.1047604897s infinite;
      animation: drop-68 4.3120928997s 0.1047604897s infinite;
    }

    @-webkit-keyframes drop-68 {
      100% {
        top: 110%;
        left: 50%;
      }
    }

    @keyframes drop-68 {
      100% {
        top: 110%;
        left: 50%;
      }
    }

    .confetti-69 {
      width: 8px;
      height: 3.2px;
      background-color: #ffbf00;
      top: -10%;
      left: 84%;
      opacity: 1.3692787557;
      transform: rotate(280.0474128292deg);
      -webkit-animation: drop-69 4.5806379975s 0.7985658854s infinite;
      animation: drop-69 4.5806379975s 0.7985658854s infinite;
    }

    @-webkit-keyframes drop-69 {
      100% {
        top: 110%;
        left: 93%;
      }
    }

    @keyframes drop-69 {
      100% {
        top: 110%;
        left: 93%;
      }
    }

    .confetti-70 {
      width: 4px;
      height: 1.6px;
      background-color: #d13447;
      top: -10%;
      left: 89%;
      opacity: 0.818329191;
      transform: rotate(43.155169887deg);
      -webkit-animation: drop-70 4.5439620933s 0.4108026013s infinite;
      animation: drop-70 4.5439620933s 0.4108026013s infinite;
    }

    @-webkit-keyframes drop-70 {
      100% {
        top: 110%;
        left: 100%;
      }
    }

    @keyframes drop-70 {
      100% {
        top: 110%;
        left: 100%;
      }
    }

    .confetti-71 {
      width: 4px;
      height: 1.6px;
      background-color: #d13447;
      top: -10%;
      left: 75%;
      opacity: 0.957250776;
      transform: rotate(194.0629182371deg);
      -webkit-animation: drop-71 4.4525490463s 0.1161111465s infinite;
      animation: drop-71 4.4525490463s 0.1161111465s infinite;
    }

    @-webkit-keyframes drop-71 {
      100% {
        top: 110%;
        left: 90%;
      }
    }

    @keyframes drop-71 {
      100% {
        top: 110%;
        left: 90%;
      }
    }

    .confetti-72 {
      width: 6px;
      height: 2.4px;
      background-color: #263672;
      top: -10%;
      left: 72%;
      opacity: 1.0046137641;
      transform: rotate(69.4430369429deg);
      -webkit-animation: drop-72 4.0748285816s 0.9151382186s infinite;
      animation: drop-72 4.0748285816s 0.9151382186s infinite;
    }

    @-webkit-keyframes drop-72 {
      100% {
        top: 110%;
        left: 87%;
      }
    }

    @keyframes drop-72 {
      100% {
        top: 110%;
        left: 87%;
      }
    }

    .confetti-73 {
      width: 6px;
      height: 2.4px;
      background-color: #263672;
      top: -10%;
      left: 59%;
      opacity: 0.8706866565;
      transform: rotate(132.7153918161deg);
      -webkit-animation: drop-73 4.6125868095s 0.8945031344s infinite;
      animation: drop-73 4.6125868095s 0.8945031344s infinite;
    }

    @-webkit-keyframes drop-73 {
      100% {
        top: 110%;
        left: 67%;
      }
    }

    @keyframes drop-73 {
      100% {
        top: 110%;
        left: 67%;
      }
    }

    .confetti-74 {
      width: 2px;
      height: 0.8px;
      background-color: #d13447;
      top: -10%;
      left: 64%;
      opacity: 0.551854454;
      transform: rotate(237.8063109193deg);
      -webkit-animation: drop-74 4.2157917709s 0.8098043582s infinite;
      animation: drop-74 4.2157917709s 0.8098043582s infinite;
    }

    @-webkit-keyframes drop-74 {
      100% {
        top: 110%;
        left: 77%;
      }
    }

    @keyframes drop-74 {
      100% {
        top: 110%;
        left: 77%;
      }
    }

    .confetti-75 {
      width: 7px;
      height: 2.8px;
      background-color: #ffbf00;
      top: -10%;
      left: 16%;
      opacity: 0.6645737425;
      transform: rotate(148.3340886363deg);
      -webkit-animation: drop-75 4.8716747297s 0.4399189683s infinite;
      animation: drop-75 4.8716747297s 0.4399189683s infinite;
    }

    @-webkit-keyframes drop-75 {
      100% {
        top: 110%;
        left: 28%;
      }
    }

    @keyframes drop-75 {
      100% {
        top: 110%;
        left: 28%;
      }
    }

    .confetti-76 {
      width: 3px;
      height: 1.2px;
      background-color: #263672;
      top: -10%;
      left: 70%;
      opacity: 1.491291018;
      transform: rotate(177.7379919447deg);
      -webkit-animation: drop-76 4.9996258599s 0.9203039902s infinite;
      animation: drop-76 4.9996258599s 0.9203039902s infinite;
    }

    @-webkit-keyframes drop-76 {
      100% {
        top: 110%;
        left: 81%;
      }
    }

    @keyframes drop-76 {
      100% {
        top: 110%;
        left: 81%;
      }
    }

    .confetti-77 {
      width: 3px;
      height: 1.2px;
      background-color: #d13447;
      top: -10%;
      left: 100%;
      opacity: 0.8949196876;
      transform: rotate(331.202112381deg);
      -webkit-animation: drop-77 4.1515019724s 0.3335313314s infinite;
      animation: drop-77 4.1515019724s 0.3335313314s infinite;
    }

    @-webkit-keyframes drop-77 {
      100% {
        top: 110%;
        left: 105%;
      }
    }

    @keyframes drop-77 {
      100% {
        top: 110%;
        left: 105%;
      }
    }

    .confetti-78 {
      width: 8px;
      height: 3.2px;
      background-color: #ffbf00;
      top: -10%;
      left: 65%;
      opacity: 1.0401394678;
      transform: rotate(218.5835335969deg);
      -webkit-animation: drop-78 4.4540522569s 0.2799961162s infinite;
      animation: drop-78 4.4540522569s 0.2799961162s infinite;
    }

    @-webkit-keyframes drop-78 {
      100% {
        top: 110%;
        left: 67%;
      }
    }

    @keyframes drop-78 {
      100% {
        top: 110%;
        left: 67%;
      }
    }

    .confetti-79 {
      width: 5px;
      height: 2px;
      background-color: #ffbf00;
      top: -10%;
      left: 74%;
      opacity: 0.8939009053;
      transform: rotate(76.4681585313deg);
      -webkit-animation: drop-79 4.3687198222s 0.8051297246s infinite;
      animation: drop-79 4.3687198222s 0.8051297246s infinite;
    }

    @-webkit-keyframes drop-79 {
      100% {
        top: 110%;
        left: 83%;
      }
    }

    @keyframes drop-79 {
      100% {
        top: 110%;
        left: 83%;
      }
    }

    .confetti-80 {
      width: 2px;
      height: 0.8px;
      background-color: #263672;
      top: -10%;
      left: 77%;
      opacity: 1.2242073573;
      transform: rotate(133.8222467836deg);
      -webkit-animation: drop-80 4.0188217026s 0.7903261863s infinite;
      animation: drop-80 4.0188217026s 0.7903261863s infinite;
    }

    @-webkit-keyframes drop-80 {
      100% {
        top: 110%;
        left: 91%;
      }
    }

    @keyframes drop-80 {
      100% {
        top: 110%;
        left: 91%;
      }
    }

    .confetti-81 {
      width: 5px;
      height: 2px;
      background-color: #263672;
      top: -10%;
      left: 56%;
      opacity: 1.1484595825;
      transform: rotate(321.3992333958deg);
      -webkit-animation: drop-81 4.5408975822s 0.577184795s infinite;
      animation: drop-81 4.5408975822s 0.577184795s infinite;
    }

    @-webkit-keyframes drop-81 {
      100% {
        top: 110%;
        left: 69%;
      }
    }

    @keyframes drop-81 {
      100% {
        top: 110%;
        left: 69%;
      }
    }

    .confetti-82 {
      width: 1px;
      height: 0.4px;
      background-color: #ffbf00;
      top: -10%;
      left: 34%;
      opacity: 1.023082315;
      transform: rotate(149.1296537477deg);
      -webkit-animation: drop-82 4.8947568833s 0.252231933s infinite;
      animation: drop-82 4.8947568833s 0.252231933s infinite;
    }

    @-webkit-keyframes drop-82 {
      100% {
        top: 110%;
        left: 40%;
      }
    }

    @keyframes drop-82 {
      100% {
        top: 110%;
        left: 40%;
      }
    }

    .confetti-83 {
      width: 1px;
      height: 0.4px;
      background-color: #ffbf00;
      top: -10%;
      left: 80%;
      opacity: 0.8286575884;
      transform: rotate(266.463745873deg);
      -webkit-animation: drop-83 4.3214280284s 0.3598607421s infinite;
      animation: drop-83 4.3214280284s 0.3598607421s infinite;
    }

    @-webkit-keyframes drop-83 {
      100% {
        top: 110%;
        left: 93%;
      }
    }

    @keyframes drop-83 {
      100% {
        top: 110%;
        left: 93%;
      }
    }

    .confetti-84 {
      width: 1px;
      height: 0.4px;
      background-color: #d13447;
      top: -10%;
      left: 10%;
      opacity: 0.5730928856;
      transform: rotate(91.5892445942deg);
      -webkit-animation: drop-84 4.0589367582s 0.0776588162s infinite;
      animation: drop-84 4.0589367582s 0.0776588162s infinite;
    }

    @-webkit-keyframes drop-84 {
      100% {
        top: 110%;
        left: 12%;
      }
    }

    @keyframes drop-84 {
      100% {
        top: 110%;
        left: 12%;
      }
    }

    .confetti-85 {
      width: 8px;
      height: 3.2px;
      background-color: #d13447;
      top: -10%;
      left: 97%;
      opacity: 1.0223789105;
      transform: rotate(93.2542204128deg);
      -webkit-animation: drop-85 4.2174302266s 0.2806139226s infinite;
      animation: drop-85 4.2174302266s 0.2806139226s infinite;
    }

    @-webkit-keyframes drop-85 {
      100% {
        top: 110%;
        left: 107%;
      }
    }

    @keyframes drop-85 {
      100% {
        top: 110%;
        left: 107%;
      }
    }

    .confetti-86 {
      width: 7px;
      height: 2.8px;
      background-color: #ffbf00;
      top: -10%;
      left: 38%;
      opacity: 0.9958681353;
      transform: rotate(357.53396122deg);
      -webkit-animation: drop-86 4.2036760696s 0.1635998357s infinite;
      animation: drop-86 4.2036760696s 0.1635998357s infinite;
    }

    @-webkit-keyframes drop-86 {
      100% {
        top: 110%;
        left: 40%;
      }
    }

    @keyframes drop-86 {
      100% {
        top: 110%;
        left: 40%;
      }
    }

    .confetti-87 {
      width: 2px;
      height: 0.8px;
      background-color: #263672;
      top: -10%;
      left: 59%;
      opacity: 0.9812066813;
      transform: rotate(223.3780188754deg);
      -webkit-animation: drop-87 4.0275138481s 0.6518086489s infinite;
      animation: drop-87 4.0275138481s 0.6518086489s infinite;
    }

    @-webkit-keyframes drop-87 {
      100% {
        top: 110%;
        left: 72%;
      }
    }

    @keyframes drop-87 {
      100% {
        top: 110%;
        left: 72%;
      }
    }

    .confetti-88 {
      width: 7px;
      height: 2.8px;
      background-color: #d13447;
      top: -10%;
      left: 83%;
      opacity: 0.8752978952;
      transform: rotate(107.7258135897deg);
      -webkit-animation: drop-88 4.7574909839s 0.42172395s infinite;
      animation: drop-88 4.7574909839s 0.42172395s infinite;
    }

    @-webkit-keyframes drop-88 {
      100% {
        top: 110%;
        left: 95%;
      }
    }

    @keyframes drop-88 {
      100% {
        top: 110%;
        left: 95%;
      }
    }

    .confetti-89 {
      width: 2px;
      height: 0.8px;
      background-color: #263672;
      top: -10%;
      left: 5%;
      opacity: 0.5227901092;
      transform: rotate(71.5813316095deg);
      -webkit-animation: drop-89 4.9201251104s 0.5717722528s infinite;
      animation: drop-89 4.9201251104s 0.5717722528s infinite;
    }

    @-webkit-keyframes drop-89 {
      100% {
        top: 110%;
        left: 20%;
      }
    }

    @keyframes drop-89 {
      100% {
        top: 110%;
        left: 20%;
      }
    }

    .confetti-90 {
      width: 8px;
      height: 3.2px;
      background-color: #263672;
      top: -10%;
      left: 64%;
      opacity: 0.7338339342;
      transform: rotate(100.2613067877deg);
      -webkit-animation: drop-90 4.2751131332s 0.9277921825s infinite;
      animation: drop-90 4.2751131332s 0.9277921825s infinite;
    }

    @-webkit-keyframes drop-90 {
      100% {
        top: 110%;
        left: 75%;
      }
    }

    @keyframes drop-90 {
      100% {
        top: 110%;
        left: 75%;
      }
    }

    .confetti-91 {
      width: 3px;
      height: 1.2px;
      background-color: #ffbf00;
      top: -10%;
      left: 39%;
      opacity: 0.836037407;
      transform: rotate(69.433846558deg);
      -webkit-animation: drop-91 4.4756456756s 0.3367650651s infinite;
      animation: drop-91 4.4756456756s 0.3367650651s infinite;
    }

    @-webkit-keyframes drop-91 {
      100% {
        top: 110%;
        left: 40%;
      }
    }

    @keyframes drop-91 {
      100% {
        top: 110%;
        left: 40%;
      }
    }

    .confetti-92 {
      width: 6px;
      height: 2.4px;
      background-color: #263672;
      top: -10%;
      left: 63%;
      opacity: 0.7712242104;
      transform: rotate(83.3077259154deg);
      -webkit-animation: drop-92 4.8382353376s 0.9945584625s infinite;
      animation: drop-92 4.8382353376s 0.9945584625s infinite;
    }

    @-webkit-keyframes drop-92 {
      100% {
        top: 110%;
        left: 65%;
      }
    }

    @keyframes drop-92 {
      100% {
        top: 110%;
        left: 65%;
      }
    }

    .confetti-93 {
      width: 1px;
      height: 0.4px;
      background-color: #d13447;
      top: -10%;
      left: 97%;
      opacity: 0.9795323598;
      transform: rotate(129.3090459338deg);
      -webkit-animation: drop-93 4.6466357134s 0.3170054775s infinite;
      animation: drop-93 4.6466357134s 0.3170054775s infinite;
    }

    @-webkit-keyframes drop-93 {
      100% {
        top: 110%;
        left: 107%;
      }
    }

    @keyframes drop-93 {
      100% {
        top: 110%;
        left: 107%;
      }
    }

    .confetti-94 {
      width: 3px;
      height: 1.2px;
      background-color: #d13447;
      top: -10%;
      left: 23%;
      opacity: 0.6148170873;
      transform: rotate(91.6810938205deg);
      -webkit-animation: drop-94 4.1545060258s 0.5810072357s infinite;
      animation: drop-94 4.1545060258s 0.5810072357s infinite;
    }

    @-webkit-keyframes drop-94 {
      100% {
        top: 110%;
        left: 36%;
      }
    }

    @keyframes drop-94 {
      100% {
        top: 110%;
        left: 36%;
      }
    }

    .confetti-95 {
      width: 4px;
      height: 1.6px;
      background-color: #263672;
      top: -10%;
      left: 42%;
      opacity: 0.9237204471;
      transform: rotate(156.825275473deg);
      -webkit-animation: drop-95 4.3638349021s 0.9607518647s infinite;
      animation: drop-95 4.3638349021s 0.9607518647s infinite;
    }

    @-webkit-keyframes drop-95 {
      100% {
        top: 110%;
        left: 56%;
      }
    }

    @keyframes drop-95 {
      100% {
        top: 110%;
        left: 56%;
      }
    }

    .confetti-96 {
      width: 3px;
      height: 1.2px;
      background-color: #ffbf00;
      top: -10%;
      left: 49%;
      opacity: 0.9675973367;
      transform: rotate(205.9253868426deg);
      -webkit-animation: drop-96 4.8130333675s 0.2056807833s infinite;
      animation: drop-96 4.8130333675s 0.2056807833s infinite;
    }

    @-webkit-keyframes drop-96 {
      100% {
        top: 110%;
        left: 50%;
      }
    }

    @keyframes drop-96 {
      100% {
        top: 110%;
        left: 50%;
      }
    }

    .confetti-97 {
      width: 2px;
      height: 0.8px;
      background-color: #ffbf00;
      top: -10%;
      left: 85%;
      opacity: 0.6656562761;
      transform: rotate(6.9562898674deg);
      -webkit-animation: drop-97 4.4770249522s 0.6067386743s infinite;
      animation: drop-97 4.4770249522s 0.6067386743s infinite;
    }

    @-webkit-keyframes drop-97 {
      100% {
        top: 110%;
        left: 96%;
      }
    }

    @keyframes drop-97 {
      100% {
        top: 110%;
        left: 96%;
      }
    }

    .confetti-98 {
      width: 3px;
      height: 1.2px;
      background-color: #263672;
      top: -10%;
      left: 100%;
      opacity: 1.1905263523;
      transform: rotate(198.1355423337deg);
      -webkit-animation: drop-98 4.6244500447s 0.0773135428s infinite;
      animation: drop-98 4.6244500447s 0.0773135428s infinite;
    }

    @-webkit-keyframes drop-98 {
      100% {
        top: 110%;
        left: 106%;
      }
    }

    @keyframes drop-98 {
      100% {
        top: 110%;
        left: 106%;
      }
    }

    .confetti-99 {
      width: 3px;
      height: 1.2px;
      background-color: #ffbf00;
      top: -10%;
      left: 88%;
      opacity: 1.410751072;
      transform: rotate(343.409517644deg);
      -webkit-animation: drop-99 4.2200191195s 0.7822562475s infinite;
      animation: drop-99 4.2200191195s 0.7822562475s infinite;
    }

    @-webkit-keyframes drop-99 {
      100% {
        top: 110%;
        left: 91%;
      }
    }

    @keyframes drop-99 {
      100% {
        top: 110%;
        left: 91%;
      }
    }

    .confetti-100 {
      width: 8px;
      height: 3.2px;
      background-color: #263672;
      top: -10%;
      left: 19%;
      opacity: 1.4608000045;
      transform: rotate(255.0362602734deg);
      -webkit-animation: drop-100 4.826712796s 0.6925951055s infinite;
      animation: drop-100 4.826712796s 0.6925951055s infinite;
    }

    @-webkit-keyframes drop-100 {
      100% {
        top: 110%;
        left: 28%;
      }
    }

    @keyframes drop-100 {
      100% {
        top: 110%;
        left: 28%;
      }
    }

    .confetti-101 {
      width: 7px;
      height: 2.8px;
      background-color: #d13447;
      top: -10%;
      left: 65%;
      opacity: 0.6115064534;
      transform: rotate(35.3997946653deg);
      -webkit-animation: drop-101 4.7930598029s 0.7252476539s infinite;
      animation: drop-101 4.7930598029s 0.7252476539s infinite;
    }

    @-webkit-keyframes drop-101 {
      100% {
        top: 110%;
        left: 76%;
      }
    }

    @keyframes drop-101 {
      100% {
        top: 110%;
        left: 76%;
      }
    }

    .confetti-102 {
      width: 4px;
      height: 1.6px;
      background-color: #d13447;
      top: -10%;
      left: 19%;
      opacity: 1.1444514207;
      transform: rotate(59.1909347289deg);
      -webkit-animation: drop-102 4.1768865155s 0.6552143846s infinite;
      animation: drop-102 4.1768865155s 0.6552143846s infinite;
    }

    @-webkit-keyframes drop-102 {
      100% {
        top: 110%;
        left: 20%;
      }
    }

    @keyframes drop-102 {
      100% {
        top: 110%;
        left: 20%;
      }
    }

    .confetti-103 {
      width: 2px;
      height: 0.8px;
      background-color: #d13447;
      top: -10%;
      left: 25%;
      opacity: 0.9198022536;
      transform: rotate(327.3597769632deg);
      -webkit-animation: drop-103 4.4755127402s 0.6432303441s infinite;
      animation: drop-103 4.4755127402s 0.6432303441s infinite;
    }

    @-webkit-keyframes drop-103 {
      100% {
        top: 110%;
        left: 32%;
      }
    }

    @keyframes drop-103 {
      100% {
        top: 110%;
        left: 32%;
      }
    }

    .confetti-104 {
      width: 2px;
      height: 0.8px;
      background-color: #263672;
      top: -10%;
      left: 55%;
      opacity: 0.7714323488;
      transform: rotate(153.6674272335deg);
      -webkit-animation: drop-104 4.6820758016s 0.9287923789s infinite;
      animation: drop-104 4.6820758016s 0.9287923789s infinite;
    }

    @-webkit-keyframes drop-104 {
      100% {
        top: 110%;
        left: 67%;
      }
    }

    @keyframes drop-104 {
      100% {
        top: 110%;
        left: 67%;
      }
    }

    .confetti-105 {
      width: 8px;
      height: 3.2px;
      background-color: #ffbf00;
      top: -10%;
      left: 1%;
      opacity: 0.6581432096;
      transform: rotate(127.9136897769deg);
      -webkit-animation: drop-105 4.6770607083s 0.3560020535s infinite;
      animation: drop-105 4.6770607083s 0.3560020535s infinite;
    }

    @-webkit-keyframes drop-105 {
      100% {
        top: 110%;
        left: 11%;
      }
    }

    @keyframes drop-105 {
      100% {
        top: 110%;
        left: 11%;
      }
    }

    .confetti-106 {
      width: 8px;
      height: 3.2px;
      background-color: #d13447;
      top: -10%;
      left: 20%;
      opacity: 1.4431336164;
      transform: rotate(51.124174541deg);
      -webkit-animation: drop-106 4.9702939006s 0.5215118349s infinite;
      animation: drop-106 4.9702939006s 0.5215118349s infinite;
    }

    @-webkit-keyframes drop-106 {
      100% {
        top: 110%;
        left: 32%;
      }
    }

    @keyframes drop-106 {
      100% {
        top: 110%;
        left: 32%;
      }
    }

    .confetti-107 {
      width: 8px;
      height: 3.2px;
      background-color: #d13447;
      top: -10%;
      left: 82%;
      opacity: 0.6833273843;
      transform: rotate(136.3191940366deg);
      -webkit-animation: drop-107 4.9490097449s 0.7717708757s infinite;
      animation: drop-107 4.9490097449s 0.7717708757s infinite;
    }

    @-webkit-keyframes drop-107 {
      100% {
        top: 110%;
        left: 88%;
      }
    }

    @keyframes drop-107 {
      100% {
        top: 110%;
        left: 88%;
      }
    }

    .confetti-108 {
      width: 6px;
      height: 2.4px;
      background-color: #263672;
      top: -10%;
      left: 8%;
      opacity: 0.7342732858;
      transform: rotate(265.8819370516deg);
      -webkit-animation: drop-108 4.9603959859s 0.9631231717s infinite;
      animation: drop-108 4.9603959859s 0.9631231717s infinite;
    }

    @-webkit-keyframes drop-108 {
      100% {
        top: 110%;
        left: 23%;
      }
    }

    @keyframes drop-108 {
      100% {
        top: 110%;
        left: 23%;
      }
    }

    .confetti-109 {
      width: 5px;
      height: 2px;
      background-color: #ffbf00;
      top: -10%;
      left: 37%;
      opacity: 0.8102361999;
      transform: rotate(338.2372760444deg);
      -webkit-animation: drop-109 4.1077420285s 0.1219100897s infinite;
      animation: drop-109 4.1077420285s 0.1219100897s infinite;
    }

    @-webkit-keyframes drop-109 {
      100% {
        top: 110%;
        left: 45%;
      }
    }

    @keyframes drop-109 {
      100% {
        top: 110%;
        left: 45%;
      }
    }

    .confetti-110 {
      width: 5px;
      height: 2px;
      background-color: #d13447;
      top: -10%;
      left: 50%;
      opacity: 0.5707246213;
      transform: rotate(38.9362920376deg);
      -webkit-animation: drop-110 4.9717684916s 0.6654969795s infinite;
      animation: drop-110 4.9717684916s 0.6654969795s infinite;
    }

    @-webkit-keyframes drop-110 {
      100% {
        top: 110%;
        left: 57%;
      }
    }

    @keyframes drop-110 {
      100% {
        top: 110%;
        left: 57%;
      }
    }

    .confetti-111 {
      width: 4px;
      height: 1.6px;
      background-color: #263672;
      top: -10%;
      left: 59%;
      opacity: 1.204400813;
      transform: rotate(187.6373403618deg);
      -webkit-animation: drop-111 4.1239974715s 0.8393035289s infinite;
      animation: drop-111 4.1239974715s 0.8393035289s infinite;
    }

    @-webkit-keyframes drop-111 {
      100% {
        top: 110%;
        left: 70%;
      }
    }

    @keyframes drop-111 {
      100% {
        top: 110%;
        left: 70%;
      }
    }

    .confetti-112 {
      width: 1px;
      height: 0.4px;
      background-color: #d13447;
      top: -10%;
      left: 67%;
      opacity: 0.9975904673;
      transform: rotate(223.9577023836deg);
      -webkit-animation: drop-112 4.2091047567s 0.2522240776s infinite;
      animation: drop-112 4.2091047567s 0.2522240776s infinite;
    }

    @-webkit-keyframes drop-112 {
      100% {
        top: 110%;
        left: 77%;
      }
    }

    @keyframes drop-112 {
      100% {
        top: 110%;
        left: 77%;
      }
    }

    .confetti-113 {
      width: 7px;
      height: 2.8px;
      background-color: #ffbf00;
      top: -10%;
      left: 60%;
      opacity: 0.7272791664;
      transform: rotate(61.08718237deg);
      -webkit-animation: drop-113 4.5735273974s 0.1703319038s infinite;
      animation: drop-113 4.5735273974s 0.1703319038s infinite;
    }

    @-webkit-keyframes drop-113 {
      100% {
        top: 110%;
        left: 73%;
      }
    }

    @keyframes drop-113 {
      100% {
        top: 110%;
        left: 73%;
      }
    }

    .confetti-114 {
      width: 5px;
      height: 2px;
      background-color: #263672;
      top: -10%;
      left: 12%;
      opacity: 0.7647220141;
      transform: rotate(146.9869131819deg);
      -webkit-animation: drop-114 4.9261006333s 0.8049482459s infinite;
      animation: drop-114 4.9261006333s 0.8049482459s infinite;
    }

    @-webkit-keyframes drop-114 {
      100% {
        top: 110%;
        left: 13%;
      }
    }

    @keyframes drop-114 {
      100% {
        top: 110%;
        left: 13%;
      }
    }

    .confetti-115 {
      width: 2px;
      height: 0.8px;
      background-color: #ffbf00;
      top: -10%;
      left: 92%;
      opacity: 0.9181168591;
      transform: rotate(281.35016632deg);
      -webkit-animation: drop-115 4.2020524222s 0.0752242696s infinite;
      animation: drop-115 4.2020524222s 0.0752242696s infinite;
    }

    @-webkit-keyframes drop-115 {
      100% {
        top: 110%;
        left: 100%;
      }
    }

    @keyframes drop-115 {
      100% {
        top: 110%;
        left: 100%;
      }
    }

    .confetti-116 {
      width: 8px;
      height: 3.2px;
      background-color: #ffbf00;
      top: -10%;
      left: 24%;
      opacity: 0.6616870657;
      transform: rotate(275.6546734435deg);
      -webkit-animation: drop-116 4.1456976869s 0.4739380591s infinite;
      animation: drop-116 4.1456976869s 0.4739380591s infinite;
    }

    @-webkit-keyframes drop-116 {
      100% {
        top: 110%;
        left: 35%;
      }
    }

    @keyframes drop-116 {
      100% {
        top: 110%;
        left: 35%;
      }
    }

    .confetti-117 {
      width: 5px;
      height: 2px;
      background-color: #ffbf00;
      top: -10%;
      left: 18%;
      opacity: 0.6212387126;
      transform: rotate(47.6562308962deg);
      -webkit-animation: drop-117 4.349334765s 0.4800546181s infinite;
      animation: drop-117 4.349334765s 0.4800546181s infinite;
    }

    @-webkit-keyframes drop-117 {
      100% {
        top: 110%;
        left: 33%;
      }
    }

    @keyframes drop-117 {
      100% {
        top: 110%;
        left: 33%;
      }
    }

    .confetti-118 {
      width: 6px;
      height: 2.4px;
      background-color: #d13447;
      top: -10%;
      left: 17%;
      opacity: 0.790539712;
      transform: rotate(188.3827211328deg);
      -webkit-animation: drop-118 4.0935756976s 0.9737808012s infinite;
      animation: drop-118 4.0935756976s 0.9737808012s infinite;
    }

    @-webkit-keyframes drop-118 {
      100% {
        top: 110%;
        left: 29%;
      }
    }

    @keyframes drop-118 {
      100% {
        top: 110%;
        left: 29%;
      }
    }

    .confetti-119 {
      width: 2px;
      height: 0.8px;
      background-color: #d13447;
      top: -10%;
      left: 45%;
      opacity: 0.5461195109;
      transform: rotate(89.7748271581deg);
      -webkit-animation: drop-119 4.5459578931s 0.1860819588s infinite;
      animation: drop-119 4.5459578931s 0.1860819588s infinite;
    }

    @-webkit-keyframes drop-119 {
      100% {
        top: 110%;
        left: 47%;
      }
    }

    @keyframes drop-119 {
      100% {
        top: 110%;
        left: 47%;
      }
    }

    .confetti-120 {
      width: 5px;
      height: 2px;
      background-color: #263672;
      top: -10%;
      left: 70%;
      opacity: 1.180459336;
      transform: rotate(194.0397477479deg);
      -webkit-animation: drop-120 4.1749895862s 0.1108214526s infinite;
      animation: drop-120 4.1749895862s 0.1108214526s infinite;
    }

    @-webkit-keyframes drop-120 {
      100% {
        top: 110%;
        left: 85%;
      }
    }

    @keyframes drop-120 {
      100% {
        top: 110%;
        left: 85%;
      }
    }

    .confetti-121 {
      width: 8px;
      height: 3.2px;
      background-color: #ffbf00;
      top: -10%;
      left: 96%;
      opacity: 0.5976793003;
      transform: rotate(299.9646209233deg);
      -webkit-animation: drop-121 4.8698829501s 0.0887837546s infinite;
      animation: drop-121 4.8698829501s 0.0887837546s infinite;
    }

    @-webkit-keyframes drop-121 {
      100% {
        top: 110%;
        left: 98%;
      }
    }

    @keyframes drop-121 {
      100% {
        top: 110%;
        left: 98%;
      }
    }

    .confetti-122 {
      width: 8px;
      height: 3.2px;
      background-color: #263672;
      top: -10%;
      left: 10%;
      opacity: 1.0386905001;
      transform: rotate(89.7049681182deg);
      -webkit-animation: drop-122 4.4564635469s 0.8668497312s infinite;
      animation: drop-122 4.4564635469s 0.8668497312s infinite;
    }

    @-webkit-keyframes drop-122 {
      100% {
        top: 110%;
        left: 11%;
      }
    }

    @keyframes drop-122 {
      100% {
        top: 110%;
        left: 11%;
      }
    }

    .confetti-123 {
      width: 8px;
      height: 3.2px;
      background-color: #ffbf00;
      top: -10%;
      left: 86%;
      opacity: 0.8889463269;
      transform: rotate(31.6383053163deg);
      -webkit-animation: drop-123 4.9766742661s 0.5175178535s infinite;
      animation: drop-123 4.9766742661s 0.5175178535s infinite;
    }

    @-webkit-keyframes drop-123 {
      100% {
        top: 110%;
        left: 100%;
      }
    }

    @keyframes drop-123 {
      100% {
        top: 110%;
        left: 100%;
      }
    }

    .confetti-124 {
      width: 1px;
      height: 0.4px;
      background-color: #263672;
      top: -10%;
      left: 68%;
      opacity: 0.8915383385;
      transform: rotate(10.3876006865deg);
      -webkit-animation: drop-124 4.168064628s 0.1936029335s infinite;
      animation: drop-124 4.168064628s 0.1936029335s infinite;
    }

    @-webkit-keyframes drop-124 {
      100% {
        top: 110%;
        left: 76%;
      }
    }

    @keyframes drop-124 {
      100% {
        top: 110%;
        left: 76%;
      }
    }

    .confetti-125 {
      width: 4px;
      height: 1.6px;
      background-color: #ffbf00;
      top: -10%;
      left: 7%;
      opacity: 0.5837252826;
      transform: rotate(162.645591248deg);
      -webkit-animation: drop-125 4.2474531353s 0.0931108422s infinite;
      animation: drop-125 4.2474531353s 0.0931108422s infinite;
    }

    @-webkit-keyframes drop-125 {
      100% {
        top: 110%;
        left: 14%;
      }
    }

    @keyframes drop-125 {
      100% {
        top: 110%;
        left: 14%;
      }
    }

    .confetti-126 {
      width: 7px;
      height: 2.8px;
      background-color: #263672;
      top: -10%;
      left: 60%;
      opacity: 0.9654582813;
      transform: rotate(258.8566051397deg);
      -webkit-animation: drop-126 4.7313622776s 0.4868373273s infinite;
      animation: drop-126 4.7313622776s 0.4868373273s infinite;
    }

    @-webkit-keyframes drop-126 {
      100% {
        top: 110%;
        left: 61%;
      }
    }

    @keyframes drop-126 {
      100% {
        top: 110%;
        left: 61%;
      }
    }

    .confetti-127 {
      width: 3px;
      height: 1.2px;
      background-color: #d13447;
      top: -10%;
      left: 44%;
      opacity: 1.3956125273;
      transform: rotate(74.6686161904deg);
      -webkit-animation: drop-127 4.9372378884s 0.4050547766s infinite;
      animation: drop-127 4.9372378884s 0.4050547766s infinite;
    }

    @-webkit-keyframes drop-127 {
      100% {
        top: 110%;
        left: 55%;
      }
    }

    @keyframes drop-127 {
      100% {
        top: 110%;
        left: 55%;
      }
    }

    .confetti-128 {
      width: 5px;
      height: 2px;
      background-color: #263672;
      top: -10%;
      left: 95%;
      opacity: 0.6064769509;
      transform: rotate(181.8050829774deg);
      -webkit-animation: drop-128 4.0070107708s 0.3925341242s infinite;
      animation: drop-128 4.0070107708s 0.3925341242s infinite;
    }

    @-webkit-keyframes drop-128 {
      100% {
        top: 110%;
        left: 97%;
      }
    }

    @keyframes drop-128 {
      100% {
        top: 110%;
        left: 97%;
      }
    }

    .confetti-129 {
      width: 4px;
      height: 1.6px;
      background-color: #d13447;
      top: -10%;
      left: 88%;
      opacity: 1.016639026;
      transform: rotate(257.3946506332deg);
      -webkit-animation: drop-129 4.6900472063s 0.776792974s infinite;
      animation: drop-129 4.6900472063s 0.776792974s infinite;
    }

    @-webkit-keyframes drop-129 {
      100% {
        top: 110%;
        left: 92%;
      }
    }

    @keyframes drop-129 {
      100% {
        top: 110%;
        left: 92%;
      }
    }

    .confetti-130 {
      width: 5px;
      height: 2px;
      background-color: #ffbf00;
      top: -10%;
      left: 31%;
      opacity: 1.3602226057;
      transform: rotate(238.8438445339deg);
      -webkit-animation: drop-130 4.6629662348s 0.2723130313s infinite;
      animation: drop-130 4.6629662348s 0.2723130313s infinite;
    }

    @-webkit-keyframes drop-130 {
      100% {
        top: 110%;
        left: 34%;
      }
    }

    @keyframes drop-130 {
      100% {
        top: 110%;
        left: 34%;
      }
    }

    .confetti-131 {
      width: 5px;
      height: 2px;
      background-color: #d13447;
      top: -10%;
      left: 4%;
      opacity: 0.7781127247;
      transform: rotate(330.9238199599deg);
      -webkit-animation: drop-131 4.9389402104s 0.1218341609s infinite;
      animation: drop-131 4.9389402104s 0.1218341609s infinite;
    }

    @-webkit-keyframes drop-131 {
      100% {
        top: 110%;
        left: 10%;
      }
    }

    @keyframes drop-131 {
      100% {
        top: 110%;
        left: 10%;
      }
    }

    .confetti-132 {
      width: 2px;
      height: 0.8px;
      background-color: #263672;
      top: -10%;
      left: 100%;
      opacity: 0.9992081281;
      transform: rotate(324.7939033112deg);
      -webkit-animation: drop-132 4.1173301373s 0.5212154973s infinite;
      animation: drop-132 4.1173301373s 0.5212154973s infinite;
    }

    @-webkit-keyframes drop-132 {
      100% {
        top: 110%;
        left: 101%;
      }
    }

    @keyframes drop-132 {
      100% {
        top: 110%;
        left: 101%;
      }
    }

    .confetti-133 {
      width: 5px;
      height: 2px;
      background-color: #263672;
      top: -10%;
      left: 72%;
      opacity: 0.527656223;
      transform: rotate(33.5215611207deg);
      -webkit-animation: drop-133 4.5265815957s 0.9433660624s infinite;
      animation: drop-133 4.5265815957s 0.9433660624s infinite;
    }

    @-webkit-keyframes drop-133 {
      100% {
        top: 110%;
        left: 76%;
      }
    }

    @keyframes drop-133 {
      100% {
        top: 110%;
        left: 76%;
      }
    }

    .confetti-134 {
      width: 8px;
      height: 3.2px;
      background-color: #263672;
      top: -10%;
      left: 21%;
      opacity: 1.3291601188;
      transform: rotate(200.4751124013deg);
      -webkit-animation: drop-134 4.6508760435s 0.9196370558s infinite;
      animation: drop-134 4.6508760435s 0.9196370558s infinite;
    }

    @-webkit-keyframes drop-134 {
      100% {
        top: 110%;
        left: 32%;
      }
    }

    @keyframes drop-134 {
      100% {
        top: 110%;
        left: 32%;
      }
    }

    .confetti-135 {
      width: 4px;
      height: 1.6px;
      background-color: #263672;
      top: -10%;
      left: 71%;
      opacity: 0.7443857677;
      transform: rotate(125.2731867376deg);
      -webkit-animation: drop-135 4.4456367593s 0.0165161114s infinite;
      animation: drop-135 4.4456367593s 0.0165161114s infinite;
    }

    @-webkit-keyframes drop-135 {
      100% {
        top: 110%;
        left: 82%;
      }
    }

    @keyframes drop-135 {
      100% {
        top: 110%;
        left: 82%;
      }
    }

    .confetti-136 {
      width: 3px;
      height: 1.2px;
      background-color: #263672;
      top: -10%;
      left: 8%;
      opacity: 0.7354917372;
      transform: rotate(185.6952674869deg);
      -webkit-animation: drop-136 4.3200745479s 0.6945460309s infinite;
      animation: drop-136 4.3200745479s 0.6945460309s infinite;
    }

    @-webkit-keyframes drop-136 {
      100% {
        top: 110%;
        left: 20%;
      }
    }

    @keyframes drop-136 {
      100% {
        top: 110%;
        left: 20%;
      }
    }

    .confetti-137 {
      width: 2px;
      height: 0.8px;
      background-color: #d13447;
      top: -10%;
      left: 25%;
      opacity: 1.4260867791;
      transform: rotate(197.1390318287deg);
      -webkit-animation: drop-137 4.3624532511s 0.8617091237s infinite;
      animation: drop-137 4.3624532511s 0.8617091237s infinite;
    }

    @-webkit-keyframes drop-137 {
      100% {
        top: 110%;
        left: 29%;
      }
    }

    @keyframes drop-137 {
      100% {
        top: 110%;
        left: 29%;
      }
    }

    .confetti-138 {
      width: 8px;
      height: 3.2px;
      background-color: #263672;
      top: -10%;
      left: 51%;
      opacity: 1.0060490542;
      transform: rotate(129.1922264907deg);
      -webkit-animation: drop-138 4.9999120411s 0.8499453653s infinite;
      animation: drop-138 4.9999120411s 0.8499453653s infinite;
    }

    @-webkit-keyframes drop-138 {
      100% {
        top: 110%;
        left: 58%;
      }
    }

    @keyframes drop-138 {
      100% {
        top: 110%;
        left: 58%;
      }
    }

    .confetti-139 {
      width: 8px;
      height: 3.2px;
      background-color: #d13447;
      top: -10%;
      left: 28%;
      opacity: 1.0415916903;
      transform: rotate(22.2994795961deg);
      -webkit-animation: drop-139 4.3937158444s 0.5136685262s infinite;
      animation: drop-139 4.3937158444s 0.5136685262s infinite;
    }

    @-webkit-keyframes drop-139 {
      100% {
        top: 110%;
        left: 33%;
      }
    }

    @keyframes drop-139 {
      100% {
        top: 110%;
        left: 33%;
      }
    }

    .confetti-140 {
      width: 7px;
      height: 2.8px;
      background-color: #ffbf00;
      top: -10%;
      left: 51%;
      opacity: 1.1386053637;
      transform: rotate(28.9077698015deg);
      -webkit-animation: drop-140 4.4070908873s 0.7244541374s infinite;
      animation: drop-140 4.4070908873s 0.7244541374s infinite;
    }

    @-webkit-keyframes drop-140 {
      100% {
        top: 110%;
        left: 65%;
      }
    }

    @keyframes drop-140 {
      100% {
        top: 110%;
        left: 65%;
      }
    }

    .confetti-141 {
      width: 1px;
      height: 0.4px;
      background-color: #ffbf00;
      top: -10%;
      left: 10%;
      opacity: 1.066084515;
      transform: rotate(195.6661780904deg);
      -webkit-animation: drop-141 4.3492045713s 0.3984591608s infinite;
      animation: drop-141 4.3492045713s 0.3984591608s infinite;
    }

    @-webkit-keyframes drop-141 {
      100% {
        top: 110%;
        left: 21%;
      }
    }

    @keyframes drop-141 {
      100% {
        top: 110%;
        left: 21%;
      }
    }

    .confetti-142 {
      width: 4px;
      height: 1.6px;
      background-color: #d13447;
      top: -10%;
      left: 42%;
      opacity: 1.2861556241;
      transform: rotate(342.2103885267deg);
      -webkit-animation: drop-142 4.0309388926s 0.0618259885s infinite;
      animation: drop-142 4.0309388926s 0.0618259885s infinite;
    }

    @-webkit-keyframes drop-142 {
      100% {
        top: 110%;
        left: 53%;
      }
    }

    @keyframes drop-142 {
      100% {
        top: 110%;
        left: 53%;
      }
    }

    .confetti-143 {
      width: 7px;
      height: 2.8px;
      background-color: #ffbf00;
      top: -10%;
      left: 44%;
      opacity: 0.9555676917;
      transform: rotate(26.3160787674deg);
      -webkit-animation: drop-143 4.0378056093s 0.5418117725s infinite;
      animation: drop-143 4.0378056093s 0.5418117725s infinite;
    }

    @-webkit-keyframes drop-143 {
      100% {
        top: 110%;
        left: 47%;
      }
    }

    @keyframes drop-143 {
      100% {
        top: 110%;
        left: 47%;
      }
    }

    .confetti-144 {
      width: 4px;
      height: 1.6px;
      background-color: #263672;
      top: -10%;
      left: 22%;
      opacity: 1.4617325116;
      transform: rotate(209.15705225deg);
      -webkit-animation: drop-144 4.1447477674s 0.501369738s infinite;
      animation: drop-144 4.1447477674s 0.501369738s infinite;
    }

    @-webkit-keyframes drop-144 {
      100% {
        top: 110%;
        left: 35%;
      }
    }

    @keyframes drop-144 {
      100% {
        top: 110%;
        left: 35%;
      }
    }

    .confetti-145 {
      width: 4px;
      height: 1.6px;
      background-color: #ffbf00;
      top: -10%;
      left: 12%;
      opacity: 0.6505460934;
      transform: rotate(264.0062721639deg);
      -webkit-animation: drop-145 4.5584385487s 0.6241204341s infinite;
      animation: drop-145 4.5584385487s 0.6241204341s infinite;
    }

    @-webkit-keyframes drop-145 {
      100% {
        top: 110%;
        left: 17%;
      }
    }

    @keyframes drop-145 {
      100% {
        top: 110%;
        left: 17%;
      }
    }

    .confetti-146 {
      width: 7px;
      height: 2.8px;
      background-color: #d13447;
      top: -10%;
      left: 24%;
      opacity: 1.3485895032;
      transform: rotate(127.4061329437deg);
      -webkit-animation: drop-146 4.2778638818s 0.7723840289s infinite;
      animation: drop-146 4.2778638818s 0.7723840289s infinite;
    }

    @-webkit-keyframes drop-146 {
      100% {
        top: 110%;
        left: 28%;
      }
    }

    @keyframes drop-146 {
      100% {
        top: 110%;
        left: 28%;
      }
    }

    .confetti-147 {
      width: 7px;
      height: 2.8px;
      background-color: #263672;
      top: -10%;
      left: 35%;
      opacity: 1.3799466456;
      transform: rotate(225.2621986787deg);
      -webkit-animation: drop-147 4.6343686446s 0.5111498239s infinite;
      animation: drop-147 4.6343686446s 0.5111498239s infinite;
    }

    @-webkit-keyframes drop-147 {
      100% {
        top: 110%;
        left: 39%;
      }
    }

    @keyframes drop-147 {
      100% {
        top: 110%;
        left: 39%;
      }
    }

    .confetti-148 {
      width: 8px;
      height: 3.2px;
      background-color: #263672;
      top: -10%;
      left: 33%;
      opacity: 1.2040294299;
      transform: rotate(105.6842771383deg);
      -webkit-animation: drop-148 4.8614274429s 0.4572124345s infinite;
      animation: drop-148 4.8614274429s 0.4572124345s infinite;
    }

    @-webkit-keyframes drop-148 {
      100% {
        top: 110%;
        left: 48%;
      }
    }

    @keyframes drop-148 {
      100% {
        top: 110%;
        left: 48%;
      }
    }

    .confetti-149 {
      width: 2px;
      height: 0.8px;
      background-color: #d13447;
      top: -10%;
      left: 83%;
      opacity: 0.9545574708;
      transform: rotate(40.6319160463deg);
      -webkit-animation: drop-149 4.3093090242s 0.0351397224s infinite;
      animation: drop-149 4.3093090242s 0.0351397224s infinite;
    }

    @-webkit-keyframes drop-149 {
      100% {
        top: 110%;
        left: 97%;
      }
    }

    @keyframes drop-149 {
      100% {
        top: 110%;
        left: 97%;
      }
    }

    .confetti-150 {
      width: 8px;
      height: 3.2px;
      background-color: #263672;
      top: -10%;
      left: 29%;
      opacity: 1.4187238251;
      transform: rotate(257.4740255531deg);
      -webkit-animation: drop-150 4.7355661245s 0.8390148718s infinite;
      animation: drop-150 4.7355661245s 0.8390148718s infinite;
    }

    @-webkit-keyframes drop-150 {
      100% {
        top: 110%;
        left: 37%;
      }
    }

    @keyframes drop-150 {
      100% {
        top: 110%;
        left: 37%;
      }
    }

    .tel {
      color: red;
      font-weight: bold;
    }

    #transmisionIframe {
      display: flex;
      justify-content: center;
      align-items: center;
    }
  </style>

</body>

</html>