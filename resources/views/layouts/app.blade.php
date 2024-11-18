<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- ICheck -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">

    <!-- OverlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

    <!-- Sweet Alert2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <!-- AdminLTE App -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light elevation-1">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                {{-- <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search fa-lg"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li> --}}

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell fa-lg"></i>
                        <span class="badge badge-warning navbar-badge">8</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">8 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-envelope mr-2"></i> 2 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-users mr-2"></i> 3 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item dropdown-footer" href="#">See All Notifications</a>
                    </div>
                </li>

                <!-- User Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <span class="text-gray-500 small mr-2">{{ Auth::user()->nombres }}</span>
                        <i class="far fa-user-circle fa-lg text-primary"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">
                            <i class="far fa-user mr-2"></i>
                            {{ __('Perfil') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                {{ __('Cerrar Sesión') }}
                            </a>
                        </form>
                    </div>
                </li>

                {{-- <!-- Full Screen -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li> --}}
            </ul>
        </nav>

        <!-- Main Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a class="brand-link elevation-1" href="#">
                <img src="{{ asset('adminlte/img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                {{-- <span class="brand-text" data-toggle="tooltip" title="Sistema de Información para la Gestion y Control de Materiales de Formación">
                    SIGMAF
                </span> --}}

                <span class="brand-text" data-toggle="tooltip" title="Sistema de Información y Gestión para la Operación en Telecomunicaciones">
                    SIGPOT
                </span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        @foreach($modulos as $modulo)
                            <li class="nav-item">
                                @if($modulo->ruta == null)
                                    <x-nav-link href="#">
                                        <i class="nav-icon {{ $modulo->icono }}"></i>
                                        <p>
                                            {{ $modulo->modulo }}
                                            <i class="right fas fa-angle-left"></i>   
                                        </p>
                                    </x-nav-link>
                                    <ul class="nav nav-treeview">
                                        @foreach($modulo->hijos as $submodulo)
                                            <li class="nav-item">
                                                @if($submodulo->ruta == null)
                                                    @if (ucfirst(explode(".", Route::currentRouteName())[0]) == $submodulo->modulo)
                                                        <x-nav-link href="#" class="active">
                                                            <i class="nav-icon {{ $submodulo->icono }}"></i>
                                                            <p>
                                                                {{ $submodulo->modulo }}
                                                                <i class="right fas fa-angle-left"></i>   
                                                            </p>
                                                        </x-nav-link>  
                                                    @else
                                                        <x-nav-link href="#">  
                                                            <i class="nav-icon {{ $submodulo->icono }}"></i>
                                                            <p>
                                                                {{ $submodulo->modulo }}
                                                                <i class="right fas fa-angle-left"></i>   
                                                            </p>
                                                        </x-nav-link>
                                                    @endif
                                                        
                                                    <ul class="nav nav-treeview">
                                                        @foreach($submodulo->hijos as $itemModulo)
                                                            <li class="nav-item">
                                                                <x-nav-link :href="route($itemModulo->ruta)" :active="request()->routeIs($itemModulo->ruta)">
                                                                    <i class="{{ $itemModulo->icono }} nav-icon"></i>
                                                                    <p>{{ $itemModulo->modulo }}</p>
                                                                </x-nav-link>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <x-nav-link :href="route($submodulo->ruta)" :active="request()->routeIs($submodulo->ruta)">
                                                        <i class="{{ $submodulo->icono }} nav-icon"></i>
                                                        <p>{{ $submodulo->modulo }}</p>
                                                    </x-nav-link>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <x-nav-link :href="route($modulo->ruta)" :active="request()->routeIs($modulo->ruta)">                                    
                                        <i class="{{ $modulo->icono }} nav-icon"></i>
                                        <p>{{ $modulo->modulo }}</p>
                                    </x-nav-link>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Page Content -->
        <div class="content-wrapper">
            <!-- Header Content -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-12">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                                <li class="breadcrumb-item active">{{ $page ?? '' }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <section class="content">
                <div class="container-fluid">
                    @include('sweetalert::alert')
                    {{ $slot }}
                </div>
            </section>
        </div>

        <!-- Page Foot -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2024 - <a href="#">Fabrica de Software CTPI</a></strong>
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0
            </div>
        </footer>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js')}}"></script>

    <!-- Moment -->
    <script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>

    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <!-- Sweet Alert2 -->
    <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/js/adminlte.js') }}"></script>

    <script>
        $(function () {
            // Tooltip
            $('[data-toggle="tooltip"]').tooltip();
    
            // Select2
            $(".select2").select2();
    
            // Date picker
            $("#fecha_inicio, #fecha_fin").datetimepicker({
                format: 'YYYY/MM/DD',
                locale: 'es'
            });
    
            $("#fecha_reporte, #fecha_cierre").datetimepicker({
                format: 'YYYY/MM/DD',
                locale: 'es'
            });
    
            $("#fecha_entrada, #fecha_entrada").datetimepicker({
                format: 'YYYY/MM/DD',
                locale: 'es'
            });
    
            // Searcher table personalizado
            $("#searchertable").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#datatable tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
   
        });
    </script>
    
</body>

</html>