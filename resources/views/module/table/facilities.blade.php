<table id="tableFacilities" class="table table-bordered table-striped" data-toolbar="#toolbar">
	<thead>
	  <tr>
		<th style="display: none;">ID</th>
		<th>Nombre</th>
	  </tr>
	</thead>
	<tbody>
	@foreach($facilities as $facility)
	<tr>
		<td style="display: none;">{{ $facility->id }}</td>
		<td>{{ $facility->name }}</td>
	</tr>
	@endforeach
	</tbody>
	<tfoot>
	  <tr>
		<th style="display: none;">ID</th>
		<th>Nombre</th>
	  </tr>
	</tfoot>
</table>

<div id="infoTableManagers" class="pull-left" style="margin: auto 0;padding-top: 20px;padding-bottom: 20px;">
	Mostrando {!!$facilities->firstItem()!!} - {!!$facilities->lastItem()!!} de un total de {!!$facilities->total()!!} registros
</div>

<div id="paginatorTableManagers" class="pull-right" style="margin: auto 0;">
	{!!$facilities->render()!!}
</div>