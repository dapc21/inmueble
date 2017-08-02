$("#cerrarSesion").click(function(e){
    e.preventDefault();
    var route = "/logout";
    var token = $("#user_token").val();
    $.ajax({
        url      : route,
        headers  : {'X-CSRF-TOKEN': token},
        type     : 'POST',
        dataType : 'json',
        data     : {token : token},
        success:function(respuesta){
            if(respuesta.message == "OK"){
               redirectLogin();
            }
        },
        error:function(msj){
            if( msj.status === 500 ) redirectLogin();
        }
    });
});

function redirectLogin(){
    var route = "/";
    var url = decodeURIComponent(route);
    window.location.replace(url);
}
