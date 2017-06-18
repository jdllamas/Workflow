<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <title>{{ config('app.name', 'Workflow 360°') }}</title>
    <!-- Bootstrap -->
	<link href="{{ asset('css/workflow/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <!-- Font Awesome -->
    <link href="{{ asset('css/workflow/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"/>
    <!-- NProgress -->
	<link href="{{ asset('css/workflow/vendors/nprogress/nprogress.css') }}" rel="stylesheet"/>
	
	<!-- iCheck -->
    <link href="{{ asset('css/workflow/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="{{ asset('css/workflow/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('css/workflow/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('css/workflow/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
	
	<!-- Datatables -->
    <link href="{{ asset('css/workflow/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/workflow/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/workflow/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/workflow/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/workflow/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
	
	
	
    <!-- Custom Theme Style -->
	<link href="{{ asset('css/workflow/build/css/custom.min.css') }}" rel="stylesheet"/>
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
           <div class="navbar " style="border: 0;">
              <a href="#" class="site_title"><img src="{{URL::asset('/css/workflow/images/logo.png')}}" >&nbsp;<span>Kronos S. &amp; C.</span></a>
            </div>
			<br />
			<!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-check-square-o"></i> Proceso<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/workflow/proceso">Archivador Seguros</a></li>
                    </ul>
                  </li>
				  <!--
				   <li><a><i class="fa fa-sitemap"></i> Operaciones<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
						<li><a>Operacion Workflow<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="level2.html">Actividad</a>
                          </ul>
                        </li>
                        <li><a href="#level1_1">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="level2.html">Level Two</a>
                            </li>
                            <li><a href="#level2_1">Level Two</a>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        <li><a href="#level1_2">Level One</a>
                        </li>
                    </ul>
                  </li>  				                 
				  -->
				  <li><a><i class="fa fa-bar-chart-o"></i> Estadisticas <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="chartjs.html">Estadisticas Generales</a></li>
                    </ul>
                  </li>
				 <!-- 
                  <li><a><i class="fa fa-edit"></i> Indicadores <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="form.html">General Form</a></li>
                      <li><a href="form_advanced.html">Advanced Components</a></li>
                      <li><a href="form_validation.html">Form Validation</a></li>
                      <li><a href="form_wizards.html">Form Wizard</a></li>
                      <li><a href="form_upload.html">Form Upload</a></li>
                      <li><a href="form_buttons.html">Form Buttons</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i>  Reportes <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="tables.html">Tables</a></li>
                      <li><a href="tables_dynamic.html">Table Dynamic</a></li>
                    </ul>
                  </li>
				   <li><a><i class="fa fa-desktop"></i> Elementos<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="general_elements.html">General Elements</a></li>
                      <li><a href="media_gallery.html">Media Gallery</a></li>
                      <li><a href="typography.html">Typography</a></li>
                      <li><a href="icons.html">Icons</a></li>
                      <li><a href="glyphicons.html">Glyphicons</a></li>
                      <li><a href="widgets.html">Widgets</a></li>
                      <li><a href="invoice.html">Invoice</a></li>
                      <li><a href="inbox.html">Inbox</a></li>
                      <li><a href="calendar.html">Calendar</a></li>
                    </ul>
                  </li>
				 -->
				 
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->
			
            <!-- /menu footer buttons -->
			<!--
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
			-->
            <!-- /menu footer buttons -->
          </div>
		  
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{URL::asset('/css/workflow/images/user.png')}}" alt="">{{Session('username')}}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <!--<li><a href="javascript:;"> Perfil registro</a></li>                   
                    <li><a href="javascript:;">Cambiar contraseña</a></li>-->
                    <li><a href="{{ route('logout') }}" 
							onclick="event.preventDefault();document.getElementById('logout-form').submit();">
							<i class="fa fa-sign-out pull-right"></i>Cerrar Sesión
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
						</form>
					</li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
		
		@yield('content');
		
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Workflow 360º <a href="#">Version 2.0 - 2017</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
	
	<!-- jQuery -->
	<script src="{{ URL::asset('css/workflow/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
	<script src="{{ URL::asset('css/workflow/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
	<script src="{{ URL::asset('css/workflow/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
	<script src="{{ URL::asset('css/workflow/vendors/nprogress/nprogress.js') }}"></script>
    <!-- Custom Theme Scripts -->
	<script src="{{ URL::asset('css/workflow/build/js/custom.min.js') }}"></script>
	<!-- Chart.js -->
    <script src="{{ URL::asset('css/workflow/vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- gauge.js -->
    <script src="{{ URL::asset('css/workflow/vendors/gauge.js/dist/gauge.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ URL::asset('css/workflow/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ URL::asset('css/workflow/vendors/iCheck/icheck.min.js') }}"></script>
    <!-- Skycons -->
    <script src="{{ URL::asset('css/workflow/vendors/skycons/skycons.js') }}"></script>
    <!-- Flot -->
    <script src="{{ URL::asset('css/workflow/vendors/Flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('css/workflow/vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('css/workflow/vendors/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ URL::asset('css/workflow/vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ URL::asset('css/workflow/vendors/Flot/jquery.flot.resize.js') }}"></script>
    <!-- Flot plugins -->
    <script src="{{ URL::asset('css/workflow/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ URL::asset('css/workflow/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ URL::asset('css/workflow/vendors/flot.curvedlines/curvedLines.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ URL::asset('css/workflow/vendors/DateJS/build/date.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ URL::asset('css/workflow/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
    <script src="{{ URL::asset('css/workflow/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ URL::asset('css/workflow/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ URL::asset('css/workflow/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ URL::asset('css/workflow/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
	<!-- jQuery Smart Wizard -->
    <script src="{{ URL::asset('css/workflow/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js') }}"></script>
  </body>
</html>