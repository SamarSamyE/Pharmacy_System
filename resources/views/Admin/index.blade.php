<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <ul class="navbar-nav ms-auto ">
                    <!-- Authentication Links -->
                    @guest
                    @if (Route::has('login'))
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ ('Login') }}</a>
                      </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->name }}
                      </a>

                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('login') }}" onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                  {{ ('Logout') }}
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                          </form>
                      </div>
                        </li>
                        @endguest
                </ul>
      </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">


   </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Pharmacy System</span>
    </a>

    <!-- Sidebar -->

    <div class="sidebar">
      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-header">Pages</li>
        @role('doctor')
        <li class="nav-item">
            <a href="{{ route('doctors.index')}}" class="nav-link">
              <i class="nav-icon far fa-solid fa-hospital"></i>
              <p>
                Profile
              </p>
            </a>
          </li>
        @endrole
        @role('pharmacy')
        <li class="nav-item">
            <a href="{{ route('pharmacies.index')}}" class="nav-link">
              <i class="nav-icon far fa-solid fa-hospital"></i>
              <p>
                Profile
              </p>
            </a>
          </li>
        @endrole
        @role('admin')
          <li class="nav-item">
            <a href="{{ route('pharmacies.index')}}" class="nav-link">
              <i class="nav-icon far fa-solid fa-hospital"></i>
              <p>
                Pharmacies
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('patients.index')}}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('areas.index')}}" class="nav-link">
              <i class="nav-icon fas ion-ios-location"></i>
              <p>
                Areas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('patientsAddress.index') }}" class="nav-link">
              <i class="nav-icon fas ion-ios-location"></i>
              <p>
                Users Addresses
              </p>
            </a>
          </li>
          @endrole
          @hasanyrole("admin|pharmacy")
          <li class="nav-item">
            <a href="{{ route('doctors.index')}}" class="nav-link">
              <i class="nav-icon far fa-user"></i>
              <p>
                Doctors
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('revenues.index')}}" class="nav-link">
              <i class="nav-icon fas ion-social-usd-outline"></i>
              <p>
                Revenue
              </p>
            </a>
          </li>
          @endrole
          @hasanyrole("admin|pharmacy|doctor")
          <li class="nav-item">
            <a href="{{ route('medicines.index')}}" class="nav-link">
              <i class="nav-icon fas fa-pills"></i>
              <p>
                Medicines
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/kanban.html" class="nav-link">
              <i class="nav-icon fas ion-bag"></i>
              <p>
                Orders
              </p>
            </a>
          </li>
          @endrole
                   <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Charts
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/charts/chartjs.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ChartJS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/flot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Flot</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/inline.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inline</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/uplot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>uPlot</p>
                </a>
              </li>
            </ul>
          </li>

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            @role('admin')
            <h1 class="m-0">You logged in as an Admin </h1>
            @endrole
            @role('pharmacy')
            <h1 class="m-0">You logged in as an Pharmacy </h1>
            @endrole
            @role('doctor')
            <h1 class="m-0">You logged in as as Doctor </h1>
            @endrole

          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            @role('admin')
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info" style="height: 150px">
              <div class="inner">
                <p>New Pharmacy</p>
              </div>
              <div class="icon">
              <i class="ion ion-medkit"></i>
          </div>

            </div>
          </div>

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning" style="height: 150px">
              <div class="inner">
                    <p>New Area</p>
              </div>
              <div class="icon">
                <i class="ion ion-location"></i>
              </div>

            </div>
          </div>
          @endrole
          @hasanyrole("admin|pharmacy")
          <div class="col-lg-3 col-6" >
            <!-- small box -->
            <div class="small-box bg-success" style="height: 150px">
              <div class="inner">
                    <p>New Doctor</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
          @endrole
          @hasanyrole("admin|pharmacy|doctor")
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div  style="height: 150px" class="small-box bg-danger ">
              <div class="inner">
                <p>New Medicine</p>
              </div>
              <div class="icon">
              <i class="nav-icon fas fa-pills"></i>
          </div>
            </div>
          </div>
          @endrole
          <!-- ./col -->

           <!-- ./col -->
        </div>

          </section>

         </div>
      </div><!-- /.container-fluid -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
</body>
</html>

