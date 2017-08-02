<table id="tableStatuses" class="table table-bordered table-striped" data-toolbar="#toolbar">
	<thead>
		<tr>
			<th style="display: none;">ID</th>
			<th>Nombre</th>
		</tr>
	</thead>
	<tbody>
	@foreach($statuses as $status)
	<tr>
		<td style="display: none;">{{ $status->id }}</td>
		<td>{{ $status->name }}</td>
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

<div id="infoTableStoreTypes" class="pull-left" style="margin: auto 0;padding-top: 20px;padding-bottom: 20px;">
	Mostrando {!!$statuses->firstItem()!!} - {!!$statuses->lastItem()!!} de un total de {!!$statuses->total()!!} registros
</div>

<div id="paginatorTableStoreTypes" class="pull-right" style="margin: auto 0;">
	{!!$statuses->render()!!}
</div>