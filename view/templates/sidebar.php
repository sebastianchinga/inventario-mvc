<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
        <img src="/build/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/build/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="/mi-perfil" class="d-block"><?php echo $nombre ?></a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/admin" class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'admin') == 1 ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/productos" class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'productos') == 1 ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Productos</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/categorias" class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'categorias') == 1 ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Categorías</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/empresas" class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'empresas') == 1 ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Empresas</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/marcas" class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'marcas') == 1 ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-registered"></i>
                        <p>Marcas</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/contratos" class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'contratos') == 1 ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-file-signature"></i>
                        <p>Contratos</p>
                    </a>
                </li>

                <!-- <li class="nav-item <?php echo strpos($_SERVER['REQUEST_URI'], 'categorias') == 1 || strpos($_SERVER['REQUEST_URI'], 'categoria') == 1 ? 'menu-open' : '' ?>">
                    <a href="" class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'categorias') == 1 || strpos($_SERVER['REQUEST_URI'], 'categoria') == 1 ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Categorías<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/categoria/crear" class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'categoria/crear') == 1 ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear<span class="right badge badge-success">Nuevo</span></p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/categorias" class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'categorias') == 1 ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Listar categorías<span class="right badge badge-primary">Todo</span></p>
                            </a>
                        </li>
                    </ul>
                </li> -->

                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Productos</p>
                    </a>
                </li> -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>