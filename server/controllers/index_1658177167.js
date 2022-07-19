//getSorteos();
let sorteos;
let index = 0;
let urlComprar;

document.addEventListener("DOMContentLoaded", load, false);

function getSorteos() {
  fetch("server/api/sorteos.php")
    .then(function (response) {
      return response.json();
    })
    .then(function (myJson) {
      if (myJson.code == 200) {
        sorteos = myJson.data;
        renderSorteos();
        console.log("Toal: " + sorteos.length);
        //renderSorteos(myJson.data);
      }
      /* else
	    	alert(myJson.msg);*/
    });
}

function renderSorteos() {
  //for( i in sorteos){
  let sorteo = sorteos[index];
  console.log(sorteo);
  console.log(sorteo.Game_name);
  jQuery("#titulo p").text(sorteo.Game_name);
  jQuery("#fechaJuego span").text(sorteo.Game_date);
  jQuery("#precio span").text("$" + sorteo.Card_price + ".00");
  let premioCompleto = sorteo.Contador * sorteo.Card_price * 0.5;
  let premioLinea = sorteo.Contador * sorteo.Card_price * 0.05;
  jQuery("#premioCompleta span").text("$" + premioCompleto + ".00");
  jQuery("#premioLinea span").text("$" + premioLinea + ".00");
  urlComprar = "tienda.php?game=" + sorteo.ID;
}

function load() {
  getSorteos();
  /*let btnAnterior = document.getElementById("slide-16-layer-8");
	let btnSiguiente = document.getElementById("slide-16-layer-77");

	btnAnterior.addEventListener("click",anterior,false);
	btnSiguiente.addEventListener("click",siguiente,false);*/

  sesion();
  update_bag();

  getTransmision();
}

function anterior() {
  if (index > 0) {
    index--;
    console.log("anterior, index: " + index);
    renderSorteos();
  }
}

function siguiente() {
  if (index + 1 < sorteos.length) {
    index++;
    console.log("siguiente, index: " + index);
    renderSorteos();
  }
}

function sesion() {
  var url = "server/api/login.php";
  jQuery.ajax({
    url: url,
    data: { opcion: "sesion" },
    type: "POST",
    beforeSend: function () {
      jQuery("body").removeClass("loaded");
    },
    success: function (data) {
      if (data.code == 200) {
        console.log(data);
        //let usuario = data.data[0].First_name != null ? data.data[0].First_name+", "+data.data[0].email : data.data[0].email
        let usuario =
          data.data[0].First_name != null ? data.data[0].First_name : "";
        //usuario += data.data[0].Last_name != null ? " "+data.data[0].Last_name : "";
        jQuery("#usuario p").html(
          "<strong>HOLA  </strong><strong>" + usuario + "</strong>"
        );
        jQuery("#usuario").show();
        jQuery("#iniciarSesion,.contenedor-login,#registrarse").hide();
      }
    },
    complete: function () {
      jQuery("body").addClass("loaded");
      //getParams();
    },
  });
}

jQuery(document).on("click", "#usuario p", function () {
  window.location.href = "mi-cuenta.php";
});

function login() {
  var url = "server/api/login.php";
  var formD = new FormData(document.getElementById("login_form"));
  formD.append("opcion", "login");
  jQuery.ajax({
    url: url,
    data: formD,
    cache: false,
    contentType: false,
    processData: false,
    type: "POST",
    beforeSend: function () {
      jQuery("body").removeClass("loaded");
    },
    success: function (data) {
      if (data.code == 200) {
        var params = GET(window.location.href);
        /*console.log(params2)
	  		var params = params2.replace("#","");*/
        console.log(params);
        if (params) {
          if (params.r) {
            if (params.r.replace("#", "") == "chk") {
              window.location.href = "checkout.php";
            } else if (params.r.replace("#", "") == "acc") {
              window.location.href = "mis-cartones.php";
            } else if (params.r.replace("#", "") == "cant") {
              window.location.href = "cantadas.php";
            } else if (params.r.replace("#", "") == "game") {
              window.location.href =
                "juego.php?g=" + params.id.replace("#", "");
            }
          } else {
            location.reload();
          }
        } else {
          window.location.href = "index.html";
        }
      } else
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: data.msg,
        });
    },
    complete: function () {
      jQuery("body").addClass("loaded");
      //getParams();
    },
  });
}

jQuery("#login_form").on("submit", function () {
  login();
});

jQuery("#salir").on("click", function () {
  var url = "server/api/login.php";
  jQuery.ajax({
    url: url,
    data: { opcion: "salir" },
    type: "POST",
    beforeSend: function () {
      jQuery("body").removeClass("loaded");
    },
    success: function (data) {
      if (data.code == 200) {
        jQuery("#usuario p").text("");
        jQuery("#usuario").hide();
        jQuery("#iniciarSesion,.contenedor-login,#registrarse").show();
        window.location.href = "index.html";
      } else
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: data.msg,
        });
    },
    complete: function () {
      jQuery("body").addClass("loaded");
      //getParams();
    },
  });
});

jQuery("#comprarTarjetas").on("click", function () {
  window.location.href = urlComprar;
});

jQuery("#iniciarSesion").on("click", function () {
  jQuery("#enviar_login").click();
});

jQuery("#registrarse").on("click", function () {
  window.location.href = "registro.php";
});

jQuery("#minicart-trigger,.mini-cart").on("click", function (e) {
  jQuery(".shopping-cart .cart-box .show").hide();
  e.preventDefault();
  window.location.href = "carrito.html";
});

function update_bag() {
  var url = "server/api/carrito.php";
  jQuery.ajax({
    url: url,
    data: { opcion: "cart_bag" },
    type: "POST",
    beforeSend: function () {
      jQuery("body").removeClass("loaded");
    },
    success: function (data) {
      console.log(data);
      if (data.code == 200) {
        jQuery("#minicart-trigger").attr("data-count", data.qty);
        //$(".header-default .header-right .mini-cart-button::after").css("content",data.qty);
        console.log(jQuery("#minicart-trigger").data("count"));
      } else {
        jQuery("#minicart-trigger").attr("data-count", 0);
      }
    },
    complete: function () {
      jQuery("body").addClass("loaded");
    },
  });
}

jQuery("#recuperarPass").on("click", function (e) {
  e.preventDefault();
  if (jQuery("#login-form-email").val() == "") {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Debes ingresar tu correo",
    });
  } else {
    recuperar(jQuery("#login-form-email").val());
  }
});

function recuperar(correo) {
  var url = "server/api/login.php";
  jQuery.ajax({
    url: url,
    data: { opcion: "recuperar", email: correo },
    type: "POST",
    beforeSend: function () {
      jQuery("body").removeClass("loaded");
    },
    success: function (data) {
      if (data.code == 200) {
        Swal.fire({
          icon: "success",
          title: "Éxito",
          text: "Tu contraseña ha sido enviada a tu correo.",
        });
      } else
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: data.msg,
        });
    },
    complete: function () {
      jQuery("body").addClass("loaded");
      //getParams();
    },
  });
}

function getTransmision() {
  var url = "server/api/cartones.php";
  jQuery.ajax({
    url: url,
    type: "GET",
    beforeSend: function () {
      jQuery("body").removeClass("loaded");
    },
    success: function (response) {
      console.log(response);
      if (response.hoy.code == 400)
        jQuery("#transmision").addClass("sinTransmision");
      else
        jQuery("#transmision a").attr(
          "href",
          "juego.php?g=" + response.hoy.data[0].ID
        );
    },
    complete: function () {
      jQuery("body").addClass("loaded");
      //getParams();
    },
  });
}
