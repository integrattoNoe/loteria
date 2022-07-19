vacias();
getCartas();
getSorteos_crearCarta();
function vacias(){
	var elem;
	for(var i = 0; i < 16; i++){
		elem = '<div class="casilla contenedor-cartas01 col-lg-3 col-md-3 col-sm-3 col-3 p-0">';
		elem += '<div class="col-lg-12 col-md-12 col-sm-12 col-12 ">';
		elem += '<div class="inner">';
		elem += '<div class="icon contenedor-carta01">';
		elem += '</div>';
		elem += '</div>';
		elem += '</div>';
		elem += '</div>';
		$("#vacias").append(elem);
	}
}

function getCartas(){
	var url = 'server/api/crearCarta.php';
	$.ajax({
	  url:url,
	  data:{"opcion":"getCartas"},
	  type:"POST",
	  beforeSend:function(){
	    //$("body").removeClass("loaded");
	  },
	  success:function(response){
	  	console.log(response)
	  	if(response.code == 200){
	  		renderCartas(response.data);
	  		
	  	}else{
	  		$("#cantadasAlert").text(response.msg)
	  	}
	  },
	  complete:function(){
	    
	  }
	});
}

function renderCartas(cartas){
	var elem;
	var carta;
	for(var i in cartas){
		carta = cartas[i];
		elem = '<div class="carta-container contenedor-cartas01 carta" data-id="'+carta.ID+'">';
		elem += '<div class="col-lg-12 col-md-12 col-sm-12 col-12 ">';
		elem += '<div class="inner">';
		elem += '<div class="icon contenedor-carta01">';
		elem += '<img class="img-carta01" src="'+carta.URL_image+'" alt="icon box">'
		//elem += '<span class="no-carta01">02</span>';
		//elem += '<p class="titulo-carta01 text-center" href="#"><b>LA MANO</b></p>';
		elem += '<div class="overlay-white"></div>';
		elem += '</div>';
		elem += '</div>';
		elem += '</div>';
		elem += '</div>';
		$("#cartas").append(elem);
	}
	
}

var casillaActiva;
var cartaActiva;

var indexCasilla,indexCarta;

var casilla,carta;

var casillaOcupada;

var contadorCartas = 0;

var arrayCartas = [];
var arrayCartasOrdenado = [];

var checksum = "";

$(document).on("click",".casilla .icon",function(){
	
	if($(this).hasClass("casillaActiva")){
		$(".casilla .icon").removeClass("casillaActiva");
		//console.log("ya la tiene")
		casillaActiva = false;
		indexCasilla = false;
		casilla = false;
	}
	else{
		$(".casilla .icon").removeClass("casillaActiva");
		$(this).addClass("casillaActiva")
		//console.log("no la tiene")
		casillaActiva = true;
		indexCasilla = $(".casilla .icon").index($(this));
		//console.log(indexCasilla)
		casilla = $(this);
	}

	if(casillaActiva && carta){
		if($(casilla).hasClass("ocupada")){
			//console.log("Hay que liberar la carta: "+$(casilla).data("cartaindex"));
			var elem = $(".carta .icon").eq($(casilla).data("cartaindex"));
			//console.log(elem)
			$(elem).removeClass("usada")
			contadorCartas--;
		}
		//console.log("hay que agregar la imagen: "+$(carta).find(".img-carta01").attr("src"));
		$(casilla).html('<img src="'+$(carta).find(".img-carta01").attr("src")+'">');
		$(carta).addClass("usada");
		$(casilla).addClass("ocupada");
		$(casilla).data("cartaindex",indexCarta);
		$(casilla).data("idcarta",$(carta).closest(".carta").data("id"));

		contadorCartas++;
		limpiar();
	}
})

$(document).on("click",".carta .icon",function(){
	
	$(".carta").addClass("cartasInactivas");
	if($(this).hasClass("cartaActiva")){
		$(".carta .icon").removeClass("cartaActiva");
		//console.log("ya la tiene")
		$(".carta").removeClass("cartasInactivas");
		indexCarta = false;
		carta = false;
	}
	else{
		$(".carta .icon").removeClass("cartaActiva");
		$(this).addClass("cartaActiva")
		$(this).closest(".carta").removeClass("cartasInactivas");
		//console.log("no la tiene")
		indexCarta = $(".carta .icon").index($(this));
		//console.log(indexCarta)
		carta = $(this);
		cartaActiva = true;
	}

	if(casillaActiva && carta){
		if($(casilla).hasClass("ocupada")){
			console.log("Hay que liberar la carta: "+$(casilla).data("cartaindex"));
			var elem = $(".carta .icon").eq($(casilla).data("cartaindex"));
			//console.log(elem)
			$(elem).removeClass("usada")
			contadorCartas--;
		}
		contadorCartas++;
		//console.log("hay que agregar la imagen: "+$(carta).find(".img-carta01").attr("src"));
		$(casilla).html('<img src="'+$(carta).find(".img-carta01").attr("src")+'">');
		$(carta).addClass("usada");
		$(casilla).addClass("ocupada");
		$(casilla).data("cartaindex",indexCarta);
		$(casilla).data("idcarta",$(carta).closest(".carta").data("id"));
		console.log($(carta).data("id"))
		limpiar();
	}
	
	
})

function limpiar(){
	
	$(".carta .icon").removeClass("cartaActiva");
	$(".casilla .icon").removeClass("casillaActiva");
	$(".carta").removeClass("cartasInactivas");
	casillaActiva = false;
	indexCasilla = false;
	casilla = false;
	indexCarta = false;
	carta = false;
	if(contadorCartas >= 16){
		$("#continuar").removeClass("deshabilitado")
		
	}
}

var idGame;

$("#continuar").on("click",function(){
	checksum = "";
	arrayCartas = [];
	$(".casilla .icon").each(function(){
		console.log($(this).data("idcarta"))
		arrayCartas.push($(this).data("idcarta"));

	})
	arrayCartasOrdenado = arrayCartas;
	arrayCartasOrdenado.sort();
	console.log(arrayCartasOrdenado)
	
	for(var i in arrayCartasOrdenado){
		checksum += ""+arrayCartas[i];
	}
	console.log(checksum)
	var params = GET(window.location.href)
	if(params){
		if(params.game){
			idGame = params.game.replace("#","");
		}
	}
	if(idGame != ""){
		validarTarjeta();
	}
	//$("#modalElegirJuego").modal("show");
	
})

var sorteos_crearCarta;

function getSorteos_crearCarta(){
	fetch('server/api/sorteos.php')
	  .then(function(response) {
	    return response.json();
	  })
	  .then(function(myJson) {
	  	if(myJson.code == 200){
	  		sorteos_crearCarta = myJson.data
	  		renderSorteos_crearCarta();

	    	//renderSorteos(myJson.data);
	    }
	    /*else
	    	alert(myJson.msg);*/
	  });
}

function renderSorteos_crearCarta(){
	for(var i in sorteos_crearCarta){
		let sorteo = sorteos_crearCarta[i];
		var elem = "<option value='"+sorteo.ID+"'>"+sorteo.Game_name+"</option>";
		$("#elegirJuego").append(elem);
	}

}



$("#continuar2").on("click",function(){
	
})

function validarTarjeta(){
	var url = 'server/api/crearCarta.php';
	$.ajax({
	  url:url,
	  type:"POST",
	  data:{"idG":idGame,"checksum":checksum,"items":arrayCartas,"opcion":"validar","cantidad":1},
	  beforeSend:function(){
	    $("body").removeClass("loaded");
	  },
	  success:function(response){
	  	console.log(response)
	  	if(response.code == 200){
	  		/*Swal.fire({
	  		  icon: 'success',
	  		  title: 'Éxito',
	  		  text: "Tu tarjeta ha sido creada, revisa tu carrito para continuar tu compra",

	  		});*/
	  		Swal.fire({
	  		  title: 'Éxito',
	  		  text: "Tu tarjeta ha sido creada, revisa tu carrito para continuar tu compra",
	  		  icon: 'success',
	  		  showCancelButton: true,
	  		  cancelButtonText: 'Seguir comprando',
	  		  confirmButtonColor: '#e97f2b',
	  		  cancelButtonColor: '#1B1A18',
	  		  confirmButtonText: 'Ir al carrito'
	  		}).then((result) => {
	  		  if (result.value) {
	  		    window.location.href = "carrito.html";
	  		  }
	  		  if(result.dismiss)
	  		  	location.reload()
	  		})

	  		update_bag();
	  		
	  	}else{
	  		Swal.fire({
	  		  icon: 'error',
	  		  title: 'Oops...',
	  		  text: response.msg
	  		});
	  	}
	  	$("#nuevo").show();
	  },
	  complete:function(){
	    $("body").addClass("loaded");
	  }
	});
}

$("#nuevo").on("click",function(){
	location.reload();
})