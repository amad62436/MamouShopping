<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="{{asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{asset('admin/plugins/jqvmap/jqvmap.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{asset('admin/plugins/daterangepicker/daterangepicker.css')}}">
        <!-- summernote -->
        <link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.min.css')}}">
        {{-- tables --}}
        <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">Accueil</a>
            </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Rechercher..." aria-label="Search">
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
            </li>
            
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge" id="pending-orders-count">0</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header" id="notifications-count">0 Notifications</span>
                <div class="dropdown-divider"></div>
                <div id="notifications-list">
                    <a href="{{ route('admin.orders.pending') }}" class="dropdown-item">
                        <i class="fas fa-shopping-cart mr-2"></i> <span id="pending-orders-text">0 commandes en attente</span>
                    </a>
                </div>
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.orders.pending') }}" class="dropdown-item dropdown-footer">Voir toutes les commandes</a>
                </div>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <img src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">MamouShopping Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                <a href="#" class="d-block">Administrateur</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Dashboard -->
                    <li class="nav-item {{ request()->is('admin/dashboard') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Tableau de bord</p>
                            </a>
                        </li>
                        </ul>
                    </li>
                    
                    <!-- Produits -->
                    <li class="nav-item {{ request()->is('admin/products*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Produits
                            <i class="fas fa-angle-left right"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.addproduct') }}" class="nav-link {{ request()->is('admin/addproduct') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ajouter un produit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.products.list') }}" class="nav-link {{ request()->is('admin/products') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Liste des produits</p>
                            </a>
                        </li>
                        </ul>
                    </li>

                    <!-- Catégories -->
                    <li class="nav-item {{ request()->is('admin/categories*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>
                            Catégories
                            <i class="fas fa-angle-left right"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.addcategory') }}" class="nav-link {{ request()->is('admin/addcategory') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ajouter une catégorie</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.categories.list') }}" class="nav-link {{ request()->is('admin/categories') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Liste des catégories</p>
                            </a>
                        </li>
                        </ul>
                    </li>

                    <!-- Commandes -->
                    <li class="nav-item {{ request()->is('admin/orders*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/orders*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Commandes
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-warning right" id="sidebar-pending-count">0</span>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.orders.pending') }}" class="nav-link {{ request()->is('admin/orders/pending') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Commandes en attente</p>
                            <span class="badge badge-warning right" id="pending-count">0</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->is('admin/orders') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Toutes les commandes</p>
                            </a>
                        </li>
                        </ul>
                    </li>

                    <!-- Sections à venir -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-star"></i>
                        <p>
                            Avis
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">Bientôt</span>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Liste des avis</p>
                            </a>
                        </li>
                        </ul>
                    </li>

                    <!-- Sections à venir -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="fas fa-user"></i>
                        <p>
                            Utilisateurs
                            <i class="fas fa-angle-left right"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="fas fa-user"></i>
                            <p>Ajouter un utilisateur</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="fas fa-users"></i>
                            <p>Liste des utilisateurs</p>
                            </a>
                        </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Statistiques
                            <span class="badge badge-info right">Bientôt</span>
                        </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        {{-- Start Admin --}}

        @yield('content')

        {{-- End Admin --}}

        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2023 MamouShopping. Tous droits réservés.</strong>
            <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{asset('admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
        $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- ChartJS -->
        <script src="{{asset('admin/plugins/chart.js/Chart.min.js')}}"></script>
        <!-- Sparkline -->
        <script src="{{asset('admin/plugins/sparklines/sparkline.js')}}"></script>
        <!-- JQVMap -->
        <script src="{{asset('admin/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
        <script src="{{asset('admin/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{asset('admin/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
        <!-- daterangepicker -->
        <script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>
        <script src="{{asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
        <!-- Summernote -->
        <script src="{{asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
        <!-- overlayScrollbars -->
        <script src="{{asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('admin/dist/js/adminlte.js')}}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{asset('admin/dist/js/demo.js')}}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{asset('admin/dist/js/pages/dashboard.js')}}"></script>

        {{-- Scripts des tables --}}
        <script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
        
        <script>
            $(function(){
                // Initialisation des DataTables
                $("#example1").DataTable({
                    "responsive" : true,
                    "autoWidth" : false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
                    }
                });
                
                $("#example2").DataTable({
                    "searching" : false,
                    "info" : true,
                    "ordering" : true,
                    "paging" : true,
                    "lengthChange" : false,
                    "responsive" : true,
                    "autoWidth" : false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
                    }
                });

                // Fonction pour mettre à jour le compteur de commandes en attente
                function updatePendingOrdersCount() {
                    $.ajax({
                        url: '{{ route("admin.orders.pending.count") }}',
                        type: 'GET',
                        success: function(response) {
                            $('#pending-orders-count').text(response.count);
                            $('#sidebar-pending-count').text(response.count);
                            $('#pending-count').text(response.count);
                            $('#notifications-count').text(response.count + ' Notification' + (response.count !== 1 ? 's' : ''));
                            $('#pending-orders-text').text(response.count + ' commande' + (response.count !== 1 ? 's' : '') + ' en attente');
                        },
                        error: function() {
                            console.log('Erreur lors de la récupération du compteur de commandes');
                        }
                    });
                }

                // Mettre à jour initialement et toutes les 30 secondes
                updatePendingOrdersCount();
                setInterval(updatePendingOrdersCount, 30000);
            });
        </script>
    </body>
</html>