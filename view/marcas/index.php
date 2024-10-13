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
                            <h1 class="m-0">Marcas</h1>
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
                    <a href="/marcas/crear" class="btn btn-primary mb-3">Agregar marca</a>
                    <a href="" class="btn btn-success mb-3" id="cargar">Subir datos</a>
                    <form action="/marcas/cargar" method="post" enctype="multipart/form-data" class="d-none" id="formulario-carga">
                        <div class="form-group">
                            <input type="file" name="archivo">
                        </div>
                        <input type="submit" value="Cargar" class="btn btn-primary btn-block mb-3">
                    </form>
                    <?php if($alerta): ?>
                        <?php 
                            $mensaje = mostrarAlerta($alerta); ?>
                            <div class="alert alert-success"><?php echo $mensaje ?></div>
                        <?php ?>
                    <?php endif; ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Marca</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($marcas as $marca): ?>
                                <tr>
                                    <th scope="row"><?php echo $marca->id ?></th>
                                    <td><?php echo $marca->marca ?></td>
                                    <td>
                                        <a href="/marcas/actualizar?id=<?php echo $marca->id ?>" class="btn btn-warning btn-block">Editar</a>
                                        <form action="/marcas/eliminar" method="post">
                                            <input type="hidden" name="id" value="<?php echo $marca->id ?>">
                                            <input type="submit" value="Eliminar" class="btn btn-danger btn-block mt-2">
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