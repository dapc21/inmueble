<table id="tableProperties" class="table table-bordered table-striped" data-toolbar="#toolbar">
	<thead>
	  <tr>
		<th style="display: none;">ID</th>
		<th>Título</th>
		<th>Dirección</th>
		<th>Ciudad</th>
		<th>País</th>
		<th>Estado</th>
		<th style="width: 260px">Operaciones</th>
	  </tr>
	</thead>
	<tbody>
	@foreach($properties as $property)
	<?php 
		$status = $property->statuses()->where('id','=',$property->status_id)->first();
	?>
	<tr>
		<td style="display: none;">{{ $property->id }}</td>
		<td>{{ $property->title }}</td>
		<td>{{ $property->address }}</td>
		<td>{{ $property->town }}</td>
		<td>{{ $property->country }}</td>
		@if ($status->name == 'ACTIVO')
			<td><span class="label label-success">{{ $status->name }}</span></td>
		@endif
		@if ($status->name == 'INACTIVO')
			<td><span class="label label-danger">{{ $status->name }}</span></td>
		@endif
		@if ($status->name == 'EN REVISIÓN')
			<td><span class="label label-warning">{{ $status->name }}</span></td>
		@endif
		<td>
			<div class='form-btn'>
				<button value="{!!$property->id!!}" OnClick='modalShowProperties(this);' class='btn btn-success' data-toggle='tooltip' data-placement='top' title='Ver mas...'> <span class='fa fa-ellipsis-h'></span></button>
				<button value="{!!$property->id!!}" OnClick='modalEditProperties(this);' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Editar'> <span class='fa fa-edit'></span></button>
				<button value="{!!$property->id!!}" OnClick='deleteProperties(this);' class='btn btn-danger' data-title="{!!$property->title!!}" data-toggle='tooltip' data-placement='top' title='Eliminar'> <span class='fa fa-trash'></span></button>
			</div>
		</td>
	</tr>
	@endforeach
	</tbody>
	<tfoot>
	  <tr>
		<th style="display: none;">ID</th>
		<th>Título</th>
		<th>Dirección</th>
		<th>Ciudad</th>
		<th>País</th>
		<th>Estado</th>
		<th style="width: 260px">Operaciones</th>
	  </tr>
	</tfoot>
</table>


<div id="infoTableStore" class="pull-left" style="margin: auto 0;padding-top: 20px;padding-bottom: 20px;">
	Mostrando {!!$properties->firstItem()!!} - {!!$properties->lastItem()!!} de un total de {!!$properties->total()!!} registros
</div>

<div id="paginatorTableStore" class="pull-right" style="margin: auto 0;">
	{!!$properties->render()!!}
</div>