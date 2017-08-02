
$(function () {
	
	$('#formLogin').validate({
		//errorLabelContainer: ".mjeDisplay", //capa donde muestro el error
		//wrapper: "li", //elemento que quiero crear para el error
		rules: {
			username: {
				required: true,
				minlength: 6,
				maxlength: 10
			},
			password: {
				required: true,
				minlength: 6
			}
		},
		messages: {
			username: {
				required: "Ingrese un nombre de usuario",
				minlength: "Ingrese al menos 6 caracteres",
				maxlength: "Ingrese máximo 10 caracteres"
			},
			password: {
				required: "Ingrese una contraseña",
				minlength: "Ingrese al menos 6 caracteres"
			}
		},
		highlight: function(element) {
			$(element).closest('.form-group').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('.form-group').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'help-block',
		errorPlacement: function(error, element) {
			if(element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			} else {
				error.insertAfter(element);
			}
		}
	});
	
});

