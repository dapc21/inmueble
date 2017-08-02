/*==================== PAGINATION =========================*/
$(document).on('click','#paginatorTableProperties a',function(e) {
	e.preventDefault();
	var page = $(this).attr('href').split('page=')[1];
	$.ajax({
		beforeSend : function() {
			$('.contentTableProperties').html('<div style="text-align:center; color: #337AB7; margin: auto 0;">Por favor espere...<br><i class="fa fa-refresh fa-spin fa-2x"></i></div>');
		},
		method     : 'GET',
		url        : '/properties/listProperties?page='+page,
		data       : {
			option : $('#criteriaProperties').val(),
			search : $('#searchCriteriaProperties').val()
		}
	}).done(function(data) {
		$('.contentTableProperties').html(data);
	}).fail(function (jqXHR, textStatus) {
		$('.contentTableProperties').html('<div style="text-align:center; color: #337AB7; margin: auto 0;">Error al cargar los datos.</div>');
	});
});

/*==================== SEARCH CRITERIA =========================*/
$('#searchCriteriaProperties').on('keyup', function () {
	getListProperties();
});

$('#criteriaProperties').on('change', function() {
	var cri = $(this).val();
	$('#searchCriteriaProperties').val('');
	getListProperties();
	if(cri == "") {
		$("#searchCriteriaProperties").attr('disabled','disabled');
	}else{
		$("#searchCriteriaProperties").removeAttr('disabled');
	} //fin if-else
});

var xhr = null;
function getListProperties() {
	if(xhr != null) {
		xhr.abort();
		xhr = null;
	}
	xhr = $.ajax({
		beforeSend : function() {
			$('.contentTableProperties').html('<div style="text-align:center; color: #337AB7; margin: auto 0;">Por favor espere...<br><i class="fa fa-refresh fa-spin fa-2x"></i></div>');
		},
		method     : 'GET',
		url        : '/properties/listProperties?page=1',
		data       :{
			option : $('#criteriaProperties').val(),
			search : $('#searchCriteriaProperties').val()
		}
	}).done(function(data) {
		$('.contentTableProperties').html(data);
	}).fail(function (jqXHR, textStatus) {
		$('.contentTableProperties').html('<div style="text-align:center; color: #337AB7; margin: auto 0;">Error al cargar los datos.</div>');
	});
}