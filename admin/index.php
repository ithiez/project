<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin TTruyen</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/adminlte.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    </head>
    <body class="hold-transition sidebar-mini layout-fixed dark-mode" data-panel-auto-height-mode="height">
        <div class="wrapper">

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-dark">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block btn-danger active">
                        <a href="/project-nentang/index.php" class="nav-link btn-outline-secondary"><i class="fa fa-home"></i></a>
                    </li>
<!--                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link">Contact</a>
                    </li>-->
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
                    </li>

                            
                            
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                            <i class="fas fa-th-large"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="/project-nentang/index.php" class="brand-link text-center">
                    <img src="dist/img/logo.png" alt="AdminLTE Logo" class="">
              <!--      <span class="brand-text font-weight-light"></span>-->
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="dist/img/user0-160x160.png" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">Võ Văn Thiện</a>
                        </div>
                    </div>

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
                            <!-- Add icons to the links using the .nav-icon class
                                 with font-awesome or any other icon font library -->

                            <h6 class="bg-danger py-1"><i class="fas fa-tachometer-alt"></i> TRUYỆN TRANH</h6>
                            <li class="nav-item">
                                <a href="/project-nentang/admin/truyen-tranh/danh-sach.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh sách</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/project-nentang/admin/truyen-tranh/them.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm mới</p>
                                </a>
                            </li>                                                             
                            
                            <li class="nav-item">
                                <a href="/project-nentang/admin/truyen-tranh-tap/danh-sach.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh sách Chapter</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/project-nentang/admin/truyen-tranh-tap/them.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm mới Chapter</p>
                                </a>
                            </li>                                                                                      


                            <h6 class="bg-info py-1"><i class="fas fa-tachometer-alt"></i> TIỂU THUYẾT</h6>                            
                            <li class="nav-item">
                                <a href="/project-nentang/admin/tieu-thuyet/danh-sach.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh sách</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/project-nentang/admin/tieu-thuyet/them.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm mới</p>
                                </a>
                            </li>                                                           
                            <li class="nav-item">
                                <a href="/project-nentang/admin/tieu-thuyet-chuong/danh-sach.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh sách Chapter</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/project-nentang/admin/tieu-thuyet-chuong/them.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm mới Chapter</p>
                                </a>
                            </li>                                                                          
                        </ul>                                                                 
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper iframe-mode bg-dark" data-widget="iframe" data-auto-dark-mode="true" data-loading-screen="750">
                <div class="nav navbar navbar-expand-lg navbar-dark border-bottom border-dark p-0">
                    <a class="nav-link bg-danger" href="#" data-widget="iframe-close">Close</a>
                    <a class="nav-link bg-dark" href="#" data-widget="iframe-scrollleft"><i class="fas fa-angle-double-left"></i></a>
                    <ul class="navbar-nav" role="tablist">
                    </ul>
                    <a class="nav-link bg-dark" href="#" data-widget="iframe-scrollright"><i class="fas fa-angle-double-right"></i></a>
                    <a class="nav-link bg-dark" href="#" data-widget="iframe-fullscreen"><i class="fas fa-expand"></i></a>
                </div>
                <div class="tab-content bg-white">
                    <div class="tab-empty bg-dark">
                        <h2 class="display-4">No tab selected!</h2>
                    </div>
                    <div class="tab-loading">
                        <div>
                            <h2 class="display-4">Tab is loading <i class="fa fa-sync fa-spin"></i></h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer dark-mode">
                <strong>Copyright &copy; 2023 <a href="/project-nentang/index.php">TTruyen</a>.</strong>
                All rights reserved.
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

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
        <!-- overlayScrollbars -->
        <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.js"></script>
        <!-- AdminLTE for demo purposes -->
        
    </body>
</html>
