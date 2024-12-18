<?php

namespace Controllers;

use Models\Mantenimiento;
use Models\Moneda;
use Models\Servicio;
use Models\Sucursal;
use Models\Usuario;
use MVC\Router;

class AdminController
{

    public static function index(Router $router)
    {

        Autenticar();
        $nombre = $_SESSION['nombre'];
        $mantenimientos = count(Mantenimiento::all());
        $sucursales = count(Sucursal::all());
        $servicios = count(Servicio::all());
        $monedas = count(Moneda::all());
        $usuarios = count(Usuario::all());

        $router->render('admin/index', [
            'nombre' => $nombre,
            'mantenimientos' => $mantenimientos,
            'sucursales' => $sucursales,
            'servicios' => $servicios,
            'monedas' => $monedas,
            'usuarios' => $usuarios
        ]);
    }
}
