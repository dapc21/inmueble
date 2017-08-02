<section class="content-header">
   <h1>Inmuebles <small>Módulo</small></h1>
   <ol class="breadcrumb"><li><a href="#" id="home"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Inmuebles</li></ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="mjeDisplay"></div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

		<div class="nav-tabs-custom">

            <!-- PESTAÑAS -->
            <ul class="nav nav-tabs">
               <li class="active"><a href="#tabProperties" data-toggle="tab">Inmuebles</a></li>
               <li><a href="#tabFacilities" data-toggle="tab">Servicios</a></li>
               <li><a href="#tabStatuses" data-toggle="tab">Estados de Inmuebles</a></li>
            </ul>

			<!-- Contenido de todas las pestañas -->
			<div class="tab-content">

				<!-- PESTAÑA INMUEBLES -->
				<div class="active tab-pane" id="tabProperties">

					<!-- Barra de Herramientas -->
					<div class="box box-primary box-solid">
						<div class="box-body">
							<div class="form-btn pull-left" style="margin: auto 0;">
								<div class="btn-group form-btn">
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Descargar <span class="fa fa-caret-down"></span></button>
									<ul class="dropdown-menu">
										<li><a href="#" id="downloadPDFProperties">PDF</a></li>
										<li><a href="#" id="downloadExcelProperties">Excel</a></li>
									</ul>
								</div><!-- /btn-group -->
							</div>
							<div class="form-btn pull-right" style="margin: auto 0;">
							   <a href="#" id="refreshTableProperties" class="btn btn-primary"><span class="fa fa-refresh"> Refrescar</a>
							   <a href="#" id="addProperties" class="btn btn-success"><span class="fa fa-plus"></span><span class="fa fa-user"></span> Nuevo Inmueble</a>
							</div>
						</div>
					</div>
					<!-- FIN Barra de Herramientas -->

					<!-- INICIO FILTROS -->
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						{!!Form::open(['id' => 'formSearchProperties'])!!}
						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="margin-top: 5px;">
							{!!Form::select('criteriaProperties',
							[
							''        => 'Seleccione el criterio de búsqueda...',
							'title'   => 'Por Título',
							'address' => 'Por Dirección',
							'town'    => 'Por Poblado/Ciudad',
							'country' => 'Por País',
							'status'  => 'Por Estado',
							],0, ['id' => 'criteriaProperties','class' => 'form-control'])!!}
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="margin-top: 5px;">
							{!!Form::text('searchCriteriaProperties',null,['id'=>'searchCriteriaProperties', 'class'=>'form-control text-uppercase', 'placeholder'=>'Buscar...', 'disabled'=>'disabled'])!!}
						</div>
						{!!Form::close()!!}
						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="margin-top: 5px;">
							<a href="#" id="reloadFormSearchProperties" class="btn btn-block btn-primary"><span class="fa fa-refresh"></span> Reiniciar Búsqueda</a>
						</div>
					</div>
					<!-- FIN FILTROS -->

					<!-- INICIO TABLA INMUEBLES-->
					<div class="box-body table-responsive-personalized">
						<div class="contentTableProperties">
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
							
							<div id="infoTableProperties" class="pull-left" style="margin: auto 0;padding-top: 20px;padding-bottom: 20px;">
								Mostrando {!!$properties->firstItem()!!} - {!!$properties->lastItem()!!} de un total de {!!$properties->total()!!} registros
							</div>

							<div id="paginatorTableProperties" class="pull-right" style="margin: auto 0;">
								{!!$properties->render()!!}
							</div>
							
							
						</div>
					</div>
					<!-- FIN TABLA -->
				</div><!-- /.tab-pane -->

				<!-- PESTAÑA SERVICIOS -->
				<div class="tab-pane" id="tabFacilities">

					<!-- INICIO TABLA SERVICIOS -->
					<div class="box-body table-responsive-personalized">
						<div class="contentTableFacilities">
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
							
							<div id="infoTableFacilities" class="pull-left" style="margin: auto 0;padding-top: 20px;padding-bottom: 20px;">
								Mostrando {!!$facilities->firstItem()!!} - {!!$facilities->lastItem()!!} de un total de {!!$facilities->total()!!} registros
							</div>

							<div id="paginatorTableFacilities" class="pull-right" style="margin: auto 0;">
								{!!$facilities->render()!!}
							</div>
							
							
						</div>
					</div>
					<!-- FIN TABLA -->

				</div><!-- /.tab-pane -->

				<!-- PESTAÑA ESTADOS -->
				<div class="tab-pane" id="tabStatuses">

					<!-- INICIO TABLA ESTADOS-->
					<div class="box-body table-responsive-personalized">
						<div class="contentTableStatuses">
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
							
							<div id="infoTableStatuses" class="pull-left" style="margin: auto 0;padding-top: 20px;padding-bottom: 20px;">
								Mostrando {!!$statuses->firstItem()!!} - {!!$statuses->lastItem()!!} de un total de {!!$statuses->total()!!} registros
							</div>

							<div id="paginatorTableStatuses" class="pull-right" style="margin: auto 0;">
								{!!$statuses->render()!!}
							</div>
							
						</div>
					</div>
					<!-- FIN TABLA -->

				</div><!-- /.tab-pane -->

            </div><!-- /.tab-content -->

		</div><!-- /.nav-tabs-custom -->

		</div><!-- /.col-lg-12 col-md-12 col-sm-12 col-xs-12 -->
	</div><!-- /.row -->
</section>
<script>
$.getScript('js/redir.js');	
$.getScript('js/tableProperty.js');
$.getScript('js/property.js');
</script>