//update_bag();
//sesion();

function update_bag(){
	var url = 'server/api/carrito.php'
	$.ajax({
	  url:url,
	  data:{"opcion":"cart_bag"},
	  type:"POST",
	  beforeSend:function(){
	    $(".ai-preloader").addClass("active")
	  },
	  success:function(data){
	  	console.log(data)
	  	if(data.code == 200){
	  		$("#minicart-trigger").attr('data-count',data.qty);
	  		//$(".header-default .header-right .mini-cart-button::after").css("content",data.qty);
	  		console.log($("#minicart-trigger").data('count'));
	  	}else{
	  		$("#minicart-trigger").attr('data-count',0);
	  	}
	    
	  },
	  complete:function(){
	    $(".ai-preloader").removeClass("active")
	  }
	});
}

$("#minicart-trigger,.mini-cart").on("click",function(e){
	$(".shopping-cart .cart-box .show").hide();
	e.preventDefault()
	window.location.href = "carrito.html";
})


/*function sesion(){
	var url = 'server/api/login.php';
	jQuery.ajax({
	  url:url,
	  data:{"opcion":"sesion"},
	  type:"POST",
	  beforeSend:function(){
	     $(".ai-preloader").addClass("active");
	  },
	  success:function(data){
	  	if(data.code == 200){
	  		console.log(data)
	  		//let usuario = data.data[0].First_name != null ? data.data[0].First_name+", "+data.data[0].email : data.data[0].email
	  		let usuario = data.data[0].First_name != null ? data.data[0].First_name : ""
	  		$("#usuario p").text("Hola "+usuario);
	  		$("#usuario").show();
	  		$("#iniciarSesion").hide()
	    	$("#usuario p").css("color","#000");
	  	}
	    
	    
	  },
	  complete:function(){
	     $(".ai-preloader").removeClass("active");
	    //getParams();
	  }
	});
}*/


jQuery("#salir").on("click",function(){
	var url = 'server/api/login.php';
	jQuery.ajax({
	  url:url,
	  data:{"opcion":"salir"},
	  type:"POST",
	  beforeSend:function(){
	     jQuery(".ai-preloader").addClass("active");
	  },
	  success:function(data){
	  	if(data.code == 200){  		
	  		jQuery("#usuario p").text("");
	  		jQuery("#usuario").hide();
	  		jQuery("#iniciarSesion").show()
	    	
	  	}
	    else
	    	Swal.fire({
	    	  icon: 'error',
	    	  title: 'Oops...',
	    	  text: data.msg
	    	});
	    
	  },
	  complete:function(){
	     jQuery(".ai-preloader").removeClass("active");
	    //getParams();
	  }
	});
})

$(document).ready(function(){
	$(".mini-cart .shopping-cart").css("display","none !important");
})