let tarjetas;
let totalTarjetas = 0;
let infoGame;

$(document).ready(function(){
	var params = GET(window.location.href)
	if(params){
		if(params.game)
			getTarjetas(params.game)
	}
})

function getTarjetas(idGame){
	fetch('server/api/catalogo.php?game='+idGame)
	  .then(function(response) {
	    return response.json();
	  })
	  .then(function(myJson) {
	  	if(myJson.code == 200){
	  		tarjetas = myJson.data
	  		console.log("Toal: "+tarjetas.length)
	  		totalTarjetas = tarjetas.length;
	  		$("#page-preloader").show();
	  		infoGame = myJson.infoGame[0];
	    	renderTarjetas(0)
	    }
	    else
	    	alert(myJson.msg)
	  });
}

function renderTarjetas(index){
	$("#page-preloader").show();
	var tarjeta = tarjetas[index];
	var elem = '';
	var item = "";
	//let url = "../Elotto/assets/images/game_cards/";
	let url = "http://integrattodev.cloudapp.net/Elotto/assets/images/game_cards/";
	//for(var i in tarjetas){
		elem = '<div class="tarjeta col-md-4" id="item'+index+'">';
		elem += '<div class="row cabecera">';
		elem += '<div class="logo col-md-8"><img src="../Elotto/assets/images/elotto/logo.jpg" style="max-width:200px;"></div>';
		elem += '<div class="codigo col-md-4" id="codigo'+index+'"></div>';
		elem += '</div>';
		elem += '<div class="row cuerpo">';
		
		for(var j = 1; j <= 16; j++ ){
			item = tarjeta["Item"+j].split(";");
			console.log(item);
			var imgF = item[1];
			var img1 = imgF.lastIndexOf("/");
			var img = imgF.substring(img1+1,imgF.length);
			console.log(img)
			elem += '<div class="col-md-3 mt-2 mb-2">';
			elem += '<img src="'+url+img+'">';
			elem += '</div>';
		}
	    elem += '</div>';
		elem += '</div>';
		$("#temporal").html(elem);
		var barc = document.createElement("img");
		barc.setAttribute("id","barc"+index);
		JsBarcode(barc, tarjeta.ID);
		$(document).find("#codigo"+index).append(barc);
		var node = document.getElementById('item'+index);
		setTimeout(function(){
			domtoimage.toPng(node)
			    .then(function (dataUrl) {
			        var img = new Image();
			        img.src = dataUrl;
			        
			        var newDiv = document.createElement("div");
			        newDiv.setAttribute("class","col-lg-4 col-md-6 col-sm-6 col-12");
			        
			        var divProduct = document.createElement("div");
			        divProduct.setAttribute("class","product mt--60")
			       
			        var prodThu = document.createElement("div")
			        prodThu.setAttribute("class","product-thumbnail")
			        
			        var thu = document.createElement("div")
			        thu.setAttribute("class","thumbnail")
			        
			        var mainImg = document.createElement("div")
			        mainImg.setAttribute("class","product-main-image")
			        mainImg.appendChild(img);

			        thu.appendChild(mainImg)
			        prodThu.appendChild(thu)

			        

			        var prod = document.createElement("div");
			        prod.setAttribute("class","product-action");
			        
			        var action = '<ul class="action-list text-center tooltip-layout">';
			        action += '<li class="single-action addto-cart"><a href="cart.html" class="link hint--bounce hint--top hint--dark" aria-label="Add to Cart"><i class="fas fa-shopping-bag"></i></a></li>';
			        action += '<li class="single-action wishlist"><a href="wishlist.html" class="link hint--bounce hint--top hint--dark" aria-label="Add to Wishlist"><i class="far fa-heart"></i></a></li>';
			        action += '</ul>';
			        prod.insertAdjacentHTML("beforeend",action);
			        prodThu.appendChild(prod)
			        divProduct.appendChild(prodThu)
                    newDiv.appendChild(divProduct);
                    var info = '<div class="product-info">';
                    info += '<h5 class="heading heading-h5"><a href="#">'+infoGame.Game_name+'</a></h5>';
                    info += '<div class="price"><span>$'+infoGame.Card_price+'.00</span></div>';
                    info += '</div>';
                    divProduct.insertAdjacentHTML("beforeend",info);
			        $(".row--25").append(newDiv);
			        if(index+1 < totalTarjetas)
			        	renderTarjetas(index+1);
			        else{
			        	$("#page-preloader").hide();
			        	$("#temporal").html("");
			        //document.body.appendChild(img);
			        }
			    })
			    .catch(function (error) {
			        console.error('oops, something went wrong!', error);
			    });
			//$("#tarjetas").append(canvas);
		},3000)
		
		//$("#tarjetas").append(elem);         
                
	//}
}

$("#press").on("click",function(){
	var w = $("#temporal").width();
	var h = $("#temporal").height();

	
})