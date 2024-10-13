<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/admin" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">

                <img src="/build/dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">
                <!-- <span class="d-none d-md-inline">Alexander Pierce</span> -->
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="/build/dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">
                    <p><?php echo $nombre; ?></p>
                    <span>Administrador</span>
                </li>
                <!-- Menu Body -->

                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="/mi-perfil" class="btn btn-default btn-flat">Perfil</a>
                    <a href="/cerrar" class="btn btn-default btn-flat float-right">Cerrar</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>