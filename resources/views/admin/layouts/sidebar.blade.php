<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BANSOS</title>

    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    @yield('addCss')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #003366;">
            <!-- Brand Logo -->
            <p href="" class="brand-link"
                style="background-color: #336699; color: #ffffff; text-align: center; height: 5%;">
                <span class="brand-text font-weight-light"> BANTUAN SOSIAL </span>
            </p>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->

                <!-- SidebarSearch Form -->
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open mb-2">
                            <a href="/bansos" class="nav-link active"
                                style="background-color: #336699; color: #ffffff;">
                                <i class="nav-icon fas fa-bars"></i>
                                <p>
                                    Menu

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('reset-form').submit();"
                                class="nav-link" style="background-color: #336699; color: #ffffff;">
                                <i class=" x    fas fa-sign-out-alt"></i>
                                <p>Keluar</p>
                            </a>
                            <form id="reset-form" action="{{ route('reset.data') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- jQuery -->
        <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
        @yield('addJavascript')
</body>

</html>
