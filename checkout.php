<?php

if (!isset($_COOKIE["lotto_lg"])) {
    header("Location: login-register.php?r=chk");
} else {
    require_once("server/api/carrito.php");

    //$loginExp = time() + 3600;

    function get_datos_usuario()
    {
        global $loginExp;
        if (isset($_COOKIE["lotto_lg"])) {
            $tmp = json_decode($_COOKIE["lotto_lg"], true);
            $email = $tmp["u"];
            try {
                $conn = PDOConnection::getConnection();
                $sql = "SELECT * FROM clients WHERE email = :correo LIMIT 1";
                //global $secreto;
                $stm = $conn->prepare($sql);
                $stm->bindParam(":correo", $email);
                $stm->execute();
                $num = $stm->rowCount();
                if ($num > 0) {
                    $row = $stm->fetch(PDO::FETCH_ASSOC);
                    extract($row);
                    $response["code"] = 200;
                    $response["usuario"] = $row;
                    $tmp = array(
                        "u" => $row["email"],
                        "id" => $row["ID"]
                    );
                    setcookie("lotto_lg", json_encode($tmp), $loginExp, "/");
                }
            } catch (Exception $e) {
                $response["code"] = 500;
                $response["msg"] = "Error en el servidor: " . $e->getMessage();
            }
        } else if (isset($_COOKIE["ech_lg_tmp"])) {
            $response["usuario"] = json_decode($_COOKIE["ech_lg_tmp"], true);
            $response["tmp"] = true;
            $response["code"] = 200;
        } else {
            $response["code"] = 400;
            $response["msg"] = "No se enviaron datos";
        }
        if (isset($_COOKIE["idV"]))
            $response["idV"] = $_COOKIE["idV"];
        else
            $response["idV"] = "";
        if (isset($_COOKIE["idVM"]))
            $response["idVM"] = $_COOKIE["idVM"];
        else
            $response["idVM"] = "";
        $conn = null;
        return ($response);
    }

    $datos = get_datos_usuario();
    $usuario = $datos["usuario"];

    //var_dump($usuario);
    $lista = array();
    $resp = get_cart2();
    //var_dump($resp);
    //var_dump($resp["itemsCart"][0]);

    if ($resp["code"] == 200) {
        if (isset($resp["itemsCart"])) {
            $subt = 0;
            $cart = $resp["itemsCart"];
            //var_dump($cart);
            foreach ($cart as $key => $value) {
                /*$item = new MercadoPago\Item();
                $item->id = $value["id"];
                $item->title = $value["nombre"];
                $item->quantity = $value["qty"];
                $item->unit_price = $value["precio"];
                $item->description = $value["descripcion"];
                $item->currency_id = "MXN";
                array_push($lista, $item);*/
                array_push($lista, $value["Game_name"] . " - Tarjeta (" . $value["ID"] . ");");
                $subt += $value["Card_price"];
            }
        }
        //echo $subt;
        if ($subt >= 1000)
            $envio = 0;
        else {
            $envio = 100;
            /*$item2 = new MercadoPago\Item();
          $item2->id = "envio";
          $item2->title = "envío";
          $item2->quantity = 1;
          $item2->unit_price = $envio;
          $item2->description = "";
          $item2->currency_id = "MXN";
          array_push($lista, $item2);*/
            array_push($lista, $envio);
        }

        if (isset($resp["itemsCart_oferta"])) {
            $cart_oferta = $resp["itemsCart_oferta"];
            foreach ($cart_oferta as $key => $value) {
                /*$item = new MercadoPago\Item();
                $item->id = $value["ID"];
                $item->title = $value["Promocion"];
                $item->quantity = $value["qty"];
                $item->unit_price = $value["precio"];
                $item->description = $value["Descripcion"];
                $item->currency_id = "MXN";*/
                array_push($lista, $value["nombre"]);
            }
        }


        //$preference->items = $lista;

        /*if($datos["code"] == 200){
          $payer = new MercadoPago\Payer();
          $payer->name = $usuario["Nombre"]." ".$usuario["Apellidos"];
          $payer->email = $usuario["Email"];
          $payer->phone = array(
              "area_code" => "",
              "number" => $usuario["Tel1"]
            );

          $calle_num = explode("#",$usuario["Calle_numero"]);
          $calle = $calle_num[0];
          $numeros = explode(" ", $calle_num[1]);
          $exterior = $numeros[0];
          $interior = $numeros[1];

          $payer->address = array(
              "street_name" => $calle,
              "street_number" => $exterior,
              "zip_code" => $usuario["CP"]
            );

          $preference->payer = $payer;
          $preference->external_reference = $usuario["ID"];
        }

        
        
       $preference->back_urls = array(
            "success" => "https://avynacos.mx/success.php",
            "failure" => "https://avynacos.mx/checkout.php",
            "pending" => "https://avynacos.mx/success.php"
        );


        $preference->auto_return = "all";
        
        $preference->save();*/
    }


?>
    <!doctype html>
    <html class="no-js" lang="zxx">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Checkout</title>
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

        <!--SANDBOX PAYPAL
        <script src="https://www.paypal.com/sdk/js?client-id=AdTGJIm3KyLp88QS60AoLVKBgxHMnWqmblG-pTxh5bTeGik8Jvrmb361sGzPnOQK7NJrOMKE1RoB1-Yi&locale=es_MX&currency=MXN"></script>-->

        <!--LIVE PAYPAL-->
        <script src="https://www.paypal.com/sdk/js?client-id=AfYEBl4hTSWciNcpDseXpgal1MCBGXJ_jBhsZVUELuCl20IjPsbpNoGoPNifesS4l1rJLkrwfqIgbYGX&locale=es_MX&currency=MXN&disable-funding=credit,oxxo"></script>



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

            <!-- Start Toolbar -->
            <div class="demo-option-container">
                <!-- Start Toolbar -->
                <div class="brook__toolbar">
                    <div class="inner">
                        <a class="quick-option hint--bounce hint--left hint--black primary-color-hover-important" href="#" aria-label="Quick Options">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <a class="hint--bounce hint--left hint--black primary-color-hover-important" target="_blank" href="https://hasthemes.com/contact-us/" aria-label="Support Center">
                            <i class="fa fa-life-ring"></i>
                        </a>
                        <a class="hint--bounce hint--left hint--black primary-color-hover-important" target="_blank" href="https://themeforest.net/item/brook-creative-agency-business-html-template/24226512?s_rank=5" aria-label="Purchase Brook">
                            <i class="fa fa-shopping-cart"></i>
                        </a>
                    </div>
                </div>
                <!-- End Toolbar -->
                <!-- Start Quick Link -->
                <div class="demo-option-wrapper">
                    <div class="demo-panel-header">
                        <div class="panel-btn">
                            <a class="brook-btn bk-btn-theme btn-sd-size btn-rounded space-between" href="https://themeforest.net/item/brook-creative-agency-business-html-template/24226512?s_rank=1"><i class="ion-android-cart"></i> Buy Brook Now </a>
                        </div>
                        <div class="title">
                            <h5 class="heading heading-h5"> Brook – Creative Multipurpose Html5 Template</h5>
                            <div class="desc">
                                <p class="bk_pra"> Brook embraces a modern look with various enhanced short codes, premium
                                    plugins and pre-defined page elements.</p>
                            </div>
                        </div>
                    </div>
                    <div class="demo-quick-option-list">
                        <a class="link hint--bounce hint--top hint--dark" href="index-business.html" aria-label="Business">
                            <img src="img/demo-image/home-business.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-expert.html" aria-label="Expert">
                            <img src="img/demo-image/home-expert.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-revolutionary.html" aria-label="Revolutionary">
                            <img src="img/demo-image/home-revolutionary.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-authentic-studio.html" aria-label="Authentic Studio">
                            <img src="img/demo-image/home-authentic-studio.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-astronomy.html" aria-label="Astronomy">
                            <img src="img/demo-image/home-astronomy.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-news-bulletin.html" aria-label="News Bulletin">
                            <img src="img/demo-image/home-news-bulletin.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-digital-broadsheets.html" aria-label="Digital Broadsheets">
                            <img src="img/demo-image/home-digital-broadsheets.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-creative-agency.html" aria-label="Creative Agency">
                            <img src="img/demo-image/home-creative-agency.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-digital-agency.html" aria-label="Digital Agency">
                            <img src="img/demo-image/home-digital-agency.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-vertical-menu.html" aria-label="Vertical Menu">
                            <img src="img/demo-image/home-vertical-menu.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-design-studio.html" aria-label="Design Studio">
                            <img src="img/demo-image/home-design-studio.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-creative-portfolio.html" aria-label="Creative Portfolio">
                            <img src="img/demo-image/home-creative-portfolio.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-freelancer.html" aria-label="Freelancer">
                            <img src="img/demo-image/home-freelancer.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-vertical-slider-portfolio.html" aria-label="Vertical Slide Portfolio">
                            <img src="img/demo-image/home-vertical-slide-portfolio.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-minimal-portfolio.html" aria-label="Minimal Portfolio">
                            <img src="img/demo-image/home-minimal-portfolio.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-onepage.html" aria-label="Onepage">
                            <img src="img/demo-image/home-onepage.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-landing.html" aria-label="Landing">
                            <img src="img/demo-image/home-landing.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-architecture.html" aria-label="Architecture">
                            <img src="img/demo-image/home-architecture.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-portfolio-fullscreen-type-hover-02.html" aria-label="Portfolio Fullscreen Type Hover 02">
                            <img src="img/demo-image/home-hover-type-02.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-minimal-agency.html" aria-label="Minimal Agency">
                            <img src="img/demo-image/home-minimal-agency.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-start-ups.html" aria-label="Start-ups">
                            <img src="img/demo-image/home-start-ups.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-presentation.html" aria-label="Presentation">
                            <img src="img/demo-image/home-presentation.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-blog-metro.html" aria-label="Metro Blog">
                            <img src="img/demo-image/home-metro-blog.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-portfolio-mesonry-left-vertical-header.html" aria-label="Portfolio Masonry – Left Vertical Header">
                            <img src="img/demo-image/home-portfolio-masonry-left-vertical-header.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-masonry-gallery.html" aria-label="Masonry Gallery">
                            <img src="img/demo-image/home-masonry-gallery.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-home-services-classic.html" aria-label="Service">
                            <img src="img/demo-image/home-service.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-minimal-metro-grid.html" aria-label="Minimal Metro Grid">
                            <img src="img/demo-image/home-minimal-metro-grid.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-shop.html" aria-label="Shop">
                            <img src="img/demo-image/home-shop.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-product-landing.html" aria-label="Product Landing">
                            <img src="img/demo-image/home-product-landing.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-indie-musician.html" aria-label="Indie Musician">
                            <img src="img/demo-image/home-indie-musician.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-foodie.html" aria-label="Foodie">
                            <img src="img/demo-image/home-foodie.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-vertical-slide-gradient-portfolio.html" aria-label="Vertical Slide Gradient Portfolio">
                            <img src="img/demo-image/home-vertical-slide-gradient-portfolio.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-portfolio-fullscreen-slider-left-vertical-header.html" aria-label="Portfolio Fullscreen Slider Left Vertical Header">
                            <img src="img/demo-image/home-portfolio-fullscreen-slider-left-vertical-header.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-portfolio-fullscreen-type-hover.html" aria-label="Portfolio Fullscreen Type Hover">
                            <img src="img/demo-image/home-hover-type.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-portfolio-slide.html" aria-label="Portfolio Slide">
                            <img src="img/demo-image/home-portfolio-slide.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-photo-slider-gallery.html" aria-label="Photo Slider Gallery">
                            <img src="img/demo-image/home-photo-slider-gallery.jpg" alt="Multipurpose Template"></a>

                        <a class="link hint--bounce hint--top hint--dark" href="index-blog-grid.html" aria-label="Grid Blog">
                            <img src="img/demo-image/home-grid-blog.jpg" alt="Multipurpose Template"></a>

                    </div>
                </div>
                <!-- End Quick Link -->
            </div>
            <!-- End Toolbar -->

            <!-- Start Breadcaump Area -->
            <div class="breadcaump-area pt--200 pb--50 bg_color--1 breadcaump-title-bar">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcaump-inner text-center">
                                <h1 class="heading heading-h1">Checkout</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Breadcaump Area -->

            <!-- Page Conttent -->
            <main class="page-content">


                <!-- Checkout Page Start -->
                <div class="checkout_area pt--80 pb--150">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <!-- Checkout Form s-->
                                <form action="javascript:void(0);" class="checkout-form" id="datosEnvio">
                                    <div class="row">

                                        <div class="col-lg-7 mb--20">

                                            <!-- Billing Address -->
                                            <div id="billing-form" class="mb--40">
                                                <h4 class="checkout-title">Datos de envío</h4>

                                                <div class="row">

                                                    <div class="col-md-6 col-12 mb--20">
                                                        <label>Nombre*</label>
                                                        <input type="text" placeholder="" name="nombre" required>
                                                    </div>

                                                    <div class="col-md-6 col-12 mb--20">
                                                        <label>Apellidos*</label>
                                                        <input type="text" placeholder="" name="apellido" required>
                                                    </div>

                                                    <div class="col-md-6 col-12 mb--20">
                                                        <label>Email*</label>
                                                        <input type="email" placeholder="" name="email" required>
                                                    </div>

                                                    <div class="col-md-6 col-12 mb--20">
                                                        <label>Teléfono*</label>
                                                        <input type="text" placeholder="" name="telefono" required>
                                                    </div>

                                                    <!--div class="col-12 mb--20">
                                                        <label>Dirección*</label>
                                                        <input type="text" placeholder="Línea 1" name="direccion1" required>
                                                        <input type="text" placeholder="Línea 2" name="direccion2">
                                                    </div-->

                                                    <!--div class="col-md-6 col-12 mb--20">
                                                        <label>País*</label>
                                                        <input type="text" placeholder="" name="pais" required>
                                                    </div>

                                                    <div class="col-md-6 col-12 mb--20">
                                                        <label>Ciudad*</label>
                                                        <input type="text" placeholder="" name="ciudad" required>
                                                    </div>

                                                    <div class="col-md-6 col-12 mb--20">
                                                        <label>Estado*</label>
                                                        <input type="text" placeholder="" name="estado" required>
                                                    </div>

                                                    <div class="col-md-6 col-12 mb--20">
                                                        <label>Código postal*</label>
                                                        <input type="text" placeholder="" name="cp" required>
                                                    </div-->

                                                    <!--<div class="col-12 mb--20">
                                                    <div class="check-box">
                                                        <input type="checkbox" id="create_account">
                                                        <label for="create_account">Create an Account?</label>
                                                    </div>
                                                    <div class="check-box">
                                                        <input type="checkbox" id="shiping_address" data-shipping>
                                                        <label for="shiping_address">Ship to Different Address</label>
                                                    </div>
                                                </div>-->

                                                </div>

                                            </div>

                                            <!-- Shipping Address -->
                                            <!--<div id="shipping-form" class="mb--40">
                                            <h4 class="checkout-title">Shipping Address</h4>

                                            <div class="row">

                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>First Name*</label>
                                                    <input type="text" placeholder="First Name">
                                                </div>

                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Last Name*</label>
                                                    <input type="text" placeholder="Last Name">
                                                </div>

                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Email Address*</label>
                                                    <input type="email" placeholder="Email Address">
                                                </div>

                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Phone no*</label>
                                                    <input type="text" placeholder="Phone number">
                                                </div>

                                                <div class="col-12 mb--20">
                                                    <label>Company Name</label>
                                                    <input type="text" placeholder="Company Name">
                                                </div>

                                                <div class="col-12 mb--20">
                                                    <label>Address*</label>
                                                    <input type="text" placeholder="Address line 1">
                                                    <input type="text" placeholder="Address line 2">
                                                </div>

                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Country*</label>
                                                    <select class="nice-select">
                                                        <option>Bangladesh</option>
                                                        <option>China</option>
                                                        <option>country</option>
                                                        <option>India</option>
                                                        <option>Japan</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Town/City*</label>
                                                    <input type="text" placeholder="Town/City">
                                                </div>

                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>State*</label>
                                                    <input type="text" placeholder="State">
                                                </div>

                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Zip Code*</label>
                                                    <input type="text" placeholder="Zip Code">
                                                </div>

                                            </div>

                                        </div>-->

                                        </div>

                                        <div class="col-lg-5">
                                            <div class="row">

                                                <!-- Cart Total -->
                                                <div class="col-12 mb--60">

                                                    <h4 class="checkout-title">Resumen de tu pedido</h4>

                                                    <div class="checkout-cart-total">

                                                        <h4>Cartón <span>Total</span></h4>

                                                        <ul>
                                                            <?php
                                                            if ($resp["code"] == 200 && count($lista) > 0) {
                                                                if (isset($resp["itemsCart"])) {
                                                                    foreach ($cart as $key => $value) {
                                                            ?>
                                                                        <li><?php echo $value["Game_name"] . " - Cartón (" . $value["ID"] . ")"; ?> X 01 <span>$<?php echo $value["Card_price"]; ?>.00</span></li>
                                                            <?php
                                                                    }
                                                                }
                                                            }
                                                            ?>

                                                            <!--<li>Aquet Drone D 420 X 02 <span>$550.00</span></li>
                                                        <li>Play Station X 22 X 01 <span>$295.00</span></li>
                                                        <li>Roxxe Headphone Z 75 X 01 <span>$110.00</span></li>-->
                                                        </ul>

                                                        <!--<p>Sub Total <span>$<?php
                                                                                /*if($resp["code"] == 200 && count($lista) > 0){
                                                            
                                                            //$sub = floatval($resp["subtotal"] / 1.16);
                                                            $sub = floatval($resp["subtotal"]);
                                                            //echo $sub;
                                                            echo number_format($sub,2,'.',',');
                                                        }
                                                        else
                                                            echo "0.00";*/
                                                                                ?></span></p>-->
                                                        <!--<p>Shipping Fee <span>$00.00</span></p>-->

                                                        <h4>Total <span>$<?php
                                                                            if ($resp["code"] == 200 && count($lista) > 0) {

                                                                                //$sub = floatval($resp["subtotal"] / 1.16);
                                                                                $sub = floatval($resp["subtotal"]);
                                                                                //echo $sub;
                                                                                echo number_format($sub, 2, '.', ',');
                                                                            } else
                                                                                echo "0.00";
                                                                            ?></span></h4>
                                                        <div class="plceholder-button mt--50">
                                                            <button class="brook-btn bk-btn-theme btn-sd-size btn-rounded space-between" id="continuarPago" style="width: 100%;">Continuar al pago</button>
                                                            <button class="brook-btn bk-btn-theme btn-sd-size btn-rounded space-between" id="irTienda" style="width: 100%;">Seguir comprando</button>
                                                            <input type="submit" id="btnEnviar" hidden>
                                                        </div>
                                                    </div>

                                                </div>

                                                <!-- Payment Method -->
                                                <div class="col-12 mb--60">
                                                    <!--<h4 class="checkout-title">Payment Method</h4>-->

                                                    <div class="checkout-payment-method" id="paypal-button-container" style="display: none !important;">
                                                        <h4 class="checkout-title">Método de pago</h4>

                                                        <script>
                                                            paypal.Buttons({

                                                                // Set up the transaction
                                                                createOrder: function(data, actions) {
                                                                    return actions.order.create({
                                                                        purchase_units: [{
                                                                            amount: {
                                                                                value: '<?php echo number_format($resp["subtotal"], 2, '.', ''); ?>'
                                                                            }
                                                                        }]
                                                                    });
                                                                },

                                                                // Finalize the transaction
                                                                onApprove: function(data, actions) {
                                                                    console.log("DAATA PAYPAL APROVE: ");
                                                                    console.log(data);
                                                                    return actions.order.capture().then(function(details) {
                                                                        console.log(details);
                                                                        Pay_num = details.purchase_units[0].payments.captures[0].id;
                                                                        Order_num = details.id;
                                                                        Status = details.status;
                                                                        //idTransaccion = 
                                                                        Gateway = "Paypal";
                                                                        guardar_pago();
                                                                    });
                                                                }


                                                            }).render('#paypal-button-container');
                                                            // Render the PayPal button into #paypal-button-container
                                                            /*sesion_activa(botones);
                                                            function botones(r){
                                                                if(r){
                                                                    
                                                                }else{
                                                                    console.log("#reload")
                                                                }
                                                            }*/
                                                        </script>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Checkout Page End -->
            </main>
            <!--// Page Conttent -->

            <!-- Footer -->
            <footer id="bk-footer" class="page-footer bg_color--3 pl--150 pr--150 pl_lg--30 pr_lg--30 pl_md--30 pr_md--30 pl_sm--5 pr_sm--5">
                <!-- Start Footer Top Area -->
                <div class="bk-footer-inner pt--150 pb--30 pt_sm--100">
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="footer-widget text-var--2">
                                    <div class="logo">
                                        <a href="index.html">
                                            <img src="img/logo/brook-white2.png" alt="brook white">
                                        </a>
                                    </div>
                                    <div class="footer-inner">
                                        <p>Brook is a multi-purpose WordPress theme for big and small-sized businesses.
                                            Enjoy
                                            the theme's original design, functional features & responsive layouts.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-6 col-sm-6 col-12 mt_mobile--40">
                                <div class="footer-widget text-var--2 menu--about">
                                    <h2 class="widgettitle">About us</h2>
                                    <div class="footer-menu">
                                        <ul class="ft-menu-list bk-hover">
                                            <li><a href="about-us-01.html">About Us</a></li>
                                            <li><a href="team.html">Team</a></li>
                                            <li><a href="#">Career</a></li>
                                            <li><a href="services-classic.html">Services</a></li>
                                            <li><a href="contact.html">Contact</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt_md--40 mt_sm--40">
                                <div class="footer-widget text-var--2 menu--contact">
                                    <h2 class="widgettitle">Contact</h2>
                                    <div class="footer-address">
                                        <div class="bk-hover">
                                            <p>2005 Stokes Isle Apt. 896, <br> Vacaville 10010, USA</p>
                                            <p><a href="#">info@yourdomain.com</a></p>
                                            <p><a href="#">(+68) 120034509</a></p>
                                        </div>
                                        <div class="social-share social--transparent text-white">
                                            <a href="#"><i class="fab fa-facebook"></i></a>
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                            <a href="#"><i class="fab fa-instagram"></i></a>
                                            <a href="#"><i class="fab fa-dribbble"></i></a>
                                            <a href="#"><i class="fab fa-pinterest"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt_md--40 mt_sm--40">
                                <div class="footer-widget text-var--2 menu--instagram">
                                    <h2 class="widgettitle">Instagram</h2>

                                    <div class="ft-instagram-list">

                                        <div class="instagram-grid-wrap">

                                            <!-- Start Single Instagram -->
                                            <div class="item-grid grid-style--1">
                                                <div class="thumb">
                                                    <a href="#">
                                                        <img src="img/instagram/instagram-1/instagram-7.jpg" alt="instagram images">
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
                                                        <img src="img/instagram/instagram-1/instagram-8.jpg" alt="instagram images">
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
                                                        <img src="img/instagram/instagram-1/instagram-9.jpg" alt="instagram images">
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
                                                        <img src="img/instagram/instagram-1/instagram-10.jpg" alt="instagram images">
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
                                                        <img src="img/instagram/instagram-1/instagram-11.jpg" alt="instagram images">
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
                                                        <img src="img/instagram/instagram-1/instagram-12.jpg" alt="instagram images">
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
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Start Footer Top Area -->

                <!-- Start Copyright Area -->
                <div class="copyright ptb--50 text-var-2">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="copyright-left text-md-left text-center">
                                    <ul class="bk-copyright-menu d-flex bk-hover justify-content-center justify-content-md-start flex-wrap flex-sm-nowrap">
                                        <li><a href="#">Our blog</a></li>
                                        <li><a href="#">Latest projects</a></li>
                                        <li><a href="#">Contact us</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="copyright-right text-md-right text-center">
                                    <p>© 2019 Brook. <a href="https://hasthemes.com/">All Rights Reserved.</a></p>
                                </div>
                            </div>
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
        <script type="text/javascript" src="server/controllers/get.js"></script>
        <script type="text/javascript" src="server/controllers/dom-to-image.js"></script>
        <script type="text/javascript" src="server/controllers/index_1658177167.js"></script>
        <script type="text/javascript" src="server/controllers/ajax_cart.js"></script>
        <script type="text/javascript" src="server/controllers/checkout.js"></script>
    </body>

    </html>
<?php
}
?>