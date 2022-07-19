function GET(url){
	var params = new Array();
	var key = "";
	var value = "";
	var link = url;
	var haspar = link.includes("?");
	if(haspar){
		var n = link.indexOf("?");
		/*Obtener las keys*/
		for(var x=n+1; x<link.length; x++){
			if(link.charAt(x) !== "="){
				key = key.concat(link.charAt(x));
			}
			else{
				break;
			}
		}
		var m = link.indexOf("=");
		/*Obtenemos los valores*/
		for(var y=m+1; y<link.length; y++){
			if(link.charAt(y) !== "&"){
				value = value.concat(link.charAt(y));
			}
			else{
				break;
			}
		}
		params[key] = value;
		key = "";
		value = "";
		/*Ahora que inicializamos la busqueda ahora vamos en busqueda demas buscando el signo &*/
		var hasmore = link.includes("&");
		if(hasmore){
			for(var z=0; z<link.length; z++){
				if(link.charAt(z) === "&"){
					var h = link.indexOf("&",z);
					/*Obtener las keys*/
					for(var x=h+1; x<link.length; x++){
						if(link.charAt(x) !== "="){
							key = key.concat(link.charAt(x));
						}
						else{
							break;
						}
					}
					var m = link.indexOf("=",z);
					/*Obtenemos los valores*/
					for(var y=m+1; y<link.length; y++){
						if(link.charAt(y) !== "&"){
							value = value.concat(link.charAt(y));
						}
						else{
							break;
						}
					}
					params[key] = value;
					key = "";
					value = "";
				}
			}
		}
		return params;
	}
}