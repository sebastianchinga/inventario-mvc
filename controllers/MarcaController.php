<?php

namespace Controllers;

use Models\Marca;
use MVC\Router;

class MarcaController
{

    public static function index(Router $router)
    {
        Autenticar();
        $nombre = $_SESSION['nombre'];

        $alerta = $_GET['alerta'];
        $alerta = filter_var($alerta, FILTER_VALIDATE_INT);

        $marcas = Marca::all();

        $router->render('marcas/index', [
            'nombre' => $nombre,
            'alerta' => $alerta,
            'marcas' => $marcas
        ]);
    }

    public static function crear(Router $router)
    {
        $alertas = [];
        $marca = new Marca();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $marca = new Marca($_POST['marca']);
            $alertas = $marca->validar();

            if (empty($alertas)) {
                $resultado = $marca->guardar();

                if ($resultado) {
                    header('Location: /marcas?alerta=1');
                }
            }
        }

        $alertas = Marca::getAlertas();

        $router->render('marcas/crear', [
            'alertas' => $alertas
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarID('marcas');
        $marca = Marca::find($id);

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $marca->sincronizar($_POST['marca']);

            $alertas = $marca->validar();

            if (empty($alertas)) {
                $resultado = $marca->guardar();

                if ($resultado) {
                    header('Location: /marcas?alerta=2');
                }
            }
        }

        $alertas = Marca::getAlertas();

        $router->render('marcas/actualizar', [
            'marca' => $marca,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $marca = Marca::find($id);
                $resultado = $marca->eliminar();

                if ($resultado) {
                    header('Location: /marcas?alerta=3');
                }
            }
        }
    }

    public static function cargar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $type = $_FILES['archivo']['type'];
            $tmp_name = $_FILES['archivo']['tmp_name'];
            $size = $_FILES['archivo']['size'];

            $lineas = file($tmp_name);
            $i = 0;
        }

        foreach ($lineas as $linea) {
            $columnas_total = count($lineas);
            $columnas_agregadas = ($columnas_total - 1);

            if ($i != 0) {
                $datos = explode(";", $linea);

                $coincidencia = Marca::query('marca', $datos[0]);

                if ($coincidencia->num_rows === 1) {
                    continue;
                }

                $marca = new Marca();
                $marca->setData($datos);

                $resultado = $marca->guardar();

                if ($resultado) {
                    header('Location: /marcas?alerta=4');
                }
            }

            $i++;
        }
    }
}
