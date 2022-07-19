/*
	sandbox paypal:
	sb-43nadj663855@personal.example.com
	96S^i>pR
	*/

$(document).ready(function(){
	get_datos_usuario()
})

var idUsario,idVenta,idVentaMenudeo;

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
	  	if(data.code == 200)
	  		if(!data.tmp){
	  			idUsario = data.usuario.ID;
	  			//idUsario = data.usuario.idCliente;
	  			render_datos_usuario(data.usuario);
	  			idVenta = data.idV;
	  			idVentaMenudeo = data.idVM;
	  			//validarCP(data.usuario.CP, data.usuario.Colonia);
	  		}
	  		/*else
	  			$("#billing_email").val(data.usuario.u);*/
	    
	  },
	  complete:function(){
	     $("body").addClass("loaded");
	    //getParams();
	  }
	});
}

function render_datos_usuario(u){
	console.log(u)
	$("input[name='nombre']").val(u.First_name);
	$("input[name='apellido']").val(u.Last_name);
	$("input[name='email']").val(u.email);
	$("input[name='telefono']").val(u.Phone);
	$("input[name='direccion1']").val(u.Address1);
	$("input[name='direccion2']").val(u.Address2);
	$("input[name='pais']").val(u.Country);
	$("input[name='ciudad']").val(u.City);
	$("input[name='estado']").val(u.State);
	$("input[name='cp']").val(u.Zip_code);
	
}


$("#continuarPago").on("click",function(e){
	e.preventDefault();
	$("#btnEnviar").click();
});


$("#datosEnvio").on("submit",function(){
	var formD = new FormData(document.getElementById("datosEnvio"));
	formD.append("opcion","guardarDatos")
	guardarDatos(formD)
})

function guardarDatos(datos){
	var url = 'server/api/checkout.php';
	$.ajax({
	  url:url,
	  data:datos,
	  type:"POST",
	  cache: false,
	  contentType: false,
	  processData: false,
	  beforeSend:function(){
	    $("body").removeClass("loaded");
	  },
	  success:function(data){
	  	console.log(data)
	  	if(data.code == 200){
	  		if(data.productos.algunoInvalido){
	  			Swal.fire({
	  			  icon: 'error',
	  			  title: 'Oops...',
	  			  text: "No se puede proceder al pago, tu carrito contiene tarjetas inválidas.",
	  			  onClose: redireccionar()
	  			});
	  		}else{
	  			$("#paypal-button-container").show();
	  			$("#continuarPago").hide();
	  		}
	  		
	  	}
	    
	  },
	  complete:function(){
	    $("body").addClass("loaded");
	    //getParams();
	  }
	});
}

function redireccionar(){
	setTimeout(function(){
		window.location.href = "carrito.html"
	},2000)
	
}

var Pay_amount;
var Order_num;
var Pay_num;
var Gateway;
var Status;


function guardar_pago(){
	var url = 'server/api/checkout.php';
	$.ajax({
	  url:url,
	  data:{"Order_num":Order_num,"Pay_num":Pay_num,"Gateway":Gateway,"Status":Status, "opcion":"guardar_pago"},
	  type:"POST",
	  beforeSend:function(){
	    $("body").removeClass("loaded");
	  },
	  success:function(data){
	  	console.log(data)
	  	if(data.code == 200){
	  		Swal.fire({
	  		  icon: 'success',
	  		  title: 'Éxito',
	  		  text: "Tu compra ha sido procesada correctamente."
	  		});
	  		limpiar_carrito();
	  	}
	  		
	  	else
	  		Swal.fire({
	  		  icon: 'error',
	  		  title: 'Oops...',
	  		  text: data.msg
	  		});
	  },
	  complete:function(){
	    $("body").addClass("loaded");
	    //getParams();
	  }
	});
}

function limpiar_carrito(){
	var url = 'server/api/carrito.php';
	$.ajax({
	  url:url,
	  data:{"opcion":"limpiar_carrito"},
	  type:"POST",
	  beforeSend:function(){
	    $("body").removeClass("loaded");
	  },
	  success:function(data){
	  	$("#paypal-button-container,#continuarPago").remove();
	  	update_bag();
	  },
	  complete:function(){
	    $("body").addClass("loaded");
	    //getParams();
	  }
	});
}

$("#irTienda").on("click",function(e){
	e.preventDefault();
	window.location.href = "index.html";
})