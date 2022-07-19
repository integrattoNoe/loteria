var meses = {
	0 : "",
	1 : "Enero",
	2 : "Febrero",
	3 : "Marzo",
	4 : "Abril",
	5 : "Mayo",
	6 : "Junio",
	7 : "Julio",
	8 : "Agosto",
	9 : "Septiembre",
	10 : "Octubre",
	11 : "Noviembre",
	12 : "Diciembre"
}

$(document).ready(function(){
	//getCartones();
})

function getCartones(){
	$.ajax({
	  url:"server/api/cartones.php",
	  type:"GET",
	  beforeSend:function(){
	     $("body").removeClass("loaded");
	  },
	  success:function(data){
	  	console.log(data)
	  	if(data.hoy.code == 200)
	  		render(data.hoy.data[0],"#hoy","tarjetasHoy","Partida de hoy");
	  	if(data.proximas.code == 200)
	  		render(data.proximas.data[0],"#proximas","tarjetasProximas","Próximas partidas");
	  	/*if(data.code == 200)
	  		if(!data.tmp){
	  			idUsario = data.usuario.ID;
	  			//idUsario = data.usuario.idCliente;
	  			render_datos_usuario(data.usuario);
	  			//validarCP(data.usuario.CP, data.usuario.Colonia);
	  		}
	  	else
	  		Swal.fire({
	  		  icon: 'error',
	  		  title: 'Oops...',
	  		  text: data.msg
	  		});*/
	    
	  },
	  complete:function(){
	     $("body").addClass("loaded");
	    //getParams();
	  }
	});
}

function render(juego,parent,idBoton,TituloPartida){
	var fecha1 = juego.Game_date.split(" ");
	var fechaTmp = fecha1[0].split("-");
	//var fecha = fechaTmp[2] + " de "+meses[parseInt(fechaTmp[1])]+" del "+fechaTmp[0]; 
	var fecha = meses[parseInt(fechaTmp[1])]+" "+fechaTmp[2]; 
	var elem = '<div class="inner inner-1">';
	elem += '<div class="brook-section-title mb--20">';
	elem += '<h3 class="heading heading-cartas font-largm mb--0">'+TituloPartida+'</h3>';
	elem += '<p class="descripcion-partida">'+juego.Game_name+'</p>';
	elem += '<p class="txt-fecha"><strong>'+fecha+'</strong> '+fecha1[1]+'</p>';
	elem += '</div>';
	elem += '<div class="icon img-carta">';
	elem += '<img src="img/bg-mano.png" alt="icon box">';
	elem += '</div>';
	elem += '<button class="btn-seguir seguir1" tabindex="0" id="'+idBoton+'" data-idgame="'+juego.ID+'">Ir a Comprar</button>';
	elem += '</div>';
	$(parent).html(elem);
}

/*$(document).on("click","#tarjetasHoy",function(){
	console.log($(this).data("idgame"))
	window.location.href = "tienda.php?game="+$(this).data("idgame");
})
$(document).on("click","#tarjetasProximas",function(){
	console.log($(this).data("idgame"))
	window.location.href = "tienda.html?game="+$(this).data("idgame");
})*/

$(document).on("click","#tarjetasHoy",function(){
	window.location.href = "tienda.html?p=hoy";
})
$(document).on("click","#tarjetasProximas",function(){
	window.location.href = "tienda.html?p=pro";
})

$("#superPartida").on("click",function(){
	window.location.href = "tienda.html?p=super";
})