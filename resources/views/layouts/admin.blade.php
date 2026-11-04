<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel='shortcut icon' href='gambar/sistem/frauddetection.png'>
    <title>@yield('title', 'Fraud Detection System')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/fontawesome-free/css/all.min.css" />
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('AdminLTE')}}/dist/css/adminlte.min.css" />
    <link rel="stylesheet" href="{{asset('css/theme.css')}}" />

    <link rel="stylesheet" href="{{asset('font/css/all.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('styles')
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item icons dropdown d-none d-md-flex">
                    <a href="javascript:void(0)" class="log-user"  data-toggle="dropdown">
                        <span class="avatar-initial">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        <span>{{ Auth::user()->name }}</span>  <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
                    </a>
                    <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                        <div class="dropdown-content-body">
                            <ul>
                                <li>
                                  <span>{{ Auth::user()->name }}</span>
                                  <br> 
                                  <span class="text-muted">{{ Auth::user()->email }}</span>
                              </li>

                              <hr class="my-2">

                              <li>
                                  <a href='/password'><i class="icon-lock"></i> <span>Ganti Password</span></a>
                              </li>
                              <li>
                                  <form id="logout-form" action='/logout' method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <a href='/logout' onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="icon-key"></i> <span>Logout</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/dashboard" class="brand-link">
                <img src="{{asset('AdminLTE')}}/dist/img/frauddetection.png" alt="frauddetection" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
                <span class="brand-text font-weight-light">Fraud Detection</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <span class="avatar-initial avatar-initial-sm">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{Auth::user()->name}}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search" />
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
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('data', 'scoring') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Tables
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/data" class="nav-link {{ request()->is('data') ? 'active' : '' }}">
                                        <i class="fa-regular fa-folder-open"></i>
                                        <p>Data Tables</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/scoring" class="nav-link {{ request()->is('scoring') ? 'active' : '' }}">
                                        <i class="fa-solid fa-percent"></i>
                                        <p>Scoring Tables</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @if(Auth::user()->level == "admin")
                        <li class="nav-item {{ request()->is('user*', 'password') ? 'menu-open' : '' }}">
                            <a href="/user" class="nav-link">
                                <i class="fa-solid fa-users"></i>
                                <p>
                                    Users
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/user" class="nav-link {{ request()->is('user', 'user_edit/*') ? 'active' : '' }}">
                                        <i class="fa-solid fa-user"></i>
                                        <p>Data User</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/user_add" class="nav-link {{ request()->is('user_add') ? 'active' : '' }}">
                                        <i class="fa-solid fa-user-plus"></i>
                                        <p>New User</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/password" class="nav-link {{ request()->is('password') ? 'active' : '' }}">
                                        <i class="fa-solid fa-lock"></i>
                                        <p>Change Password</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer main-footer-minimal">
            <div class="float-right d-none d-sm-inline">Fraud Detection System</div>
            <span>&copy; 2024 PT.DIM. by <a href="https://www.DIM-ICT.com" target="_blank" rel="noopener">ICT-DIM</a></span>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{asset('AdminLTE')}}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{asset('AdminLTE')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="{{asset('AdminLTE')}}/dist/js/adminlte.js"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{asset('AdminLTE')}}/plugins/chart.js/Chart.min.js"></script>
    
    {{-- Toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    

    
@if(session('success'))
<script>
    toastr.option = {
        "progressBar" : true,
        "closeButton" : true,
    }
    toastr.success('{{session('success')}}');
</script>
@endif

<script>
    function myFunction(){
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    function currentPassword(){
        var x = document.getElementById("current-password");
        if (x.type === "current-password") {
            x.type = "text";
        } else {
            x.type = "current-password";
        }
    }
    function newPassword(){
        var x = document.getElementById("new-password");
        if (x.type === "new-password") {
            x.type = "text";
        } else {
            x.type = "new-password";
        }
    }
    function newPasswordConfirm(){
        var x = document.getElementById("new-password-confirm");
        if (x.type === "new-password-confirm") {
            x.type = "text";
        } else {
            x.type = "new-password-confirm";
        }
    }
</script>

@stack('scripts')

</body>

</html>