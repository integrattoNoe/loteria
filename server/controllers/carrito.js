$(document).ready(function(){
	getCarrito()
})

function getCarrito(){
	var url = 'server/api/carrito.php';
	$.ajax({
	  url:url,
	  data:{"opcion":"get_cart"},
	  type:"POST",
	  beforeSend:function(){
	    $("body").removeClass("loaded");
	  },
	  success:function(data){
	  	console.log(data)
	  	if(data.code == 200){
	  		$(".cart-table tbody").html("")
	  		$("#subTotal, #total").text("$"+data.subtotal);
	  		if(data.algunoInvalido){
	  			Swal.fire({
	  			  icon: 'error',
	  			  title: 'Oops...',
	  			  text: 'Hay tarjetas invalidas en tu carrito'
	  			});
	  			$("#btnCheckout").hide()
	  		}else{
	  			$("#btnCheckout").show()
	  		}
	  		renderCarrito(data.itemsCart, false);
	  		renderCarrito(data.invalidos, true);
	  	}
	  	else{
	  		var elem = "<h3>"+data.msg+"</h3>";
	  		elem += '<p><button class="brook-btn bk-btn-theme btn-sd-size btn-rounded space-between" id="irTienda">Conseguir tarjetas</button></p>';
	  		$(".cart_area > .container").html(elem);
	  	}
	  		
	    
	  },
	  complete:function(){
	    $("body").addClass("loaded");
	    //getParams();
	  }
	});
}


function renderCarrito(carrito, invalido){
	var elem = "";
	var item;
	for(var i in carrito){
		var tarjeta = carrito[i];
		if(invalido)
			elem = '<tr class="invalido" id="'+tarjeta.ID+'">';
		else
			elem = '<tr id="'+tarjeta.ID+'">';
		elem += '<td class="pro-thumbnail">';
		elem += '<div class="product mt--10">';
		//elem += '<a href="#">';
		elem += '<div class="product-thumbnail">';
		elem += '<div class="thumbnail">';
		elem += '<div class="row cabecera">';
		elem += '<div class="logo col-md-8 col-6"><img src="img/logo-loteria.png" style=""></div>';
		elem += '<div class="codigo col-md-4 col-6" id="codigo'+tarjeta.ID+'"></div>';
		elem += '</div>';
		elem += '<div class="product-main-image row">';
		for(var j = 1; j <= 16; j++ ){
			item = tarjeta["Item"+j].split(";");
			//console.log(item);
			var imgF = item[1];
			elem += '<div class="col-md-3 col-3 mt-2 mb-2 item">';
			elem += '<img src="'+imgF+'">';
			elem += '</div>';
		}
		elem += '</div>';
		elem += '</div>';
        elem += '</div>';
		//elem += '</a>';
		elem += '</div>';
		elem += '</td>';
		if(invalido)
			elem += '<td class="pro-title"><a href="#">'+tarjeta.Game_name+' - Cartón ('+tarjeta.ID+')</a><br><span class="error">'+tarjeta.Motivo+'</span></td>';
		else
			elem += '<td class="pro-title"><a href="#">'+tarjeta.Game_name+' - Cartón ('+tarjeta.ID+')</a></td>';
		elem += '<td class="pro-price"><span>$'+tarjeta.Card_price+'.00</span></td>';
		elem += '<td class="pro-quantity"><div class="pro-qty"><input type="text" value="1" disabled></div></td>';
		elem += '<td class="pro-subtotal"><span>$'+tarjeta.Card_price+'.00</span></td>';
		elem += '<td class="pro-remove"><a href="#"><i class="ion ion-android-close"></i></a></td>'
		elem += '</tr>';
		
		$(".cart-table tbody").append(elem);
		var barc = document.createElement("img");
		barc.setAttribute("id","barc"+i);
		JsBarcode(barc, tarjeta.ID);
		$(document).find("#codigo"+tarjeta.ID).append(barc);
	}
}

var eliminados = [];

$(document).on("click",".pro-remove a",function(e){
	e.preventDefault()
	var id = $(this).closest("tr").attr("id")
	$(this).closest("tr").fadeOut("slow")
	eliminados.push({"id":id})
	console.log(eliminados)
})

$("#btnUpdate").on("click",function(){
	var url = 'server/api/carrito.php';
	$.ajax({
	  url:url,
	  data:{"opcion":"remove_items","items":eliminados},
	  type:"POST",
	  beforeSend:function(){
	    $("body").removeClass("loaded");
	  },
	  success:function(data){
	  	console.log(data)
	  	getCarrito();
	  	update_bag();
	  	/*if(data.code == 200){
	  		$(".cart-table tbody").html("")
	  		$("#subTotal, #total").text("$"+data.subtotal);
	  		if(data.algunoInvalido){
	  			Swal.fire({
	  			  icon: 'error',
	  			  title: 'Oops...',
	  			  text: 'Hay tarjetas invalidas en tu carrito'
	  			});
	  			$("#btnCheckout").hide()
	  		}else{
	  			$("#btnCheckout").show()
	  		}
	  		renderCarrito(data.itemsCart, false);
	  		renderCarrito(data.invalidos, true);
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
})

$("#btnCheckout").on("click",function(){
	window.location.href = "checkout.php";
})

$(document).on("click","#irTienda",function(){
	window.location.href = "cartones.html";
})