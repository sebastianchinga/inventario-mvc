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
                            <h1 class="m-0">Servicios</h1>
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
                    <a href="/servicios/crear" class="btn btn-primary mb-3">Agregar servicio</a>
                    <a href="" class="btn btn-success mb-3" id="cargar">Subir datos</a>
                    <a href="" class="btn btn-secondary mb-3" id="monedas">Seleccionar monedas</a>

                    <!-- Formulario para seleccionar moneda -->
                    <form id="form-monedas" method="post" action="/servicios" class="">

                        <div class="fom-group">
                            <select name="monedas" id="" class="form-control mb-3">
                                <option value="">--Seleeciona una moneda--</option>
                                <?php foreach($monedas as $moneda): ?>
                                    <option value="<?php echo $moneda->id ?>"><?php echo $moneda->moneda ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <input type="submit" value="Seleccionar moneda" class="btn btn-primary btn-block">
                        </div>
                    </form>

                    <!-- Formulario para subir un archivo -->
                    <form action="/servicios/cargar" method="post" enctype="multipart/form-data" class="d-none" id="formulario-carga">
                        <div class="form-group">
                            <input type="file" name="archivo">
                        </div>
                        <input type="submit" value="Cargar" class="btn btn-primary btn-block mb-3">
                    </form>
                    
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
                                <th scope="col">Servicio</th>
                                <th scope="col">Precio</th>
                                <?php if(!empty($monedaObj)): ?>
                                    <th scope="col">Precio (<?php echo $monedaObj->codigo ?>)</th>
                                <?php endif; ?>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($servicios as $servicio): ?>
                                <tr>
                                    <th scope="row"><?php echo $servicio->id ?></th>
                                    <td><?php echo $servicio->servicio ?></td>
                                    <td>$/ <?php echo $servicio->precio ?></td>
                                    <?php if(!empty($monedaObj)): ?>
                                        <?php 
                                            $montoConvertido = conversionMonedas($servicio->precio, $monedaObj->valor);
                                        ?>
                                        <td><?php echo $monedaObj->simbolo . '/ ' . number_format($montoConvertido, 2, '.') ?></td>
                                    <?php endif; ?>
                                    <td>
                                        <a href="/servicios/actualizar?id=<?php echo $servicio->id ?>" class="btn btn-warning btn-block">Editar</a>
                                        <form action="/servicios/eliminar" method="post">
                                            <input type="hidden" name="id" value="<?php echo $servicio->id ?>">
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