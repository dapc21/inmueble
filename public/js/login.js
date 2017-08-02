$("#iniciarSesion").click(function(e){
	e.preventDefault();

    if ( $('#formLogin').validate().form() ){

    var nombre_usuario = $("#username").val();
    var clave = $("#password").val();
    var token = $("#_token").val();
    var route = "/login";
	
	console.log('enviando...');
	$(".mjeDisplay").html("<div class='alert alert-info alert-dismissable'><i class='fa fa-spinner fa-spin'></i>&nbsp;<b>Comprobando credenciales...</b></div>");
	
	$.ajax({
        url      : route,
        headers  : {'X-CSRF-TOKEN': token},
        type     : 'POST',
        dataType : 'json',
        data     : {username: nombre_usuario, password: clave},
        success:function(respuesta){
			if(respuesta.message == "OK"){
                $("#formLogin").trigger('reset');
				$(".mjeDisplay").html("<div class='alert alert-success alert-dismissable'><i class='fa fa-check'></i>&nbsp;<b><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Usuario encontrado!</b></div>");
                redirectPage();
            }
		},
		error:function(msj){
			if( msj.status === 400 )
			$(".mjeDisplay").html("<div class='alert alert-danger alert-dismissable'><i class='fa fa-times'></i>&nbsp;<b><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Bad Request.</b></div>");
            if( msj.status === 401 )
			$(".mjeDisplay").html("<div class='alert alert-danger alert-dismissable'><i class='fa fa-times'></i>&nbsp;<b><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Nombre y/o Contraseña inválidos.</b></div>");
            if( msj.status === 404 )
			$(".mjeDisplay").html("<div class='alert alert-danger alert-dismissable'><i class='fa fa-times'></i>&nbsp;<b><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>No se encuentra la ruta establecida.</b></div>");
			if( msj.status === 422 )
			$(".mjeDisplay").html("<div class='alert alert-danger alert-dismissable'><i class='fa fa-times'></i>&nbsp;<b><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Debe rellenar los campos obligatorios.</b></div>");
			if( msj.status === 500 )
			$(".mjeDisplay").html("<div class='alert alert-danger alert-dismissable'><i class='fa fa-times'></i>&nbsp;<b><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Internal Server Error.</b></div>");
		}
	});
	
    }
});

function redirectPage(){
	var route = "/api";
	var url = decodeURIComponent(route);
	window.location.replace(url);
}
