      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div id="imgAvatarMenu" class="pull-left image">
                {!!Html::image('uploads/avatar.png', 'Foto de Perfil', array('class' => 'img-circle'))!!}
            </div>
            <div class="pull-left info">
              <p>Hola, <span id="firstNameMenu">{!!substr(Auth::user()->firstname, 0, 10)!!}</span></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MENÚ</li>
            <li class="active">
              <a class="item" href="#" id="itemHome">
                <i class="fa fa-dashboard"></i> <span>Home</span>
              </a>
            </li>
            <li>
              <a class="item" href="#" id="itemProperties">
                <i class="fa fa-file-text"></i> <span>Inmuebles</span>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>