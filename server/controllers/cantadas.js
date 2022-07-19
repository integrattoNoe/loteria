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
	getProximos();
	get_datos_usuario();
})


function getProximos(){
	$.ajax({
	  url:"server/api/cantadas.php",
	  data:{"opcion":"proximas"},
	  type:"POST",
	  beforeSend:function(){
	     $("body").removeClass("loaded");
	  },
	  success:function(data){
	  	console.log(data)
	  	if(data.code == 200)
	  		renderProximos(data.data);
	  	else{
	  		Swal.fire({
	  		  icon: 'error',
	  		  title: 'Oops...',
	  		  text: data.msg
	  		});
	  		$("#proximos").removeClass("brook-element-carousel");
	  	}
	  		
	    
	  },
	  complete:function(){
	     $("body").addClass("loaded");
	    //getParams();
	    //getPasados();
	    //prueba();
	  }
	});
}

function getPasados(){
	$.ajax({
	  url:"server/api/cantadas.php",
	  data:{"opcion":"pasados"},
	  type:"POST",
	  beforeSend:function(){
	     $("body").removeClass("loaded");
	  },
	  success:function(data){
	  	console.log(data)
	  	if(data.code == 200){
	  		renderPasados(data.data);
	  	}else{
	  		$("#pasados").removeClass("brook-element-carousel");
	  	}
	  	/*else
	  		Swal.fire({
	  		  icon: 'error',
	  		  title: 'Oops...',
	  		  text: data.msg
	  		});*/
	    
	  },
	  complete:function(){
	     $("body").addClass("loaded");
	    //getParams();
	    //prueba();
	  }
	});
}

function renderProximos(juegos){
	var elem = "";
	var juego;
	var fecha1;
	var vivo = false;
	for(var i in juegos){
		juego = juegos[i];
		elem = '<div class="team team__style--3 move-up wow">';
		elem += '<div class="thumb">';
		elem += '<p>'+juego.Game_name+'</p>';
		fecha1 = juego.Game_date.split(" ");
		var fechaTmp = fecha1[0].split("-");
		var fecha = fechaTmp[2] + " de "+meses[parseInt(fechaTmp[1])]+" del "+fechaTmp[0]; 
		//elem += '<img src="img/team/team-3/team-1.jpg" alt="team Images">';
		//elem += '<div class="overlay red-color" style="background-image: url(img/team/team-3/team-1.jpg);"></div>';
		elem += '</div>';
		elem += '<div class="team-info text-center pt--20 pb--20">';
		elem += '<div class="info">';
		elem += '<h5 class="txt-fecha">'+fecha+'</h5>';
		if(juego.Status == "Activo")
			elem += '<button class="btn-seguir mt--10" data-game="'+juego.ID+'">Seguir</button>';
		elem += '</div></div></div>';
		$("#proximos").append(elem);
		if(!vivo && juego.Status == "Activo"){
			vivo = true;
			//var hora = fecha[1].split(":");
			$("#juegoVivo").text(juego.Game_name);
			$(".txt-fecha").html("<b>"+meses[parseInt(fechaTmp[1])]+" "+fechaTmp[2]+"</b> "+fecha1[1]);
			$("#btnVivo").data("game",juego.ID);
		}
	}

	$('#proximos').slick({
    	infinite: true,
    	slidesToShow: 4,
    	slidesToScroll: 1,
    	dots: false,
    	arrows:true,
    	nextArrow: '<i class="fas fa-chevron-right nextArrowBtn"></i>',
    	prevArrow: '<i class="fas fa-chevron-left prevArrowBtn"></i>',
    	responsive: [
    	    {
    	      breakpoint: 1440,
    	      settings: {
    	        slidesToShow: 4,
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

function renderPasados(juegos){
	var elem = "";
	var juego;
	var fecha;
	for(var i in juegos){
		juego = juegos[i];
		elem = '<div class="team team__style--3 move-up wow">';
		elem += '<div class="thumb">';
		elem += '<p>'+juego.Game_name+'</p>';
		fecha = juego.Game_date.split(" ");
		var fechaTmp = fecha[0].split("-");
		fecha = fechaTmp[2] + " de "+meses[parseInt(fechaTmp[1])]+" del "+fechaTmp[0];
		//elem += '<img src="img/team/team-3/team-1.jpg" alt="team Images">';
		//elem += '<div class="overlay red-color" style="background-image: url(img/team/team-3/team-1.jpg);"></div>';
		elem += '</div>';
		elem += '<div class="team-info text-center pt--20 pb--20">';
		elem += '<div class="info">';
		elem += '<h5 class="txt-fecha">'+fecha+'</h5>';
		//elem += '<button class="btn-seguir mt--10" data-game="'+juego.ID+'">Seguir</button>';
		elem += '</div></div></div>';
		$("#pasados").append(elem);
	}
		$('#pasados').slick({
	    	infinite: true,
	    	slidesToShow: 4,
	    	slidesToScroll: 1,
	    	dots: false,
	    	arrows:true,
	    	nextArrow: '<i class="fas fa-chevron-right nextArrowBtn"></i>',
	    	prevArrow: '<i class="fas fa-chevron-left prevArrowBtn"></i>',
	    	responsive: [
	    	    {
	    	      breakpoint: 1440,
	    	      settings: {
	    	        slidesToShow: 4,
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

function get_datos_usuario(){
	$.ajax({
	  url:"server/api/usuario.php",
	  data:{"opcion":"datos_usuario"},
	  type:"POST",
	  beforeSend:function(){
	     $("body").removeClass("loaded");
	  },
	  success:function(data){
	  	console.log(data)
	  	if(data.code == 200){
	  		$(".noLogin,.btn-seguir2,.btn-seguir1").hide();
	  		$(".login b").text("¡Bienvenido "+data.usuario.First_name+"!").show();
	  		$("#salir").show()

	  	}
	  	else{
	  		$(".noLogin,.btn-seguir2,.btn-seguir1").show();
	  		$(".login").hide();
	  	}
	    
	  },
	  complete:function(){
	     $("body").addClass("loaded");
	    //getParams();
	  }
	});
}


$(document).on("click",".btn-seguir",function(){
	console.log($(this).data("game"));
	window.location.href = "juego.php?g="+$(this).data("game");
})

$(".btn-seguir2,.btn-inicia").on("click",function(){
	window.location.href = "login-register.php?r=cant";
})

