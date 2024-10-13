<?php

namespace Controllers;

use Models\Mantenimiento;
use Models\Servicio;
use Models\Usuario;
use MVC\Router;

class AdminController
{

    public static function index(Router $router)
    {

        Autenticar();
        $nombre = $_SESSION['nombre'];
        $mantenimientos = count(Mantenimiento::all());
        $servicios = count(Servicio::all());
        $usuarios = count(Usuario::all());

        $router->render('admin/index', [
            'nombre' => $nombre,
            'mantenimientos' => $mantenimientos,
            'servicios' => $servicios,
            'usuarios' => $usuarios
        ]);
    }
}
