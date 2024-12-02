<?php

namespace Controllers;

use Models\Empresa;
use Models\Sucursal;
use MVC\Router;

class SucursalController
{

    public static function index(Router $router)
    {
        $query = 'SELECT DISTINCT provincia FROM sucursales';
        $sucursales = Sucursal::consultarSQL($query);

        $router->render('sucursales/index', [
            'sucursales' => $sucursales
        ]);
    }

    public static function crear(Router $router)
    {
        Autenticar();
        $nombre = $_SESSION['nombre'];
        $alertas = [];
        $empresas = Empresa::all();

        $sucursal = new Sucursal();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sucursal = new Sucursal($_POST['sucursal']);
            // debuguear($sucursal->provincia);
            $alertas = $sucursal->validar();

            if (empty($alertas)) {
                $resultado = $sucursal->guardar();
                if ($resultado) {
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                }
            }
        }
        $router->render('sucursales/crear', [
            'nombre' => $nombre,
            'alertas' => $alertas,
            'empresas' => $empresas,
            'sucursal' => $sucursal
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id) {
                $sucursal = Sucursal::find($id);
                $resultado = $sucursal->eliminar();

                if ($resultado) {
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            }
        }
    }

    public static function actualizar(Router $router)
    {
        $alertas = [];
        $id = validarID('home');
        $sucursal = Sucursal::find($id);
        $empresas = Empresa::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sucursal->sincronizar($_POST['sucursal']);
            $alertas = $sucursal->validar();

            if (empty($alertas)) {
                // Actualizar data
                $resultado = $sucursal->guardar();

                if ($resultado) {
                    // Si se efectuó la consulta, redirigir a la URL anterior
                    header("Location: /empresas");
                }
            }
        }

        $router->render('sucursales/actualizar', [
            'sucursal' => $sucursal,
            'alertas' => $alertas,
            'empresas' => $empresas,
            'id' => $id
        ]);
    }
}
