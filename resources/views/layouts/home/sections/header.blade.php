<header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>ALT</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Next</b>dots</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span id="imgAvatarHeader">
                    {!!Html::image('uploads/avatar.png', 'Foto de Perfil', array('class' => 'user-image'))!!}
                  </span>
                  <span class="hidden-xs">{!!Auth::user()->username!!}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li id="imgAvatarHeaderCircle" class="user-header">
                    {!!Html::image('uploads/avatar.png', 'Foto de Perfil', array('class' => 'img-circle'))!!}
                    <p>
                      {!!substr(Auth::user()->firstname, 0, 10)!!} {!!substr(Auth::user()->lastname, 0, 10)!!}
                      <small>Miembro desde {!!substr(date_format(Auth::user()->created_at, 'd/m/Y'), 0, 10)!!}</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <!--div class="pull-left">
                      <a href="#" id="userProfile" class="btn btn-default btn-flat">Perfil</a>
                    </div-->
                    <div class="pull-right">
                      <input type="hidden" name="user_token" id="user_token" value="{{ csrf_token() }}">
                      <a href="#" id="cerrarSesion" class="btn btn-default btn-flat">Salir</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>