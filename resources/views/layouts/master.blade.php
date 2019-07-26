<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>DREAM SOFT BD </title>

  <!-- Bootstrap core CSS -->

  <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">

  <link href="{{asset('assets/fonts/css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/css/animate.min.css')}}" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
  <link href="{{asset('assets/css/icheck/flat/green.css')}}" rel="stylesheet">
  <link href="{{asset('assets/js/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />

  <script src="{{asset('assets/js/jquery.min.js')}}"></script>

  <script src="{{asset('assets/js/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('assets/js/datatables/dataTables.bootstrap.js')}}"></script>

  @yield('js_content')

  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>


<body class="nav-md">

  <div class="container body">


    <div class="main_container">

      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">

          <div class="navbar nav_title" style="border: 0;">
            <a href="{{route('home')}}" class="site_title"><i class="fa fa-paw"></i> <span>Management</span></a>
          </div>
          <div class="clearfix"></div>

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
              <h3>General</h3>
              <ul class="nav side-menu">
                <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a>
                </li>
                <li><a><i class="fa fa-desktop"></i> Purchase <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="{{ route('purchase') }}">New</a>
                    </li>
                    <li><a href="{{ route('purchases') }}">View</a>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-table"></i> Sale <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="{{ route('sale') }}">New</a>
                    </li>
                    <li><a href="{{ route('sales') }}">View</a>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-bar-chart-o"></i> Return <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="{{ route('return') }}">Add</a>
                    </li>
                    <li><a href="{{ route('returns') }}">View</a>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-bug"></i> Finance <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="{{ route('finance') }}">Add</a>
                    </li>
                    <li><a href="{{ route('finance') }}">View</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
            <div class="menu_section">
              <h3>Monitoring</h3>
              <ul class="nav side-menu">
                <li><a><i class="fa fa-windows"></i> Report <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="{{ route('inventory_report') }}">Inventory</a>
                    </li>
                    <li><a href="{{ route('finance_report') }}">finance</a>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-edit"></i> Setting <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="{{route('categories')}}">Category</a>
                    </li>
                    <li><a href="{{route('items')}}">Item</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>

            <div class="menu_section">
              <h3>ACL</h3>
              <ul class="nav side-menu">
                <li><a><i class="glyphicon glyphicon-cog"></i>&nbsp;User <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="{{ route('register') }}">Registration</a>
                    </li>
                    <li><a href="{{ route('register') }}">View</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>

          </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
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
            <a data-toggle="tooltip" data-placement="top" title="Logout">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div>
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">

        <div class="nav_menu">
          <nav class="" role="navigation">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <!-- <img src="{{asset('assets/images/img.jpg')}}" alt=""> -->{{ Auth::user()->username }} <span class="caret"></span>
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                  <li>
                      <a href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                          Logout
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

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
                  <small>
                      INVENTORY MANAGEMENT SYSTEM
                  </small>
              </h3>
            </div>
          </div>
        </div>
        @yield('content')
        <!-- footer content -->
        <footer>
          <div align="center" class="copyright-info">
            <p>Copyright @ <a href="https://dreamsoftbd.com">DREAM-SOFT(BD)</a>    
            </p>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->

      </div>
      <!-- /page content -->
    </div>

  </div>

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

  <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>

  <!-- bootstrap progress js -->
  <script src="{{asset('assets/js/progressbar/bootstrap-progressbar.min.js')}}"></script>
  <script src="{{asset('assets/js/nicescroll/jquery.nicescroll.min.js')}}"></script>
  <!-- icheck -->
  <script src="{{asset('assets/js/icheck/icheck.min.js')}}"></script>
  <!-- pace -->
  <script src="{{asset('assets/js/pace/pace.min.js')}}"></script>
  <script src="{{asset('assets/js/custom.js')}}"></script>

</body>

</html>
