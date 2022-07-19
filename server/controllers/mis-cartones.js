$(document).ready(function () {
  getTarjetas();
});

function getTarjetas() {
  var url = "server/api/usuario.php";
  $.ajax({
    url: url,
    data: { opcion: "getTarjetas" },
    type: "POST",
    beforeSend: function () {
      $("body").removeClass("loaded");
    },
    success: function (data) {
      console.log(data);
      if (data.code == 200) {
        $(".cart-table tbody").html("");
        //$("#subTotal, #total").text("$"+data.subtotal);
        /*if(data.algunoInvalido){
	  			Swal.fire({
	  			  icon: 'error',
	  			  title: 'Oops...',
	  			  text: 'Hay tarjetas invalidas en tu carrito'
	  			});
	  			$("#btnCheckout").hide()
	  		}else{
	  			$("#btnCheckout").show()
	  		}*/
        renderTarjetas(data.tarjetas);
      } else {
        var elem = "<h3>" + data.msg + "</h3>";
        elem +=
          '<p><button class="brook-btn bk-btn-theme btn-sd-size btn-rounded space-between" id="irTienda">Conseguir tarjetas</button></p>';
        $(".cart_area > .container").html(elem);
      }
    },
    complete: function () {
      $("body").addClass("loaded");
      //getParams();
    },
  });
}

function renderTarjetas(carrito) {
  var elem = "";
  var item;
  var sorteo = "";
  var tarjeta;
  /*primero hacemos los acordeones*/
  var idAcordeon, idAcordeonAnterior;
  var contador = 1;

  for (var i in carrito) {
    tarjeta = carrito[i];
    idAcordeon = tarjeta.Game_name;
    var id = idAcordeon.replace(/ /g, "-");
    elem = '<div class="panel panel-default">';
    elem += '<div class="panel-heading">';
    elem += '<h5 class="panel-title">';
    elem += "<span>*</span>";
    elem +=
      '<a data-toggle="collapse" data-parent="#faq" href="#' +
      id +
      '">' +
      tarjeta.Game_name +
      "</a>";
    elem += "</h5>";
    elem += "</div>";
    elem += '<div id="' + id + '" class="panel-collapse collapse">';
    elem += '<div class="panel-body">';

    elem += '<div class="">';
    elem += '<div class="cart-table table-responsive mb--40">';
    elem += '<table class="table">';
    elem += "<thead>";
    elem += "<tr>";
    elem += '<th class="pro-thumbnail">Imagen</th>';
    elem += '<th class="pro-title">Tarjeta</th>';
    elem += '<th class="pro-title">Precio</th>';
    elem += '<th class="pro-title">Fecha de compra</th>';
    elem += '<th class="pro-title">Status</th>';
    elem += "</tr>";
    elem += "</thead>";
    elem += "<tbody>";
    elem += "</tbody>";
    elem += "</table>";
    elem += "</div>";
    elem += "</div>";

    elem += "</div>";
    elem += "</div>";
    elem += "</div>";
    console.log($(document).find("#" + id).length);
    if ($(document).find("#" + id).length == 0) {
      if (idAcordeonAnterior != idAcordeon) {
        contador++;
        $("#contenedorAcordeones").append(elem);
      }
    }
    idAcordeonAnterior = idAcordeon;
  }

  for (var i in carrito) {
    tarjeta = carrito[i];
    var id = tarjeta.Game_name.replace(/ /g, "-");
    elem = '<tr id="' + tarjeta.ID + '">';
    elem += '<td class="pro-thumbnail">';
    elem += '<a href="#">';
    elem += '<div class="product-thumbnail">';
    elem += '<div class="thumbnail">';
    elem += '<div class="row cabecera">';
    elem +=
      '<div class="logo col-md-8"><img src="http://integrattodev.cloudapp.net/Elotto/assets/images/elotto/logo.jpg" style="max-width:50%;"></div>';
    elem += '<div class="codigo col-md-4" id="codigo' + tarjeta.ID + '"></div>';
    elem += "</div>";
    elem += '<div class="product-main-image row">';
    for (var j = 1; j <= 16; j++) {
      item = tarjeta["Item" + j].split(";");
      //console.log(item);
      var imgF = item[1];
      elem += '<div class="col-md-3 mt-2 mb-2 item">';
      elem += '<img src="' + imgF + '">';
      elem += "</div>";
    }
    elem += "</div>";
    elem += "</div>";
    elem += "</div>";
    elem += "</a>";
    elem += "</td>";

    elem +=
      '<td class="pro-title"><a href="#">' +
      tarjeta.Game_name +
      " - Tarjeta (" +
      tarjeta.ID +
      ")</a></td>";
    elem +=
      '<td class="pro-price"><span>$' + tarjeta.Card_price + ".00</span></td>";
    elem +=
      '<td class="pro-price"><span>' + tarjeta.fechaCompra + "</span></td>";
    elem +=
      '<td class="pro-price"><span>' + tarjeta.GameCardStatus + "</span></td>";
    /*elem += '<td class="pro-quantity"><div class="pro-qty"><input type="text" value="1" disabled></div></td>';
		elem += '<td class="pro-subtotal"><span>$'+tarjeta.Card_price+'.00</span></td>';
		elem += '<td class="pro-remove"><a href="#"><i class="ion ion-android-close"></i></a></td>'*/
    elem += "</tr>";

    //$(".cart-table tbody").append(elem);
    $("#" + id)
      .find(".cart-table tbody")
      .append(elem);
    var barc = document.createElement("img");
    barc.setAttribute("id", "barc" + i);
    JsBarcode(barc, tarjeta.ID);
    $(document)
      .find("#codigo" + tarjeta.ID)
      .append(barc);
  }
}