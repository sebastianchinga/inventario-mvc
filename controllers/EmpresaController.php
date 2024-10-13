<?php

namespace Controllers;

use Models\Empresa;
use MVC\Router;

class EmpresaController
{

    public static function index(Router $router)
    {
        Autenticar();
        $nombre = $_SESSION['nombre'];
        $alerta = $_GET['alerta'];
        $alerta = filter_var($alerta, FILTER_VALIDATE_INT);
        $empresas = Empresa::all();
        $router->render('empresas/index', [
            'empresas' => $empresas,
            'nombre' => $nombre,
            'alerta' => $alerta
        ]);
    }

    public static function crear(Router $router)
    {
        Autenticar();
        $nombre = $_SESSION['nombre'];
        $alertas = [];

        $empresa = new Empresa();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $empresa = new Empresa($_POST['empresa']);

            $alertas = $empresa->validar();

            if (empty($alertas)) {
                $resultado = $empresa->guardar();
                if ($resultado) {
                    header('Location: /empresas?alerta=1');
                }
            }

        }

        $alertas = Empresa::getAlertas();

        $router->render('empresas/crear', [
            'nombre' => $nombre,
            'empresa' => $empresa,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar(Router $router)
    {
        Autenticar();
        $nombre = $_SESSION['nombre'];
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $alertas = [];

        $empresa = Empresa::find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $empresa->sincronizar($_POST['empresa']);

            $alertas = $empresa->validar();

            if (empty($alertas)) {
                $resultado = $empresa->guardar();

                if ($resultado) {
                    header('Location: /empresas?alerta=2');
                }
            }
        }

        $alertas = Empresa::getAlertas();

        $router->render('empresas/actualizar', [
            'nombre' => $nombre,
            'empresa' => $empresa
        ]);
    }

    public static function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $empresa = Empresa::find($id);

                $resultado = $empresa->eliminar();

                if ($resultado) {
                    header('Location: /empresas?alerta=3');
                }
            }
        }
    }

    public static function cargar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $type = $_FILES['archivo']['type'];
            $size = $_FILES['archivo']['size'];
            $file_tmp = $_FILES['archivo']['tmp_name'];
            $lineas = file($file_tmp);
            $i = 0;
        }

        foreach ($lineas as $linea) {
            $registros = count($lineas);
            $registros_agregados = ($registros - 1);
            // debuguear($lineas);
            if ($i != 0) {
                $datos = explode(";", $linea);
                
                // $empresa = !empty($datos[0]) ? ($datos[0]) : '';
                // $ruc = !empty($datos[1]) ? ($datos[1]) : '';

                $coincidencia = Empresa::query('empresa', $datos[0]);
                // debuguear($coincidencia);

                if ($coincidencia->num_rows === 1) {
                    continue;
                }

                $empresa = new Empresa();
                $empresa->setData($datos);

                $resultado = $empresa->guardar();

                if ($resultado) {
                    header('Location: /empresas?alerta=4');
                }
            }
            $i++;
        }
    }
}
