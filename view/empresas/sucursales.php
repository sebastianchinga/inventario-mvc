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
                            <h1 class="m-0">Sucursales de la empresa: <?php echo $empresa->empresa  ?></h1>
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
                    <a href="/empresas" class="btn btn-danger mb-3">Volver</a>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Provincia</th>
                                <th scope="col">Dirección</th>
                                <th scope="col">Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sucursales as $sucursal): ?>
                                <tr>
                                    <th scope="row"><?php echo $sucursal->id ?></th>
                                    <td><?php echo $sucursal->provincia ?></td>
                                    <td><?php echo $sucursal->direccion ?></td>
                                    <td>
                                        <a href="/sucursal/actualizar?id=<?php echo $sucursal->id ?>" class="btn btn-warning mb-2 btn-block">Editar sucursal</a>
                                        <form action="/sucursal" method="post">
                                            <input type="hidden" name="id" value="<?php echo $sucursal->id ?>">
                                            <input type="submit" value="Eliminar" class="btn btn-danger btn-block">
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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
    <script src="/build/js/cargar.js"></script>
</body>