
$(function () {
    jQuery.validator.addMethod("onlylettersandspaces", function(value, element) {
       return this.optional(element) || /^[a-zA-Z\ñ\Ñ\ÁáÉéÍíÓóÚú," "]+$/i.test(value);
    }, "Solo se permiten letras y espacios");

    jQuery.validator.addMethod("onlylettersnumbersandspaces", function(value, element) {
       return this.optional(element) || /^[a-zA-Z\ñ\Ñ\ÁáÉéÍíÓóÚú0-9," "]+$/i.test(value);
    }, "Solo se permiten letras, números y espacios");

	$('#formEditProperties').validate({
		rules: {
			status_id : {
				required  : true
			},
			title : {
				required  : true,
				minlength : 1,
				maxlength : 35
			},
			address : {
				required  : true,
				minlength : 1,
				maxlength : 150
			},
			town : {
				required                    : true,
				minlength                   : 2,
				maxlength                   : 50,
				onlylettersnumbersandspaces : true
			},
			country : {
				required             : true,
				minlength            : 4,
				maxlength            : 50,
				onlylettersandspaces : true
			}
		},
		messages: {
			status_id : {
				required  : "Seleccione un estado de inmueble"
			},
			title : {
				required  : "Por favor ingrese un título",
				minlength : "Ingrese al menos {0} caracter",
				maxlength : "Ingrese máximo {0} caracteres"
			},
            address : {
				required  : "Por favor ingrese una dirección",
				minlength : "Ingrese al menos {0} caracter",
				maxlength : "Ingrese máximo {0} caracteres"
			},
            town : {
				required  : "Por favor ingrese un poblado/ciudad",
				minlength : "Ingrese al menos {0} caracteres",
				maxlength : "Ingrese máximo {0} caracteres"
			},
            country : {
				required  : "Por favor ingrese un país",
				minlength : "Ingrese al menos {0} caracteres",
				maxlength : "Ingrese máximo {0} caracteres"
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

