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
                            <h1 class="m-0">Contratos</h1>
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
                    <a href="/contratos/crear" class="btn btn-primary mb-3">Nuevo contrato</a>
                    <?php if ($alerta): ?>
                        <?php
                        $mensaje = mostrarAlerta($alerta); ?>
                        <div class="alert alert-success"><?php echo $mensaje ?></div>
                        <?php ?>
                    <?php endif; ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Inicio</th>
                                <th scope="col">Finaliza</th>
                                <th scope="col">Días restantes</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($contratos as $contrato): ?>
                                <tr>
                                    <th scope="row"><?php echo $contrato->id ?></th>
                                    <td><?php echo $contrato->cliente ?></td>
                                    <td><?php echo $contrato->inicio ?></td>
                                    <td><?php echo $contrato->caducidad ?></td>
                                    <?php
                                        $inicio = date_create('now');
                                        $caducidad = date_create($contrato->caducidad);
                                        $diferencia = date_diff($inicio, $caducidad);
                                        $dias = $diferencia->days;
                                    ?>
                                    <td><?php echo $dias === 0 ? 'Contrato vencido' : $dias . " dias" ?></td>
                                    <td>
                                        <a href="/contratos/actualizar?id=<?php echo $contrato->id ?>" class="btn btn-warning btn-block">Editar</a>
                                        <form action="/contratos/eliminar" method="post">
                                            <input type="hidden" name="id" value="<?php echo $contrato->id ?>">
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