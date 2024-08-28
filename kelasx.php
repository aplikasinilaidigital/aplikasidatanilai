<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Data Guru</title>
    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon">
                <img src="lai.png" alt="Logo" style="width: 40px; height: 40px;">
                </div>
                <div class="sidebar-brand-text mx-3">APLIKASI NILAI DIGITAL</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="data_kelas.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1"/>
                    </svg>
                    <span>Kembali</span>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                        </li>
                        <li class="nav-item dropdown no-arrow">
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">DAFTAR KELAS X</h1>
                    <p>SMK PGRI 1 CIMAHI</p>
                </div>
                <!-- End of Page Content -->

                <!-- Begin Cards Content -->
                <div class="container-fluid">
    <div class="row">
        <!-- Grouping by Jurusan: PPLG -->
        <div class="col-12 mb-4">
    <div class="d-flex align-items-center">
        <img src="kom.png" alt="PPLG Design" style="width: 70px; height: 70px; margin-right: 10px;">
        <div class="sidebar-brand-text-left" style="font-size: 50px;">PPLG</div>
    </div>
</div>
        <!-- Card X PPLG 1 -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="xpplg1.php" class="text-decoration-none">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <h4>X PPLG 1</h4>
                                </div>
                            </div>
                            <div class="col-auto"></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Card X PPLG 2 -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="xpplg2.php" class="text-decoration-none">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <h4>X PPLG 2</h4>
                                </div>
                            </div>
                            <div class="col-auto"></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Grouping by Jurusan: AKL -->
        <div class="col-12 mb-4">
        <div class="d-flex align-items-center">
        <img src="uang.png" alt="AKL Design" style="width: 70px; height: 70px; margin-right: 10px;">
        <div class="sidebar-brand-text-left" style="font-size: 50px;">AKL</div>
    </div>
</div>

        <!-- Card X AKL -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="xakl.php" class="text-decoration-none">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                    <h4>X AKL</h4>
                                </div>
                            </div>
                            <div class="col-auto"></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Grouping by Jurusan: MPLB -->
        <div class="col-12 mb-4">
        <div class="d-flex align-items-center">
        <img src="bku.png" alt="MPLB Design" style="width: 90px; height: 90px; margin-right: 10px;">
        <div class="sidebar-brand-text-left" style="font-size: 50px;">MPLB</div>
    </div>
</div>
        <!-- Card X MPLB 1 -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="xmplb1.php" class="text-decoration-none">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    <h4>X MPLB 1</h4>
                                </div>
                            </div>
                            <div class="col-auto"></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Card X MPLB 2 -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="xmplb2.php" class="text-decoration-none">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    <h4>X MPLB 2</h4>
                                </div>
                            </div>
                            <div class="col-auto"></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Grouping by Jurusan: PM -->
        <div class="col-12 mb-4">
        <div class="d-flex align-items-center">
        <img src="psr.png" alt="PM Design" style="width: 90px; height: 90px; margin-right: 10px;">
        <div class="sidebar-brand-text-left" style="font-size: 50px;">PM</div>
    </div>
</div>
        <!-- Card X PM 1 -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="xpm1.php" class="text-decoration-none">
                <div class="card border-left-dark shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                    <h4>X PM 1</h4>
                                </div>
                            </div>
                            <div class="col-auto"></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Card X PM 2 -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="xpm2.php" class="text-decoration-none">
                <div class="card border-left-dark shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                    <h4>X PM 2</h4>
                                </div>
                            </div>
                            <div class="col-auto"></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>


        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

    </div>
</body>
</html>
