let tarjetas;
let infoGame;

let perPage = 12;
let totalTarjetas;

let paginador = [];
let idGame, opcionCarta;

$(document).ready(function () {
  var params = GET(window.location.href);
  if (params) {
    if (params.game) {
      idGame = params.game.replace("#", "");
      if (params.op) {
        opcionCarta = params.op.replace("#", "");
        if (opcionCarta == "suerte") getSuerte(idGame);
        else if (opcionCarta == "elegir") getTarjetas(idGame);
        else window.location.href = "crear-cartas.html?game=" + idGame;
      }
    }
  }
});

function getTarjetas(idGame) {
  var url = "server/api/catalogo.php";
  $.ajax({
    url: url,
    data: { opcion: "getTarjetas", game: idGame },
    type: "POST",
    beforeSend: function () {
      $("body").removeClass("loaded");
    },
    success: function (response) {
      console.log(response);
      if (response.code == 200) {
        tarjetas = response.data;
        totalTarjetas = response.totalTarjetas.Total;
        console.log("Toal: " + totalTarjetas);
        infoGame = response.infoGame[0];
        renderTarjetas(false);
        paginacion();
      } else
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: response.msg,
        });
    },
    complete: function () {
      $("body").addClass("loaded");
      //getParams();
    },
  });
}

function getSuerte(idGame) {
  var url = "server/api/catalogo.php";
  $.ajax({
    url: url,
    data: { opcion: "getSuerte", game: idGame },
    type: "POST",
    beforeSend: function () {
      $("body").removeClass("loaded");
      $("#preloader").show();
    },
    success: function (response) {
      console.log(response);
      if (response.code == 200) {
        tarjetas = response.data;
        /*totalTarjetas = response.totalTarjetas.Total;
			console.log("Toal: "+totalTarjetas)*/
        infoGame = response.infoGame[0];
        renderTarjetas(true);
        //paginacion()
      } else
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: response.msg,
        });
    },
    complete: function () {
      $("body").addClass("loaded");
      $("#preloader").hide();
    },
  });
}

function renderTarjetas(generarOtra) {
  var elem = "";
  var item = "";
  let url = "../Elotto/assets/images/game_cards/";
  $(".row--25").html("");
  for (var i in tarjetas) {
    var tarjeta = tarjetas[i];
    elem =
      '<div class="col-lg-3 col-md-6 col-sm-6 col-12 producto" id="tarjeta_' +
      tarjeta.ID +
      '">';

    elem += '<div class="product mt--10">';

    elem += '<div class="product-thumbnail">';
    elem += '<div class="thumbnail">';
    elem += '<div class="row cabecera">';
    elem +=
      '<div class="logo col-md-8 col-6"><img src="img/logo-loteria.png" style=""></div>';
    elem +=
      '<div class="codigo col-md-4 col-6" id="codigo' + tarjeta.ID + '"></div>';
    elem += "</div>";
    elem += '<div class="product-main-image row">';

    for (var j = 1; j <= 16; j++) {
      item = tarjeta["Item" + j].split(";");
      //console.log(item);
      var imgF = item[1];
      elem += '<div class="col-md-3 col-3 mt-2 mb-2 item">';
      elem += '<img src="' + imgF + '">';
      elem += "</div>";
    }
    elem += "</div>";
    elem += "</div>";
    elem += '<div class="product-action">';
    /*elem += '<ul class="action-list text-center tooltip-layout">';
		elem += '<li class="single-action addto-cart"><a href="#" class="link hint--bounce hint--top hint--dark" aria-label="Añadir al carrito"><i class="fas fa-shopping-bag"></i></a></li>';

		//elem += '<li class="single-action wishlist"><a href="wishlist.html" class="link hint--bounce hint--top hint--dark" aria-label="Add to Wishlist"><i class="far fa-heart"></i></a></li>';
		elem += '</ul>';*/
    elem += "</div>";
    elem += "</div>";
    elem += '<div class="product-info">';
    elem +=
      '<h5 class="heading heading-h5"><a href="#">' +
      infoGame.Game_name +
      " - Cartón (" +
      tarjeta.ID +
      ")</a></h5>";
    elem +=
      '<div class="price"><span>$' + infoGame.Card_price + ".00</span></div>";
    elem +=
      '<div><button class="btn btn-comprar addto-cart">Agregar al carrito</button></div>';
    elem += "</div>";
    elem += "</div>";
    elem += "</div>";
    $(".row--25").append(elem);
    var barc = document.createElement("img");
    barc.setAttribute("id", "barc" + i);
    JsBarcode(barc, tarjeta.ID);
    //console.log(barc);
    $(document)
      .find("#codigo" + tarjeta.ID)
      .append(barc);
  }
  if (generarOtra) {
    elem = '<div id="generarOtra" class="col-lg-3 col-md-6 col-sm-6 col-12">';
    elem +=
      '<button class="btn btn-seguir seguir1">Generar otro cartón</button>';
    elem += "</div>";
    $(".row--25").append(elem);
  }
  //Supermegalotería - Tarjeta (52275)
}

function renderTarjetas_old() {
  var elem = "";
  var item = "";
  let url = "../Elotto/assets/images/game_cards/";
  $(".row--25").html("");
  for (var i in tarjetas) {
    var tarjeta = tarjetas[i];
    elem =
      '<div class="col-lg-4 col-md-6 col-sm-6 col-12 producto" id="tarjeta_' +
      tarjeta.ID +
      '">';
    elem += '<div class="product mt--10">';

    elem += '<div class="product-thumbnail">';
    elem += '<div class="thumbnail">';
    elem += '<div class="row cabecera">';
    elem +=
      '<div class="logo col-md-8 col-6"><img src="http://integrattodev.cloudapp.net/Elotto/assets/images/elotto/logo.jpg" style="max-width:50%;"></div>';
    elem +=
      '<div class="codigo col-md-4 col-6" id="codigo' + tarjeta.ID + '"></div>';
    elem += "</div>";
    elem += '<div class="product-main-image row">';

    for (var j = 1; j <= 16; j++) {
      item = tarjeta["Item" + j].split(";");
      //console.log(item);
      var imgF = item[1];
      elem += '<div class="col-md-3 col-3 mt-2 mb-2 item">';
      elem += '<img src="' + imgF + '">';
      elem += "</div>";
    }
    elem += "</div>";
    elem += "</div>";
    elem += '<div class="product-action">';
    elem += '<ul class="action-list text-center tooltip-layout">';
    elem +=
      '<li class="single-action addto-cart"><a href="#" class="link hint--bounce hint--top hint--dark" aria-label="Añadir al carrito"><i class="fas fa-shopping-bag"></i></a></li>';

    //elem += '<li class="single-action wishlist"><a href="wishlist.html" class="link hint--bounce hint--top hint--dark" aria-label="Add to Wishlist"><i class="far fa-heart"></i></a></li>';
    elem += "</ul>";
    elem += "</div>";
    elem += "</div>";
    elem += '<div class="product-info">';
    elem +=
      '<h5 class="heading heading-h5"><a href="#">' +
      infoGame.Game_name +
      " - Tarjeta (" +
      tarjeta.ID +
      ")</a></h5>";
    elem +=
      '<div class="price"><span>$' + infoGame.Card_price + ".00</span></div>";
    elem += "</div>";
    elem += "</div>";
    elem += "</div>";
    $(".row--25").append(elem);
    var barc = document.createElement("img");
    barc.setAttribute("id", "barc" + i);
    JsBarcode(barc, tarjeta.ID);
    //console.log(barc);
    $(document)
      .find("#codigo" + tarjeta.ID)
      .append(barc);
  }
}

$("#press").on("click", function () {
  var w = $("#temporal").width();
  var h = $("#temporal").height();

  html2canvas(document.getElementById("item0"), {
    allowTaint: true,
    useCORS: true,
    logging: true,
  }).then((canvas) => {
    /*document.body.appendChild(canvas)
	    var myImage = canvas.toDataURL("image/png");
	    downloadURI("data:" + myImage, "yourImage.png");*/
    var img = canvas
      .toDataURL("image/png")
      .replace("image/png", "image/octet-stream"); //o por 'image/jpeg'
    //display 64bit imag
    $("body").append('<img src="' + img + '"/>');
  });
});

$(document).on("click", ".addto-cart", function (e) {
  e.preventDefault();
  let idF = $(this).closest(".producto").attr("id").split("_");
  let id = idF[1];
  add_to_cart(id, 1, idGame);
});

function add_to_cart(id, qty, idGame) {
  var url = "server/api/carrito.php";
  $.ajax({
    url: url,
    data: { opcion: "add", idTarjeta: id, cantidad: qty, idGame: idGame },
    type: "POST",
    beforeSend: function () {
      $("body").removeClass("loaded");
    },
    success: function (data) {
      console.log(data);
      if (data.code == 200) {
        update_bag();
        Swal.fire({
          html:
            '<div id="agregado"><h3>Producto agregado al carrito!</h3><p>Cartón (' +
            id +
            ")</p></div>",
          showCancelButton: true,
          cancelButtonText: "Seguir comprando",
          confirmButtonColor: "#e97f2b",
          cancelButtonColor: "#1B1A18",
          confirmButtonText: "Ir al carrito",
        }).then((result) => {
          console.log(result);
          if (result.value) {
            window.location.href = "carrito.html";
          }
        });
        /*Swal.fire({
		  		  html:'<div id="agregado"><h3>Producto agregado al carrito!</h3><p>Cartón ('+id+')</p></div>',
		  		  timer: 5000
		  		})*/
      } else
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: data.msg,
        });
    },
    complete: function () {
      $("body").addClass("loaded");
      //getParams();
    },
  });
}

let paginaActual = 1;

function paginacion(get) {
  for (var i = 1; i <= totalTarjetas; i++) {
    paginador.push(i);
  }
  console.log(paginador);
  $("#paginador").pagination({
    dataSource: paginador,
    pageSize: 12,
    callback: function (data, pagination) {
      // template method of yourself
      /*var html = template(data);
	        dataContainer.html(html);*/
      console.log(data);
      console.log(pagination);
      let page = pagination.pageNumber;
      let inicio = (page - 1) * perPage;
      let fin = page * perPage;
      //if(page > 1){
      var url = "server/api/catalogo.php";
      $.ajax({
        url: url,
        data: {
          game: idGame,
          inicio: inicio,
          final: perPage,
          opcion: "getTarjetas",
        },
        type: "POST",
        beforeSend: function () {
          $("body").removeClass("loaded");
        },
        success: function (data) {
          console.log(data);
          tarjetas = data.data;
          totalTarjetas = data.totalTarjetas.Total;
          console.log("Toal: " + totalTarjetas);
          infoGame = data.infoGame[0];
          $(".bk_pra").text(
            "Mostrando " +
              (inicio + 1) +
              " - " +
              (fin < totalTarjetas ? fin : totalTarjetas) +
              " de " +
              totalTarjetas +
              " tarjetas"
          );
          renderTarjetas(false);
        },
        complete: function () {
          $("body").addClass("loaded");
          //getParams();
        },
      });
      //}
    },
  });
}

$("#elegirJuego").on("change", function () {
  if ($(this).val()) {
    idGame = $(this).val();
    getTarjetas(idGame);
  }
});

$(document).on("click", "#generarOtra button", function () {
  location.reload();
});
