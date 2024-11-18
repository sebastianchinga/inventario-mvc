<?php

namespace Controllers;

use Models\Moneda;
use MVC\Router;

class MonedaController {

    public static function index(Router $router) {
        $monedas = Moneda::all();
        $alerta = $_GET['alerta'];
        $alerta = filter_var($alerta, FILTER_VALIDATE_INT);
        Autenticar();
        $nombre = $_SESSION['nombre'];
        $router->render('monedas/index', [
            'monedas' => $monedas,
            'nombre' => $nombre,
            'alerta' => $alerta
        ]);
    }

    public static function crear(Router $router) {
        $moneda = new Moneda();
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $moneda = new Moneda($_POST['moneda']);

            $alertas = $moneda->validar();

            if (empty($alertas)) {
                $resultado = $moneda->guardar();

                if ($resultado) {
                    header('Location: /monedas?alerta=1');
                }
            }
        }

        $alertas = Moneda::getAlertas();

        $router->render('monedas/crear', [
            'alertas' => $alertas,
            'moneda' => $moneda
        ]);
    }

    public static function actualizar(Router $router) {

    }

    public static function eliminar() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $moneda = Moneda::find($id);
                $resultado = $moneda->eliminar();

                if ($resultado) {
                    header('Location: /monedas?alerta=3');
                }
            }
        }

    }

}