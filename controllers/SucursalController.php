<?php

namespace Controllers;

use Models\Empresa;
use MVC\Router;

class SucursalController {

    public static function index(Router $router) {
        $empresas = Empresa::all();
        $router->render('sucursales/index', [
            'empresas' => $empresas
        ]);
    }
}