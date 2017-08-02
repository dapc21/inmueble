/** mensajes exclusivos para login. NOTA: no poseen closable **/
function mjeOk(texto) {
	$(".mjeDisplay").html("<div class='alert alert-success alert-dismissable'><i class='fa fa-check'></i><b>"+texto+"</b></div>");
}

function mjeInfo(texto) {
	$(".mjeDisplay").html("<div class='alert alert-info alert-dismissable'><i class='fa fa-info'></i><b>"+texto+"</b></div>");
}

function mjeError(texto) {
	$(".mjeDisplay").html("<div class='alert alert-danger alert-dismissable'><i class='fa fa-times'></i><b>"+texto+"</b></div>");
}
function mensajeErrorWindow(texto) {
	$(".mjeDisplayWindow").html("<div class='alert alert-danger alert-dismissable'><i class='fa fa-times'></i><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>&nbsp;<b>Por favor corrija el/los siguiente(s) error(es):</b></br><b>"+texto+"</b></div>");
}
function mensajeErrorWindowSingle(texto) {
	$(".mjeDisplayWindow").html("<div class='alert alert-danger alert-dismissable'><i class='fa fa-times'></i><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>&nbsp;<b>"+texto+"</b></div>");
}
function mensajeWindowLimpio() {
	$(".mjeDisplayWindow").html("");
}

/** mensajes para formularios de la aplicación **/
function mensajeOk(texto) {
	$(".mjeDisplay").html("<div class='alert alert-success alert-dismissable'><i class='fa fa-check'></i><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>&nbsp;<b>"+texto+"</b></div>");
}

function mensajeInfo(texto) {
	$(".mjeDisplay").html("<div class='alert alert-info alert-dismissable'><i class='fa fa-info'></i><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>&nbsp;<b>"+texto+"</b></div>");
}
function mensajeError(texto) {
	$(".mjeDisplay").html("<div class='alert alert-danger alert-dismissable'><i class='fa fa-times'></i><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>&nbsp;<b>Por favor corrija el/los siguiente(s) error(es):</b></br><b>"+texto+"</b></div>");
}
function mensajeErrorSingle(texto) {
	$(".mjeDisplay").html("<div class='alert alert-danger alert-dismissable'><i class='fa fa-times'></i><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>&nbsp;<b>"+texto+"</b></div>");
}
function mensajeDelete(texto) {
	$(".mjeDisplay").html("<div class='alert alert-danger alert-dismissable'><i class='fa fa-trash-o'></i><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>&nbsp;<b>"+texto+"</b></div>");
}
function mjeEfecto() {
	$(".alert").effect("highlight", {color:"#ffff99"}, 1000);
}

function mensajeLimpio() {
	$(".mjeDisplay").html("");
}