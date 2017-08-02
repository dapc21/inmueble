
$("#addProperties").click(function(e){
	e.preventDefault();
	modalCreateProperties();
});

var winCreateProperties;
function modalCreateProperties(){
	var route = "/properties/create";

	$.get(route, function(template){

		var $bodyModal = $('<div class="row"></div>');

		winCreateProperties = BootstrapDialog.show({
			id       : "modalCreateProperties",
			title    : "Crear Inmueble",
			message  : $bodyModal,
			closable : false,
			type     : BootstrapDialog.TYPE_SUCCESS,
			cssClass : 'bootstrap-dialog-view-max', /*definido en css personalized*/
			onshow   : function(dialog) {
				dialog.getButton("createProperties").disable();
				dialog.getButton('btnCloseWindowCreate').disable();
			},
			buttons  : [{
				id       : 'btnCloseWindowCreate',
				icon     : 'fa fa-remove',
				label    : 'Cancelar',
				cssClass : 'btn-default',
				action   : function(dialogItself){
					dialogItself.close();
				}
			},{
				id       : "createProperties",
				icon     : 'fa fa-check',
				label    : 'Crear',
				cssClass : 'btn-success',
				action   : function(dialog) {
					createProperties();
				}
			}]
		});

		$bodyModal.html('<div id="divCreateProperties">'+template+'</div>');
		//ocultamos capa del form mientras cargan datos del select de estado del inmueble
		winCreateProperties.getModalBody().find('#divCreateProperties').hide();
		loadStatuses(winCreateProperties, $bodyModal);
	});
}

function loadStatuses(winCreateProperties, $bodyModal) {
	$.ajax({
		url        : "/statuses/all/",
		type       : 'GET',
		dataType   : 'json',
		beforeSend : function() {
			$bodyModal.append('<div id="divLoadCreateProperties"><div style="text-align: center; color: #337AB7;"><br>Por favor espere<br><i class="fa fa-refresh fa-spin fa-2x"></i></div></div>');
			$('#status_id').empty().append('<option value="">Cargando...</option>');
		},
		success    : function(data) {
			var $status = $("#status_id");
			$status.empty();
			$.each(data, function(index, value) {
				$status.append('<option data-tokens="'+ value.name +'" value="'+ value.id +'">' + value.name + '</option>');
				/* Refresco los resultados en el plugin Bootstrap Select */
				$('.selectpicker').selectpicker('refresh');
			});
			/* Habilita menú nativo de dispositivos móviles */
			if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
				$('.selectpicker').selectpicker('mobile');
			}
			loadFacilities(winCreateProperties, $bodyModal);
		},
		error      : function(jqXhr) {
			winCreateProperties.getModalBody().find('#divLoadCreateProperties').html("");
			$bodyModal.append('<div id="divLoadCreateProperties"><div style="text-align: center; color: #337AB7;"><br>ERROR AL CARGAR LOS DATOS EN SELECT ESTADO DE INMUEBLE</div></div>');
			winCreateProperties.getButton('btnCloseWindowCreate').enable();
		}
	});
}

function loadFacilities(winCreateProperties, $bodyModal) {
	$.ajax({
		url        : "/facilities/all/",
		type       : 'GET',
		dataType   : 'json',
		beforeSend : function() {
			$('#facility_id').empty().append('<option value="">Cargando...</option>');
		},
		success    : function(data) {
			var $facility = $("#facility_id");
			$facility.empty();
			$.each(data, function(index, value) {
				$facility.append('<option data-tokens="'+ value.name +'" value="'+ value.id +'">' + value.name + '</option>');
				/* Refresco los resultados en el plugin Bootstrap Select */
				$('.selectpicker').selectpicker('refresh');
			});
			/* Habilita menú nativo de dispositivos móviles */
			if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
				$('.selectpicker').selectpicker('mobile');
			}
			//Efecto FadeIn, fin capa carga
			winCreateProperties.getModalBody().find('#divLoadCreateProperties').html("");
			winCreateProperties.getModalBody().find('#divCreateProperties').fadeIn();
			//Habilitación de botones
			winCreateProperties.getButton("createProperties").enable();
			winCreateProperties.getButton('btnCloseWindowCreate').enable();
		},
		error      : function(jqXhr) {
			winCreateProperties.getModalBody().find('#divLoadCreateProperties').html("");
			$bodyModal.append('<div id="divLoadCreateProperties"><div style="text-align: center; color: #337AB7;"><br>ERROR AL CARGAR LOS DATOS EN SELECT ESTADO DE INMUEBLE</div></div>');
			winCreateProperties.getButton('btnCloseWindowCreate').enable();
		}
	});
}

function createProperties() {
	if ( $('#formProperties').validate().form() ) {
		var selectedFacilities = [];
		var route = "/properties", token = winCreateProperties.getModalBody().find("#token").val();
		var title = winCreateProperties.getModalBody().find("#title").val();
		var description = winCreateProperties.getModalBody().find("#description").val();
		var address = winCreateProperties.getModalBody().find("#address").val();
		var town = winCreateProperties.getModalBody().find("#town").val();
		var country = winCreateProperties.getModalBody().find("#country").val();
		var status_id = winCreateProperties.getModalBody().find("#status_id").val();
		$.each($("#facility_id option:selected"), function() {
			selectedFacilities.push($(this).val());
		});

		$.ajax({
			url      : route,
			headers  : {'X-CSRF-TOKEN': token},
			type     : 'POST',
			dataType : 'json',
			data     : {
				title       : title,
				description : description,
				address     : address,
				town        : town,
				country     : country,
				status_id   : status_id,
				facility_id : selectedFacilities
			},
			success  :function(respuesta){
				if( respuesta.status_code === 201 ) {
					mensajeOk(respuesta.message);
					$("#formProperties").trigger('reset');
					$("#modalCreateProperties").modal('toggle');
					reloadTableProperties();
				}
			},
			error    : function(jqXhr){
				var respuesta = jqXhr.responseJSON;
				if( jqXhr.status === 401 ) $(location).prop( 'pathname', '/' );
				if( jqXhr.status === 422 ) {
					var errorsHtml= '';
					$.each(respuesta.errors, function(index, value) {
						errorsHtml += '<li>' + value + '</li>';
					});
					mensajeErrorWindow(errorsHtml);
				}
				if( jqXhr.status === 500 ) {
					if( respuesta.created === false ) { //error de creación
						mensajeErrorWindowSingle(respuesta.message+".<br>Motivo: Error transaccional interno del servidor.");
					}
				}
			}

		});
	}
}

function modalShowProperties(btn){
	var route = "/properties/showProperties";

	$.get(route, function(template){
		var $bodyModal = $('<div class="row"></div>');

		var winShowProperties = BootstrapDialog.show({
			id       : "modalShowProperties",
			title    : "Mostrar Inmueble",
			message  : $bodyModal,
			closable : true,
			type     : BootstrapDialog.TYPE_SUCCESS,
			cssClass : 'bootstrap-dialog-view', //definido en css personalized
			onshow   : function(dialog) {
				dialog.getButton('btnCloseWindowShow').disable();
			},
			buttons  : [{
				id       : 'btnCloseWindowShow',
				icon     : 'fa fa-remove',
				label    : 'Cerrar',
				cssClass : 'btn-default',
				action   : function(dialogItself){
					dialogItself.close();
				}
			}]
		});
		$bodyModal.html('<div id="divShowProperties">'+template+'</div>');
		winShowProperties.getModalBody().find('#divShowProperties').hide();
		showProperties(winShowProperties, $bodyModal, btn);
	});
}

function showProperties(winShowProperties, $bodyModal, btn){
	var route = "/properties/"+btn.value;
	$.ajax({
		url        : route,
		type       : 'GET',
		dataType   : 'json',
		beforeSend : function() {
			$bodyModal.append('<div id="divLoadShowProperties"><div style="text-align: center; color: #337AB7;"><br>Por favor espere<br><i class="fa fa-refresh fa-spin fa-2x"></i></div></div>');
		},
		success:function(res) {
			winShowProperties.getModalBody().find('#divLoadShowProperties').html("");
			winShowProperties.getModalBody().find('#divShowProperties').fadeIn();
			winShowProperties.getButton('btnCloseWindowShow').enable();
			//Datos
			winShowProperties.getModalBody().find("span#titleProperties").html("");
			winShowProperties.getModalBody().find("span#titleProperties").html(res.property.title);
			winShowProperties.getModalBody().find("span#descriptionProperties").html("");
			winShowProperties.getModalBody().find("span#descriptionProperties").html(res.property.description);
			winShowProperties.getModalBody().find("span#locationProperties").html("");
			winShowProperties.getModalBody().find("span#locationProperties").html(res.property.address+", "+res.property.town+", "+res.property.country);
			winShowProperties.getModalBody().find("span#statusProperties").html("");
			winShowProperties.getModalBody().find("span#statusProperties").html(res.property.statuses.name);
			winShowProperties.getModalBody().find("table#tableFacilities tbody").html("");
			$.each(res.propertiesFacilities, function(index, value) {
				winShowProperties.getModalBody().find("table#tableFacilities tbody").append('<tr><td>' +value.facilities.name+ '</td></tr>');
			});
		},
		error:function(jqXhr) {
			winShowProperties.getModalBody().find('#divLoadShowProperties').html("");
			$bodyModal.append('<div id="divLoadShowProperties"><div style="text-align: center; color: #337AB7;"><br>ERROR AL CARGAR LOS DATOS</div></div>');
			winShowProperties.getButton('btnCloseWindowShow').enable();
		}
	});
}

function modalEditProperties(btn){
   var route = "/properties/editProperties";

   $.get(route, function(formulario){

      var $bodyModal = $('<div class="row"></div>');

      var winPropertiesEdit = BootstrapDialog.show({
        id       : "modalEditProperties",
        title    : "Editar Inmueble",
        message  : $bodyModal,
        closable : false,
        type     : BootstrapDialog.TYPE_PRIMARY,
        cssClass : 'bootstrap-dialog-view-max', //definido en css personalized
        onshow   : function(dialog) {
          dialog.getButton("updateProperties").disable();
          dialog.getButton('btnCloseWindowUpdate').disable();
        },
        buttons  : [{
          id       : 'btnCloseWindowUpdate',
          icon     : 'fa fa-remove',
          label    : 'Cancelar',
          cssClass : 'btn-default',
          action   : function(dialogItself){
            dialogItself.close();
          }
        },{
          id       : "updateProperties",
          icon     : 'fa fa-refresh',
          label    : 'Actualizar',
          cssClass : 'btn-primary',
          action   : function(dialog) {
            updateProperties();
          }
        }]
      });

      $bodyModal.html('<div id="divFormPropertiesEdit">'+formulario+'</div>');
      winPropertiesEdit.getModalBody().find('#divFormPropertiesEdit').hide();
      editProperties(winPropertiesEdit, $bodyModal, btn);

  });
}


function editProperties(winPropertiesEdit, $bodyModal, btn){
  var route = "/properties/"+btn.value+"/edit";

  $.ajax({
    url        : route,
    type       : 'GET',
    dataType   : 'json',
    beforeSend : function() {
      $bodyModal.append('<div id="divLoadPropertiesEdit"><div style="text-align: center; color: #337AB7;"><br>Por favor espere<br><i class="fa fa-refresh fa-spin fa-2x"></i></div></div>');
    },
    success    : function(res){
      loadStatusesEdit(winPropertiesEdit, $bodyModal, res);
    },
    error      : function(jqXhr){
      winPropertiesEdit.getModalBody().find('#divLoadPropertiesEdit').html("");
      $bodyModal.append('<div id="divLoadPropertiesEdit"><div style="text-align: center; color: #337AB7;"><br>ERROR AL CARGAR LOS DATOS</div></div>');
      winPropertiesEdit.getButton('btnCloseWindowUpdate').enable();
    }
  });
}

function loadStatusesEdit(winPropertiesEdit, $bodyModal, dataProperties) {
	$.ajax({
		url        : "/statuses/all/",
		type       : 'GET',
		dataType   : 'json',
		beforeSend : function() {
			$('#status_id').empty().append('<option value="">Cargando...</option>');
		},
		success    : function(data) {
			var $status = $("#status_id");
			$status.empty();
			$.each(data, function(index, value) {
				$status.append('<option data-tokens="'+ value.name +'" value="'+ value.id +'">' + value.name + '</option>');
				/* Refresco los resultados en el plugin Bootstrap Select */
				$('.selectpicker').selectpicker('refresh');
			});
			$('#status_id > option[value="'+dataProperties.property.status_id+'"]').attr('selected', 'selected');
			/* Habilita menú nativo de dispositivos móviles */
			if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
				$('.selectpicker').selectpicker('mobile');
			}
			loadFacilitiesEdit(winPropertiesEdit, $bodyModal, dataProperties);
		},
		error      : function(jqXhr) {
			winPropertiesEdit.getModalBody().find('#divLoadCreateProperties').html("");
			$bodyModal.append('<div id="divLoadCreateProperties"><div style="text-align: center; color: #337AB7;"><br>ERROR AL CARGAR LOS DATOS EN SELECT ESTADO DE INMUEBLE</div></div>');
			winPropertiesEdit.getButton('btnCloseWindowUpdate').enable();
		}
	});
}

function loadFacilitiesEdit(winPropertiesEdit, $bodyModal, dataProperties) {
	$.ajax({
		url        : "/facilities/all/",
		type       : 'GET',
		dataType   : 'json',
		beforeSend : function() {
			$('#facility_id').empty().append('<option value="">Cargando...</option>');
		},
		success    : function(data) {
			var $facility = $("#facility_id");
			$facility.empty();
			$.each(data, function(index, value) {
				$facility.append('<option data-tokens="'+ value.name +'" value="'+ value.id +'">' + value.name + '</option>');
				/* Refresco los resultados en el plugin Bootstrap Select */
				$('.selectpicker').selectpicker('refresh');
			});
			$.each(dataProperties.propertiesFacilities, function(index, value) {
				$('#facility_id > option[value="'+value.facility_id+'"]').attr('selected', 'selected');
				$('.selectpicker').selectpicker('refresh');
			});
			/* Habilita menú nativo de dispositivos móviles */
			if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
				$('.selectpicker').selectpicker('mobile');
			}
			layoutModalInventoryEdit(winPropertiesEdit, dataProperties)
		},
		error      : function(jqXhr) {
			winPropertiesEdit.getModalBody().find('#divLoadCreateProperties').html("");
			$bodyModal.append('<div id="divLoadCreateProperties"><div style="text-align: center; color: #337AB7;"><br>ERROR AL CARGAR LOS DATOS EN SELECT ESTADO DE INMUEBLE</div></div>');
			winPropertiesEdit.getButton('btnCloseWindowUpdate').enable();
		}
	});
}

//Inserción de formulario, efecto fadeIn, habilitación de botones
function layoutModalInventoryEdit(winPropertiesEdit, dataProperties){
	winPropertiesEdit.getModalBody().find('#id').val(dataProperties.property.id);
	winPropertiesEdit.getModalBody().find('#title').val(dataProperties.property.title);
	winPropertiesEdit.getModalBody().find('#description').val(dataProperties.property.description);
	winPropertiesEdit.getModalBody().find('#address').val(dataProperties.property.address);
	winPropertiesEdit.getModalBody().find('#town').val(dataProperties.property.town);
	winPropertiesEdit.getModalBody().find('#country').val(dataProperties.property.country);
	//Efecto FadeIn, fin capa carga
	winPropertiesEdit.getModalBody().find('#divLoadPropertiesEdit').html("");
	winPropertiesEdit.getModalBody().find('#divFormPropertiesEdit').fadeIn();
	//Habilitación de botones
	winPropertiesEdit.getButton("updateProperties").enable();
	winPropertiesEdit.getButton('btnCloseWindowUpdate').enable();
}

function updateProperties(){
	if ( $('#formEditProperties').validate().form() ){
		var value = $("#id").val();
		var selectedFacilities = [];
		var title = $("#title").val();
		var description = $("#description").val();
		var address = $("#address").val();
		var town = $("#town").val();
		var country = $("#country").val();
		var status_id = $("#status_id").val();
		$('#facility_id').selectpicker('refresh');
		$.each($("#facility_id option:selected"), function() {
			selectedFacilities.push($(this).val());
		});
		var route = "properties/"+value+"";
		var token = $("#token").val();

		$.ajax({
			url      : route,
			headers  : {'X-CSRF-TOKEN': token},
			type     : 'PUT',
			dataType : 'json',
			data     : {
				title       : title,
				description : description,
				address     : address,
				town        : town,
				country     : country,
				status_id   : status_id,
				facility_id : selectedFacilities
			},
			success  : function(respuesta){
				$("#modalEditProperties").modal('toggle');
				mensajeOk(respuesta.message);
				reloadTableProperties();
			},
			error    : function(jqXhr){
				var respuesta = jqXhr.responseJSON;
				if( jqXhr.status === 401 ) $(location).prop( 'pathname', '/' );
				if( jqXhr.status === 422 ) {
					var errorsHtml= '';
					$.each(respuesta.errors, function(index, value) {
						errorsHtml += '<li>' + value + '</li>';
					});
					mensajeErrorWindow(errorsHtml);
				}
				if( jqXhr.status === 500 ) {
					if( respuesta.updated === false ) { //error de actualización
						mensajeErrorWindowSingle(respuesta.message+".<br>Motivo: Error transaccional interno del servidor.");
					}
				}
			}
		});
	}
}

function deleteProperties(btn) {
	BootstrapDialog.confirm({
		id             : "modalDeleteProperties",
		title          : 'Eliminar Inmueble',
		message        : 'Atención! Desea eliminar el inmueble: '+$(btn).attr('data-title')+"?",
		type           : BootstrapDialog.TYPE_DANGER, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
		closable       : false, // <-- Default value is false
		draggable      : false, // <-- Default value is false
		btnCancelLabel : '<span class="fa fa-remove"></span> Cancelar', // <-- Default value is 'Cancel',
		btnOKLabel     : '<span class="fa fa-check"></span> Sí! Deseo eliminar', // <-- Default value is 'OK',
		btnOKClass     : 'btn-danger',
		callback       : function(result) {
			if(result) {
				confirmDeleteProperties(btn);
			}
		}
	});
}

function confirmDeleteProperties(btn) {
	var route = "/properties/"+btn.value+"";
	var token = $("#token").val();

	$.ajax({
		url      : route,
		headers  : {'X-CSRF-TOKEN': token},
		type     : 'DELETE',
		dataType : 'json',
		success  : function(respuesta) {
			mensajeOk(respuesta.message);
			reloadTableProperties();
		},
		error:function(jqXhr) {
			if( jqXhr.status === 422 ) {
				var errors = jqXhr.responseJSON;
				var errorsHtml= '';

				$.each(errors, function(index, value) {
					errorsHtml += '<li>' + value + '</li>';
				});
				mensajeErrorWindow(errorsHtml);
			}
			if( jqXhr.status === 500 ) {
				if( respuesta.deleted === false ) { //error de eliminación
					mensajeErrorSingle(respuesta.message+".<br>Motivo: Error transaccional interno del servidor.");
				}
			}
		}
	});
}

//Recargar tabla al cliquear Pestaña Inventario (Inventory)
$('.nav-tabs-custom a[href="#tabProperties"]').click(function(e){
	e.preventDefault();
	reloadTableProperties();
});

//Limpiar form
$("#reloadProperties").click(function(e){
	e.preventDefault();
	$('#formProperties').trigger('reset'); //limpio valores
	$('#formProperties').validate().resetForm(); //reinicio validate
});

//Botón "Reiniciar Búsqueda" (Inmuebles)
$("#reloadFormSearchProperties").click(function(e){
	e.preventDefault();
	reloadTableProperties();
});

//Botón "Refrescar" (Debe tomar en cuenta si hay valores en el textfield de búsqueda)
$("#refreshTableProperties").click(function(e){
	e.preventDefault();
	getListProperties();
});

//Toma como base los valores de búsqueda para mostrar resultados.
function reloadTableProperties(){
  $('#formSearchProperties').trigger('reset');
  $("#searchCriteriaProperties").attr('disabled','disabled');
  getListProperties();
}

//Descargar PDF
$("#downloadPDFProperties").click(function(e){
	e.preventDefault();
    console.log("descargando PDF");
});

//Descargar Excel
$("#downloadExcelProperties").click(function(e){
	e.preventDefault();
    console.log("descargando Excel");
});