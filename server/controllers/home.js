getBannerHome();


function getBannerHome(){
	var url = 'server/api/home.php';
	jQuery.ajax({
	  url:url,
	  type:"POST",
	  data:{"opcion":"getBannerHome"},
	  beforeSend:function(){
	     jQuery("body").removeClass("loaded");
	  },
	  success:function(response){
	  	console.log(response)
	  	if(response.code == 200){
	  		var elem;
	  		var banner;
	  		for(var i in response.data){
	  			banner = response.data[i];
	  			if(banner.URL_image.includes("youtube")){
	  				var str = banner.URL_image.split("v=");
	  				var urlVid = "";
	  				if(str.includes("&")){
	  					str = str.split("&");
	  					urlVid = str[0];
	  					
	  				}else{
	  					urlVid = str[1];
	  				}
	  				console.log(urlVid)
	  				jQuery("#youTube iframe").attr("src","https://www.youtube.com/embed/"+urlVid);
	  			}else if(banner.URL_image.includes("youtu.be")){
	  				var str = banner.URL_image.split("/");
	  				jQuery("#youTube iframe").attr("src","https://www.youtube.com/embed/"+str[3]);
	  				console.log(str)
	  			}else{
	  				elem = '<li data-index="rs-16" data-transition="slideoverdown" data-slotamount="default" data-hideafterloop="0"';
	  				elem += 'data-hideslideonmobile="off" data-easein="Power3.easeInOut" data-easeout="Power3.easeInOut"';
	  				elem += 'data-masterspeed="1500" data-rotate="0" data-saveperformance="off" data-title="Intro"';
	  				elem += 'data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6=""';
	  				elem += 'data-param7="" data-param8="" data-param9="" data-param10="" data-description="">';
	  				elem += '<img src="'+banner.URL_image+'" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="off" class="rev-slidebg" data-no-retina id="banner_home_"'+banner.ID+'>';
	  				elem += '</li>';
	  				
	  				jQuery("#rev_slider_6_1 ul").append(elem);
	  			}
	  			
	  		}
	  		revStart();
	  		/*jQuery("#banner_home").attr("src",""+response.data.URL_image+"");
	  		jQuery("#banner_home").css("background-image","url('"+response.data.URL_image+"')");
	  		jQuery(".tp-bgimg").css("background-image","url('"+response.data.URL_image+"')");
	  		jQuery(".tp-bgimg").attr("src",response.data.URL_image);*/
	  	}	
	  	
	  },
	  complete:function(){
	     jQuery("body").addClass("loaded");
	    //getParams();
	   	//revStart();
	  }
	});
}