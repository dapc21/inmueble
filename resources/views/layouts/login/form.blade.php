<div class="login-logo">
	<a href="#"><b>Next</b>dots</a>
</div><!-- /.login-logo -->
<div class="login-box-body">
	<p class="login-box-msg">Ingrese al sistema</p>

    {!!Form::open(['id'=>'formLogin'])!!}
	<div class="mjeDisplay"></div>
	<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
	<div class="form-group has-feedback">
		{!!Form::text('username',null,['id'=>'username','class'=>'form-control text-uppercase','placeholder'=>'Nombre de Usuario'])!!}
		<span class="glyphicon glyphicon-user form-control-feedback"></span>
	</div>
	<div class="form-group has-feedback">
		{!!Form::password('password',['id'=>'password','class'=>'form-control text-uppercase','placeholder' => 'Contraseña'])!!}
		<span class="glyphicon glyphicon-lock form-control-feedback"></span>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<!-- {!!Form::submit('Iniciar',['class'=>'btn btn-primary btn-block btn-flat'])!!} -->
        {!!link_to('#', $title = 'Iniciar', $attributes = ['id'=>'iniciarSesion', 'class'=>'btn btn-primary btn-block btn-flat'], $secure = null)!!}
		</div><!-- /.col -->
	</div>
	{!!Form::close()!!}
    <div class="social-auth-links text-center"> </div><!-- /.social-auth-links -->
    <!--<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        {!!link_to('#', $title = 'Olvidaste tu contraseña?', $attributes = null, $secure = null)!!}
        </div>
    </div>-->

</div><!-- /.login-box-body -->