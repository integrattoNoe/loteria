var tipoPartida;
$(document).ready(function(){
	var params = GET(window.location.href)
	if(params){
		if(params.p){
			tipoPartida = params.p.replace("#","");
			if(tipoPartida == "hoy")
				getPartidasHoy();
			else if(tipoPartida == "pro")
				getProximasPartidas();
			else if(tipoPartida == "super")
				getSuperPartidas();
		}else{
			window.location.href = "cartones.html";
		}
	}else{
		window.location.href = "cartones.html";
	}
})

function getPartidasHoy(){
	$.ajax({
	  url:"server/api/tienda.php",
	  type:"POST",
	  data:{"opcion":"getPartidasHoy"},
	  beforeSend:function(){
	     $("body").removeClass("loaded");
	  },
	  success:function(response){
	  	console.log(response)
	  	
	  	if(response.code == 200)
	  		renderPartidas(response.data)
	  	else
	  		Swal.fire({
	  		  icon: 'error',
	  		  title: 'Oops...',
	  		  text: response.msg,
	  		  onClose: () => {
	  		    window.location.href = "cartones.html";
	  		  }
	  		});
	    
	  },
	  complete:function(){
	     $("body").addClass("loaded");
	    //getParams();
	  }
	});
}

function getProximasPartidas(){
	$.ajax({
	  url:"server/api/tienda.php",
	  type:"POST",
	  data:{"opcion":"getProximasPartidas"},
	  beforeSend:function(){
	     $("body").removeClass("loaded");
	  },
	  success:function(response){
	  	console.log(response)
	  	
	  	if(response.code == 200)
	  		renderPartidas(response.data)
	  	else
	  		Swal.fire({
	  		  icon: 'error',
	  		  title: 'Oops...',
	  		  text: response.msg,
	  		  onClose: () => {
	  		    window.location.href = "cartones.html";
	  		  }
	  		});
	    
	  },
	  complete:function(){
	     $("body").addClass("loaded");
	    //getParams();
	  }
	});
}

function getSuperPartidas(){
	$.ajax({
	  url:"server/api/tienda.php",
	  type:"POST",
	  data:{"opcion":"getSuperPartidas"},
	  beforeSend:function(){
	     $("body").removeClass("loaded");
	  },
	  success:function(response){
	  	console.log(response)
	  	
	  	if(response.code == 200)
	  		renderPartidas(response.data)
	  	else
	  		Swal.fire({
	  		  icon: 'error',
	  		  title: 'Oops...',
	  		  text: response.msg,
	  		  onClose: () => {
	  		    window.location.href = "cartones.html";
	  		  }
	  		});
	    
	  },
	  complete:function(){
	     $("body").addClass("loaded");
	    //getParams();
	  }
	});
}

function renderPartidas(partidas){
	var partida,fechaArr,fechaSpl,fechaSpl2,fecha;
	var elem;
	moment.locale('es');

	for(var i in partidas){
		partida = partidas[i];
		elem = '<div class="item partida" id="'+partida.ID+'">';
		elem += '<div>';
		elem += '<p>'+partida.Game_name+'</p>';
		elem += '</div>';
		elem += '<div>';
		/*fechaArr = partida.Game_date;
		fechaSpl = fechaArr.split(" ");
		fechaSpl2 = fechaSpl[1];
		fechaSpl = fechaSpl2.split(":");
		fecha = fechaSpl[0]+":"+fechaSpl[1]+" hrs";*/
		fecha = moment(partida.Game_date).format("DD [de] MMMM [del] YYYY")
		hora = moment(partida.Game_date).format("hh:mm A");
		elem += '<p>'+fecha+'</p>';
		elem += '</div>';
		elem += '<div>';
		elem += '<p>'+hora+'</p>';
		elem += '</div>';
		elem += '<div>';
		elem += '<p>$'+partida.Prize_minimum_amount+'.00 MXN</p>';
		elem += '</div>';
		elem += '</div>';
		$("#partidas").append(elem);
	}
}

var partidaSel;

$(document).on("click",".partida",function(){
	partidaSel = $(this).attr("id");
	$(".partida").removeClass("partidaSel");
	$(this).addClass("partidaSel");
	$("#cartones").show();
	/*if(tipoPartida == "super"){
		$("#suerte,#elegir").hide();
	}*/
})
$(document).on("click",".carton",function(){
	$(".carton").removeClass("partidaSel");
	$(this).addClass("partidaSel");
})

$("#suerte").on("click",function(){
	setTimeout(function(){
		window.location.href = "tienda_old.php?game="+partidaSel+"&op=suerte";
	},500)
	
})

$("#elegir").on("click",function(){
	setTimeout(function(){
		window.location.href = "tienda_old.php?game="+partidaSel+"&op=elegir";
	},500)
})

$("#disena").on("click",function(){
	setTimeout(function(){
		window.location.href = "crear-cartas.html?game="+partidaSel;
	},500)
})