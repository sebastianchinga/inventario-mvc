<?php

namespace Controllers;

use DateTime;
use Models\Contrato;
use Models\Servicio;
use Models\Tiempo;
use MVC\Router;

class ContratoController
{

    public static function index(Router $router)
    {
        Autenticar();
        $nombre = $_SESSION['nombre'];
        $alerta = $_GET['alerta'];
        $alerta = filter_var($alerta, FILTER_VALIDATE_INT);

        $contratos = Contrato::all();

        $router->render('contracts/index', [
            'nombre' => $nombre,
            'alerta' => $alerta,
            'contratos' => $contratos,
        ]);
    }

    public static function crear(Router $router)
    {
        Autenticar();
        $nombre = $_SESSION['nombre'];

        $servicios = Servicio::all();
        $contrato = new Contrato();

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contrato = new Contrato($_POST['contrato']);
            $contrato->setCaducidad();

            $alertas = $contrato->validar();

            if (empty($alertas)) {
                $resultado = $contrato->guardar();

                if ($resultado) {
                    header('Location: /contratos?alerta=1');
                }
            }

        }

        $alertas = Contrato::getAlertas();

        $router->render('contracts/crear', [
            'nombre' => $nombre,
            'servicios' => $servicios,
            'alertas' => $alertas,
            'contrato' => $contrato
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarID('contratos');
        $contrato = Contrato::find($id);
        $servicios = Servicio::all();
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contrato->sincronizar($_POST['contrato']);
            $contrato->setCaducidad();

            $alertas = $contrato->validar();

            if (empty($alertas)) {
                $resultado = $contrato->guardar();

                if ($resultado) {
                    header('Location: /contratos?alerta=2');
                }
            }
        }

        $alertas = Contrato::getAlertas();

        $router->render('contracts/actualizar', [
            'contrato' => $contrato,
            'servicios' => $servicios,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $contrato = Contrato::find($id);
                $resultado = $contrato->eliminar();

                if ($resultado) {
                    header('Location: /contratos?alerta=3');
                }
            }
        }
    }
}
