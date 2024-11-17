<?php

namespace Controllers;

use Models\Moneda;
use Models\Servicio;
use MVC\Router;

class ServicioController
{

    public static function index(Router $router)
    {
        Autenticar();
        $nombre = $_SESSION['nombre'];
        $alerta = $_GET['alerta'];
        $alerta = filter_var($alerta, FILTER_VALIDATE_INT);

        $servicios = Servicio::all();
        $monedas = Moneda::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['monedas'];
            if ($id) {
                $monedaObj = Moneda::find($id);
                // debuguear($monedaObj);
            }
            
        }

        $router->render('services/index', [
            'servicios' => $servicios,
            'alerta' => $alerta,
            'nombre' => $nombre,
            'monedas' => $monedas,
            'monedaObj' => $monedaObj
        ]);
    }

    public static function crear(Router $router)
    {
        Autenticar();
        $nombre = $_SESSION['nombre'];

        $alertas = [];
        $servicio = new Servicio();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio = new Servicio($_POST['servicio']);
            $alertas = $servicio->validar();

            if (empty($alertas)) {
                $resultado = $servicio->guardar();

                if ($resultado) {
                    header('Location: /servicios?alerta=1');
                }
            }
        }

        $alertas = Servicio::getAlertas();
        $router->render('services/crear', [
            'alertas' => $alertas,
            'servicio' => $servicio,
            'nombre' => $nombre
        ]);
    }

    public static function actualizar(Router $router)
    {
        Autenticar();
        $nombre = $_SESSION['nombre'];

        $alertas = [];
        $id = validarID('servicios');
        $servicio = Servicio::find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST['servicio']);
            $alertas = $servicio->validar();

            if (empty($alertas)) {
                $resultado = $servicio->guardar();

                if ($resultado) {
                    header('Location: /servicios?alerta=2');
                }
            }
        }

        $alertas = Servicio::getAlertas();
        $router->render('services/actualizar', [
            'alertas' => $alertas,
            'servicio' => $servicio,
            'nombre' => $nombre
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $servicio = Servicio::find($id);
                $resultado = $servicio->eliminar();

                if ($resultado) {
                    header('Location: /servicios?alerta=3');
                }
            }
        }
    }
}
