<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="mjeDisplayWindow"></div>
		</div>
	</div>
	{!!Form::open(['id' => 'formEditProperties'])!!}
	<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
	<input type="hidden" id="id">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
			{!!Form::label('title','Título:')!!} <span class="label label-danger">*requerido</span>
			{!!Form::text('title',null,['id'=>'title','class'=>'form-control text-uppercase','placeholder'=>'INGRESE EL TÍTULO DEL INMUEBLE'])!!}
		</div>
		<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
			{!!Form::label('status_id','Estado:')!!} <span class="label label-danger">*requerido</span>
			{!!Form::select('status_id',['' => 'SELECCIONE EL ESTADO DEL INMUEBLE'],0, ['id' => 'status_id', 'class' => 'selectpicker form-control', 'data-live-search' => 'true'])!!}
		</div>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
			{!!Form::label('facility_id','Servicios:')!!} <span class="label label-danger">*requerido</span>
			{!!Form::select('facility_id',['' => 'SELECCIONE EL/LOS SERVICIO(S) DEL INMUEBLE'],0, ['id' => 'facility_id', 'class' => 'selectpicker form-control', 'data-live-search' => 'true', 'multiple' => 'multiple'])!!}
		</div>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
			{!!Form::label('description','Descripción:')!!}
			{!!Form::textarea('description',null,['id'=>'description','class'=>'form-control text-uppercase','size' => '1x2','placeholder'=>'INGRESE LA DESCRIPCIÓN DEL INMUEBLE...'])!!}
		</div>
		<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
			{!!Form::label('address','Dirección:')!!} <span class="label label-danger">*requerido</span>
			{!!Form::textarea('address',null,['id'=>'address','class'=>'form-control text-uppercase','size' => '1x2','placeholder'=>'INGRESE LA DIRECCIÓN DEL INMUEBLE...'])!!}
		</div>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
			{!!Form::label('town','Poblado/Ciudad:')!!} <span class="label label-danger">*requerido</span>
			{!!Form::text('town',null,['id'=>'town','class'=>'form-control text-uppercase','placeholder'=>'INGRESE EL POBLADO/CIUDAD'])!!}
		</div>
		<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
			{!!Form::label('country','País:')!!} <span class="label label-danger">*requerido</span>
			{!!Form::text('country',null,['id'=>'country','class'=>'form-control text-uppercase','placeholder'=>'INGRESE EL PAÍS'])!!}
		</div>
	</div>
	{!!Form::close()!!}
</div>
<script>
$('.selectpicker').selectpicker({
	style : 'btn-default',
	width : '100%'
});
$.getScript('js/validateFormEditProperty.js');
</script>