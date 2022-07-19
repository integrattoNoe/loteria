var tarjetas;
var idGame = 0;
var anteriores;
var inicio = true;
//var contadorFrijolitos;

$(document).ready(function() {
    var params = GET(window.location.href);
    if (params) {
        idGame = params.g.replace("#", "");
    }
    sesionjuego();
    getCantadas();
    getGameInfo();


})


$("#iniciarSesion,#sesion1").on("click", function() {
    var params = GET(window.location.href);
    window.location.href = "login-register.php?r=game&id=" + idGame;
})

$("#salir").on("click", function() {
    var url = 'server/api/login.php';
    jQuery.ajax({
        url: url,
        data: { "opcion": "salir" },
        type: "POST",
        beforeSend: function() {
            jQuery(".ai-preloader").addClass("active");
        },
        success: function(data) {
            if (data.code == 200) {
                jQuery("#usuario p").text("");
                jQuery("#usuario").hide();
                jQuery("#iniciarSesion").show()
                window.location.href = "index.html";

            } else
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.msg
                });

        },
        complete: function() {
            jQuery(".ai-preloader").removeClass("active");
            //getParams();
        }
    });
})

function sesionjuego() {
    var url = 'server/api/login.php';
    jQuery.ajax({
        url: url,
        data: { "opcion": "sesion" },
        type: "POST",
        beforeSend: function() {
            jQuery(".ai-preloader").addClass("active");
        },
        success: function(data) {
            if (data.code == 200) {
                console.log(data)
                let usuario = data.data[0].First_name != null ? " " + data.data[0].First_name : "";
                //usuario += data.data[0].Last_name != null ? " "+data.data[0].Last_name : "";
                jQuery("#usuario p").html("<strong>HOLA  </strong><strong>" + usuario + "</strong>");
                jQuery("#usuario").show();
                jQuery("#iniciarSesion,.contenedor-login,#registrarse").hide()
                    //getCantadas();
                getTarjetas();
                window.setInterval(function() {
                    getCantadas();
                }, 10000);

            } else {
                $(".contenedor-mazo,.contenedor-actual,.contenedor-otras").hide();
                $("#vacio2").show();
            }


        },
        complete: function() {
            jQuery(".ai-preloader").removeClass("active");
            //getParams();
        }
    });
}

function getTarjetas() {
    var url = 'server/api/usuario.php';
    $.ajax({
        url: url,
        data: { "opcion": "getTarjetasByGame", "idGame": idGame },
        type: "POST",
        beforeSend: function() {
            if (inicio)
                $("body").removeClass("loaded");
        },
        success: function(data) {
            console.log(data)
            if (data.code == 200) {
                tarjetas = data.tarjetas;
                renderTarjetas(data.tarjetas);
            } else {
                $(".contenedor-mazo,.contenedor-actual,.contenedor-otras").hide();
                $("#vacio").show();
            }
        },
        complete: function() {
            if (inicio)
                $("body").addClass("loaded");
            renderTarjetasAnteriores();
        }
    });
}

function renderTarjetas(carrito) {
    var elem = "";
    var item;
    for (var i in carrito) {
        var tarjeta = carrito[i];
        elem = '<div id="' + tarjeta.ID + '" class="pl--10 pr--10 mb--10 otherCard">';
        elem += '<div class="ganador"></div>';
        if (i == 0)
            elem += '<div class="contenedorCarta pb-0 activo">';
        else
            elem += '<div class="contenedorCarta pb-0">';

        elem += '<a href="#" data-index="' + i + '">';
        elem += '<div class="product-thumbnail">';
        elem += '<div class="thumbnail">';
        /*elem += '<div class="row cabecera">';
        elem += '<div class="logo col-md-8"><img src="http://integrattodev.cloudapp.net/Elotto/assets/images/elotto/logo.jpg" style="max-width:50%;"></div>';
        elem += '<div class="codigo col-md-4" id="codigo'+tarjeta.ID+'"></div>';
        elem += '</div>';*/
        elem += '<div class="product-main-image row">';
        for (var j = 1; j <= 16; j++) {
            item = tarjeta["Item" + j].split(";");
            //console.log(item);
            var imgF = item[1];
            elem += '<div class="col-md-3 mt-2 mb-2 item">';
            elem += '<img src="' + imgF + '">';
            elem += '</div>';
        }
        elem += '</div>';
        elem += '</div>';
        elem += '</div>';
        elem += '</a>';
        elem += '</div>';
        elem += '</div>';

        $("#misOtrasCartas").append(elem);
        /*var barc = document.createElement("img");
        barc.setAttribute("id","barc"+i);
        JsBarcode(barc, tarjeta.ID);
        $(document).find("#codigo"+tarjeta.ID).append(barc);*/
        if (i == 0)
            renderTarjetaPrincipal(0);
    }

    $('#misOtrasCartas').slick({
        infinite: false,
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        nextArrow: '<i class="fas fa-chevron-right nextArrowBtn"></i>',
        prevArrow: '<i class="fas fa-chevron-left prevArrowBtn"></i>',
        responsive: [{
                breakpoint: 1440,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 1180,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
}

function validarFrijoles() {
    var url = 'server/api/juego.php';
    jQuery.ajax({
        url: url,
        data: { "opcion": "validarFrijoles", "idGame": idGame },
        type: "POST",
        beforeSend: function() {
            $(".ai-preloader").addClass("active");
        },
        success: function(response) {
            console.log(response)
            revisarGanador(response.data);
        },
        complete: function() {
            $(".ai-preloader").removeClass("active");
            //getParams();
        }
    });
}

var cartonesGanadores = [];

function revisarGanador(data) {
    var idTarjeta, contadorFrijoles, item;
    for (var i in data) {
        item = data[i];
        if (item.contadorFrijoles == 16) {
            if (cartonesGanadores.length > 0) {
                if (!cartonesGanadores.includes(item.idTarjeta)) {
                    cartonesGanadores.push(item.idTarjeta)
                    $(document).find("#" + item.idTarjeta + " .ganador, #main_" + item.idTarjeta + " .ganador").html("<p>¡Completa!</p>");
                    Swal.fire({
                        icon: 'success',
                        title: '¡Felicidades! Has cantado Lotería',
                        html: '<p>Para el pago de tu premio se te contactará por los medios que hayas registrado. Ten a la mano tus datos bancarios, en breve estaremos contigo. Dudas y aclaraciones llama al teléfono <br><span class="tel"> 33 - 38 - 55 - 84 - 24</span></p>'
                    })
                    $("#ganadorAnim").show();
                    setTimeout(function() {
                        $("#ganadorAnim").fadeOut("slow");
                    }, 5000);
                }
            } else {
                cartonesGanadores.push(item.idTarjeta)
                $(document).find("#" + item.idTarjeta + " .ganador, #main_" + item.idTarjeta + " .ganador").html("<p>¡Completa!</p>");
                Swal.fire({
                    icon: 'success',
                    title: '¡Felicidades! Has cantado Lotería',
                    html: '<p>Para el pago de tu premio se te contactará por los medios que hayas registrado. Ten a la mano tus datos bancarios, en breve estaremos contigo. Dudas y aclaraciones llama al teléfono <br><span class="tel"> 33 - 38 - 55 - 84 - 24</span></p>'
                })
                $("#ganadorAnim").show();
                setTimeout(function() {
                    $("#ganadorAnim").fadeOut("slow");
                }, 10000);
            }

        }
        /*else{
        	$(document).find("#"+item.idTarjeta).append("<span>AÚN NO GANA</span>");
        }*/
    }
}

$(document).on("click", ".contenedorCarta a", function() {
    $(".contenedorCarta").removeClass("activo");
    $(this).closest(".contenedorCarta").addClass("activo");
    console.log($(this).data("index"))
    renderTarjetaPrincipal($(this).data("index"));
    getCantadas()
})

function renderTarjetaPrincipal(i) {
    var elem = "";
    var item;
    var tarjeta = tarjetas[i];
    console.log(tarjeta)
    elem = '<div id="main_' + tarjeta.ID + '" class="col-lg-12 col-sm-12 col-md-12 col-6  pl--10 pr--10 mb--10 mainCard">';
    elem += '<div class="ganador"></div>'
    elem += '<div class="row1 contenedorCarta pb-0">';

    //elem += '<a href="#">';
    elem += '<div class="product-thumbnail">';
    elem += '<div class="thumbnail">';
    elem += '<div class="row cabecera">';
    elem += '<div class="logo col-md-8"><img src="img/logo-loteria.png" style="max-width:30%;"></div>';
    elem += '<div class="codigo col-md-4" id="main_codigo' + tarjeta.ID + '"></div>';
    elem += '</div>';
    elem += '<div class="product-main-image row">';
    for (var j = 1; j <= 16; j++) {
        item = tarjeta["Item" + j].split(";");
        //console.log(item);
        var imgF = item[1];
        elem += '<div class="col-md-3 mt-2 mb-2 item" id="carta' + item[2] + '">';
        elem += '<img src="' + imgF + '">';
        elem += '</div>';
    }
    elem += '</div>';
    elem += '</div>';
    elem += '</div>';
    //elem += '</a>';
    elem += '</div>';
    elem += '</div>';
    $(".contenedor-cartas").html(elem);
    var barc = document.createElement("img");
    barc.setAttribute("id", "main_barc" + i);
    JsBarcode(barc, tarjeta.ID);
    $(document).find("#main_codigo" + tarjeta.ID).append(barc);
    $("#miTarjeta").text('Mi tarjeta "' + tarjeta.ID + '"');
}

$("#irTienda").on("click", function() {
    window.location.href = "cartones.html";
})

/*PARA LA CARTAS CANTADAS*/

function getCantadas() {
    var url = 'server/api/juego.php';
    $.ajax({
        url: url,
        data: { "opcion": "cantadas", "idGame": idGame },
        type: "POST",
        beforeSend: function() {
            //$("body").removeClass("loaded");
        },
        success: function(data) {
            //console.log(data)
            $("#cantadasAlert").text("")
            if (data.code == 200) {
                anteriores = data.tarjetas;
                if (inicio)
                    getTarjetas();
                else {
                    renderTarjetasAnteriores()
                }
                validarFrijoles();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Aún no comienza el sorteo, vuelve más tarde"
                });
            }
        },
        complete: function() {

        }
    });
}

function renderTarjetasAnteriores() {
    console.log(anteriores)
    console.log(inicio)
    var elem;
    var carta;
    $("#cartaActual,#anteriores").html("");
    if (!inicio) {
        $('#anteriores').slick('unslick');
        $("#cartaActual,#anteriores").html("");
    }
    inicio = false;
    for (var i in anteriores) {
        carta = anteriores[i];
        console.log(carta.ID)
        elem = '<div class="icon img-carta">';
        elem += '<img src="' + carta.URL_image + '" alt="icon box">';
        elem += '</div>';

        /*if(i == 0)
        	$("#cartaActual").append(elem)
        else*/
        $("#anteriores").append(elem);
        if ($(document).find("#carta" + carta.ID).has("img.frijolito").length <= 0)
            $(document).find("#carta" + carta.ID).append("<img src='img/frijol.png' class='frijolito' />");
        console.log($(document).find("#carta" + carta.ID))
    }

    $('#anteriores').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4,
        dots: true,
        arrows: true,
        nextArrow: '<i class="fas fa-chevron-right nextArrowBtn"></i>',
        prevArrow: '<i class="fas fa-chevron-left prevArrowBtn"></i>'
    });
    $("body").addClass("loaded");


}


/*cargar iframe del juego*/
function getGameInfo() {
    var url = 'server/api/juego.php';
    $.ajax({
        url: url,
        data: { "opcion": "gameInfo", "idGame": idGame },
        type: "POST",
        beforeSend: function() {
            //$("body").removeClass("loaded");
        },
        success: function(response) {
            console.log(response)
            renderIframe(response.data)
            $("#nombrePartida").text("Partida: " + response.data.Game_name);
            var str = response.data.Game_date.split(" ");
            var anio = str[0];
            var hora = str[1];
            var anioS = anio.split("-");
            var horaS = hora.split(":");
            $("#fechaHora").text(anioS[1] + "/" + anioS[2] + "/" + anioS[0] + "  --  " + horaS[0] + ":" + horaS[1]);
        },
        complete: function() {

        }
    });
}

function renderIframe(data) {
    if (data.Transmission_iframe) {
        var str = data.Transmission_iframe;
        //$(document).find("#transmisionIframe").data("href", str);
        //document.getElementById("transmisionIframe").setAttribute("data-href", str);
        $("#transmisionIframe").html(str);
        /*item = '<div class="fb-video" data-href="' + str + '" data-autoplay="true" data-width="500" data-show-text="false" data-allowfullscreen="true" id=""> <div class = "fb-xfbml-parse-ignore"><!--blockquote cite="https://fb.watch/dH2sxyjUJM/"> <a href = "https://fb.watch/dH2sxyjUJM/"> How to Share With Just Friends </a> <p> How to share with just friends. </p>Posted by < a href = "https://www.facebook.com/facebook/"> Facebook < /a> on Friday, December 5, 2014 </blockquote--> </div > </div > ';
        $(document).find("#transmisionIframe").append(item);*/
        /*var iframe;
        if (str.includes("?v=")) {
            iframe = str.split("?v=");
            iframe = iframe[1];
        } else {
            //https://www.facebook.com/TeleamazonasEcuador/videos/282952266332318/
            var parts = str.split("/");
            console.log(parts)
            var iframe = parts[parts.length - 2]; // Or parts.pop();
        }
        console.log(iframe)
        $("#transmisionIframe").attr("src", "https://www.facebook.com/video/embed?video_id=dG-fq64WQ9" + iframe);
    }*/
        /*else{
        		Swal.fire({
        		  icon: 'error',
        		  title: 'Oops...',
        		  text: "No hay transmisión del juego en estos momentos"
        		});
        	}*/

    }
}