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
                            <h1 class="m-0">Productos</h1>
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
                    <div>
                        <a href="/productos/crear" class="btn btn-primary mb-3">Agregar producto</a>
                        <a href="/productos/importar" class="btn btn-danger mb-3" target="_blank">Importar pdf</a>
                    </div>
                    <?php if($alerta): ?>
                        <?php $mensaje = mostrarAlerta($alerta) ?>
                            <div class="alert alert-success"><?php echo $mensaje ?></div>
                        <?php ?>
                    <?php endif; ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Producto</th>
                                <th scope="col">Imágen</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($productos as $producto): ?>
                                <tr>
                                    <th scope="row"><?php echo $producto->id ?></th>
                                    <td><?php echo $producto->producto ?></td>
                                    <td>
                                        <img src="/productosImagenes/<?php echo $producto->imagen ?>" alt="Imágenes de productos" width="100px">
                                    </td>
                                    <td>S/. <?php echo $producto->precio ?></td>
                                    <td>
                                        <a href="/productos/actualizar?id=<?php echo $producto->id ?>" class="btn btn-warning btn-block">Editar</a>
                                        <form action="/productos/eliminar" method="post">
                                            <input type="hidden" name="id" value="<?php echo $producto->id ?>">
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
</body>