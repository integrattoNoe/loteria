$("#register-form-telefono").keypress(function (event) {
  console.log(event.which);
  if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
    event.preventDefault(); //stop character from entering input
  }
});

$("#formLogin").on("submit", function () {
  var formD = new FormData(document.getElementById("formLogin"));
  formD.append("opcion", "login");
  iniciar(formD);
});

$("#formRegistro").on("submit", function () {
  var formD = new FormData(document.getElementById("formRegistro"));
  formD.append("opcion", "registro");
  registrar(formD);
});

$("#recuperarPass").on("click", function (e) {
  e.preventDefault();
  if ($("#login-form-email").val() == "") {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Debes ingresar tu correo",
    });
  } else {
    recuperar($("#login-form-email").val());
  }
});

function iniciar(datos) {
  var url = "server/api/login.php";
  $.ajax({
    url: url,
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    type: "POST",
    beforeSend: function () {
      $(".ai-preloader").addClass("active");
    },
    success: function (data) {
      if (data.code == 200) {
        var params = GET(window.location.href);
        /*console.log(params2)
	  		var params = params2.replace("#","");*/
        console.log(params);
        if (params) {
          if (params.r.replace("#", "") == "chk") {
            window.location.href = "checkout.php";
          } else if (params.r.replace("#", "") == "acc") {
            window.location.href = "mis-cartones.php";
          } else if (params.r.replace("#", "") == "cant") {
            window.location.href = "cantadas.php";
          } else if (params.r.replace("#", "") == "game") {
            window.location.href = "juego.php?g=" + params.id.replace("#", "");
          } else if (params.r.replace("#", "") == "cartones") {
            window.location.href = "mis-cartones.php";
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
      $(".ai-preloader").removeClass("active");
      //getParams();
    },
  });
}

function registrar(datos) {
  var url = "server/api/login.php";
  $.ajax({
    url: url,
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    type: "POST",
    beforeSend: function () {
      $(".ai-preloader").addClass("active");
    },
    success: function (data) {
      if (data.code == 200) {
        var params = GET(window.location.href);
        /*console.log(params2)
	  		var params = params2.replace("#","");*/
        console.log(params);
        if (params) {
          if (params.r.replace("#", "") == "chk") {
            window.location.href = "checkout.php";
          } else if (params.r.replace("#", "") == "acc") {
            window.location.href = "mis-cartones.php";
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
      $(".ai-preloader").removeClass("active");
      //getParams();
    },
  });
}

function recuperar(correo) {
  var url = "server/api/login.php";
  $.ajax({
    url: url,
    data: { opcion: "recuperar", email: correo },
    type: "POST",
    beforeSend: function () {
      $(".ai-preloader").addClass("active");
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
      $(".ai-preloader").removeClass("active");
      //getParams();
    },
  });
}
