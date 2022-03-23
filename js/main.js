function iniciarsesion(){
	$.post('php/sessionstart.php','&'+$("#iniciar").serialize(),function(respuesta){
		if (respuesta=="1"){
			window.location.href = "principal.php";
		}else{	
		
		alert(respuesta);
//			console.log(respuesta);
		}
 		});
		}