$(document).ready(function(){
	get_datos_usuario();
	//getTarjetas();
})

$('#telefono').keypress(function(event){
	console.log(event.which)
   if(event.which != 8  && isNaN(String.fromCharCode(event.which))){
   		event.preventDefault(); //stop character from entering input
   }
});

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
	  			//validarCP(data.usuario.CP, data.usuario.Colonia);
	  		}
	  	else
	  		Swal.fire({
	  		  icon: 'error',
	  		  title: 'Oops...',
	  		  text: data.msg
	  		});
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

$("#formDatosPersonales").on("submit",actualizar_datos);

function actualizar_datos(){
	var formD = new FormData(document.getElementById("formDatosPersonales"));
	formD.append("opcion","actualizar_datos");
	$.ajax({
	  url:"server/api/usuario.php",
	  type:"POST",
	  data:formD,
	  cache: false,
	  contentType: false,
	  processData: false,
	  beforeSend:function(){
	     $("body").removeClass("loaded");
	  },
	  success:function(data){
	  	console.log(data)
	  	if(data.code == 200)
	  		Swal.fire({
	  		  icon: 'success',
	  		  title: 'Éxito',
	  		  text: "Tus datos personales se han actualizado."
	  		});
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

$("#guardarPass").on("click",cambiarPass);

function cambiarPass(){
	var newPass = $("input[name = 'pass']").val();
	var confirmPass = $("input[name = 'passConfirm']").val();
	if(newPass == confirmPass){
		$.ajax({
		  url:"server/api/usuario.php",
		  type:"POST",
		  data:{"opcion":"updPass","pass":newPass},
		  beforeSend:function(){
		     $("body").removeClass("loaded");
		  },
		  success:function(data){
		  	console.log(data)
		  	if(data.code == 200)
		  		Swal.fire({
		  		  icon: 'success',
		  		  title: 'Éxito',
		  		  text: "Tu contraseña ha sido actualizada."
		  		});
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
	else
		Swal.fire({
		  icon: 'error',
		  title: 'Oops...',
		  text: "Las contraseñas no coinciden."
		});
}
