<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Nextdots | Application</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.5 -->
	{!!Html::style('bootstrap/css/bootstrap.min.css')!!}
	<!-- Font Awesome -->
	{!!Html::style('fonts/font-awesome.min.css')!!}
	<!-- Ionicons -->
	{!!Html::style('fonts/ionicons.min.css')!!}
	<!-- Theme style -->
	{!!Html::style('dist/css/AdminLTE.min.css')!!}
	<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
	{!!Html::style('dist/css/skins/_all-skins.min.css')!!}
	    <!-- Bootstrap datetimepicker -->
	{!!Html::style('plugins/datetimepicker/bootstrap-datetimepicker.min.css')!!}
	<!-- Datatables -->
	{!!Html::style('plugins/datatables/dataTables.bootstrap.css')!!}
	<!-- Bootstrap Dialog Master -->
	{!!Html::style('plugins/bootstrap3-dialog-master/css/bootstrap-dialog.min.css')!!}
	<!-- Fileinput Upload Images -->
	{!!Html::style('css/fileinput.css')!!}
	<!-- Bootstrap Select -->
	{!!Html::style('plugins/bootstrap-select/css/bootstrap-select.min.css')!!}
	<!-- Personalizados -->
	{!!Html::style('css/load.css')!!}
	{!!Html::style('css/botones.css')!!}
	{!!Html::style('css/tabs.css')!!}
	{!!Html::style('css/texto.css')!!}
	{!!Html::style('css/bootstrap-dialog-personalized.min.css')!!}
	{!!Html::style('css/table-responsive-personalized.min.css')!!}

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	</head>
	<body class="hold-transition skin-blue fixed sidebar-mini">
	@include('layouts.home.sections.load')
	
		<div class="wrapper">
			@include('layouts.home.sections.header')
			@include('layouts.home.sections.menu')
			@yield('content')
			@include('layouts.home.sections.footer')
			@include('layouts.home.sections.menu-aux')
		</div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
	{!!Html::script('plugins/jQuery/jQuery-2.1.4.min.js')!!}
    <!-- jQuery UI 1.11.4 -->
	{!!Html::script('plugins/jQueryUI/jquery-ui.min.js')!!}
	<!-- Capa carga del DOM. Debe ir aquí sino da problemas -->
	{!!Html::script('js/load.js')!!}
	{!!Html::script('js/globalError.js')!!}
	{!!Html::script('js/selectMenu.js')!!}
	{!!Html::script('js/enlaces.js')!!}
    {!!Html::script('js/redir.js')!!}
    {!!Html::script('js/mensajes.js')!!}
	{!!Html::script('plugins/validator/jquery.validate.min.js')!!}
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
	{!!Html::script('bootstrap/js/bootstrap.min.js')!!}
	<!-- Datatables -->
	{!!Html::script('plugins/datatables/jquery.dataTables.min.js')!!}
    {!!Html::script('plugins/datatables/dataTables.bootstrap.js')!!}
	<!-- Bootstrap Dialog Master -->
    {!!Html::script('plugins/bootstrap3-dialog-master/js/bootstrap-dialog.min.js')!!}
	<!-- Bootstrap Select -->
    {!!Html::script('plugins/bootstrap-select/js/bootstrap-select.min.js')!!}
    {!!Html::script('plugins/bootstrap-select/js/i18n/defaults-es_CL.min.js')!!}
    <!-- datetimepicker -->
    {!!Html::script('plugins/datetimepicker/moment.js')!!}
    {!!Html::script('plugins/datetimepicker/bootstrap-datetimepicker.min.js')!!}
    <!-- Slimscroll -->
	{!!Html::script('plugins/slimScroll/jquery.slimscroll.min.js')!!}
    <!-- FastClick -->
	{!!Html::script('plugins/fastclick/fastclick.min.js')!!}
    <!-- AdminLTE App -->
	{!!Html::script('dist/js/app.min.js')!!}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	{!!Html::script('dist/js/pages/dashboard.js')!!}
    <!-- AdminLTE for demo purposes -->
	{!!Html::script('dist/js/demo.js')!!}
	{!!Html::script('js/fileinput.min.js')!!}
	{!!Html::script('js/logout.js')!!}  
	
	@section('scripts')
	@endsection
	
  </body>
</html>
