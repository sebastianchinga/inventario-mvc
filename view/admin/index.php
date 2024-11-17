<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include __DIR__ . '/../templates/navbar.php' ?>

        <!-- Main Sidebar Container -->
        <?php include __DIR__ . '/../templates/sidebar.php' ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Administrador</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Starter Page</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <a href="" class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-tools"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text" style="color: black;">Mantenimiento</span>
                                    <span class="info-box-number" style="color: black;"><?php echo $mantenimientos ?></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </a>
                        <!-- /.col -->
                        <a href="/empresas-sucursal" class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-network-wired"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text" style="color: black;">Sucursales</span>
                                    <span class="info-box-number" style="color: black;"><?php echo $sucursales ?></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </a>
                        <!-- /.col -->

                        <a href="/servicios" class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-cog"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text" style="color: black;">Servicios</span>
                                    <span class="info-box-number" style="color: black;"><?php echo $servicios ?></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </a>

                        <a href="/servicios" class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-coins"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text" style="color: black;">Monedas</span>
                                    <span class="info-box-number" style="color: black;"><?php echo $monedas ?></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </a>

                        <!-- /.col -->
                        <a href="" class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text" style="color: black;">Usuarios</span>
                                    <span class="info-box-number" style="color: black;"><?php echo $usuarios ?></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </a>
                        <!-- /.col -->
                    </div>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Main Footer -->
        <?php include __DIR__ . '/../templates/footer.php' ?>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="/build/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/build/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/build/dist/js/adminlte.min.js"></script>
</body>