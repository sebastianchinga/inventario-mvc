<?php

namespace Controllers;

use Models\Producto;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;
use Models\Categoria;
use Models\Empresa;
use Models\Marca;

class ProductoController
{

    public static function index(Router $router)
    {
        $productos = Producto::all();

        session_start();
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];
        $auth = $_SESSION['login'] ?? null;

        if (is_null($auth)) {
            header('Location: /');
        }

        $alerta = $_GET['alerta'];
        $alerta = filter_var($alerta, FILTER_VALIDATE_INT);

        $router->render('productos/index', [
            'productos' => $productos,
            'alerta' => $alerta,
            'nombre' => $nombre
        ]);
    }

    public static function crear(Router $router)
    {
        $alertas = [];

        session_start();
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];
        $auth = $_SESSION['login'] ?? null;

        if (is_null($auth)) {
            header('Location: /');
        }

        $producto = new Producto();
        $categorias = Categoria::all();
        $empresas = Empresa::all();
        $marcas = Marca::all();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $producto = new Producto($_POST['producto']);

            $nombreImagen = '';
            if (!is_dir(CARPETA_PRODUCTOS)) {
                mkdir(CARPETA_PRODUCTOS);
            }

            $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

            if ($_FILES['producto']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['producto']['tmp_name']['imagen']);
                $producto->setImagen($nombreImagen);
            }

            $alertas = $producto->validar();

            if (empty($alertas)) {

                if ($_FILES['producto']['tmp_name']['imagen']) {
                    $image->save(CARPETA_PRODUCTOS . $nombreImagen);
                }
                $resultado = $producto->guardar();

                if ($resultado) {
                    header('Location: /productos?alerta=1');
                }
            }
        }

        $alertas = Producto::getAlertas();

        $router->render('productos/crear', [
            'alertas' => $alertas,
            'producto' => $producto,
            'categorias' => $categorias,
            'empresas' => $empresas,
            'marcas' => $marcas,
            'nombre' => $nombre
        ]);
    }

    public static function actualizar(Router $router)
    {
        session_start();
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];
        $auth = $_SESSION['login'] ?? null;

        if (is_null($auth)) {
            header('Location: /');
        }

        $id = validarID('productos');
        $producto = Producto::find($id);
        $categorias = Categoria::all();
        $empresas = Empresa::all();
        $marcas = Marca::all();
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $producto->sincronizar($_POST['producto']);

            $nombreImagen = '';
            if (!is_dir(CARPETA_PRODUCTOS)) {
                mkdir(CARPETA_PRODUCTOS);
            }

            $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

            if ($_FILES['producto']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['producto']['tmp_name']['imagen']);
                $producto->setImagen($nombreImagen);
            }

            $alertas = $producto->validar();

            if (empty($alertas)) {

                if ($_FILES['producto']['tmp_name']['imagen']) {
                    $image->save(CARPETA_PRODUCTOS . $nombreImagen);
                }

                $resultado = $producto->guardar();
                if ($resultado) {
                    header('Location: /productos?alerta=2');
                }
            }
        }

        $alertas = Producto::getAlertas();

        $router->render('productos/actualizar', [
            'producto' => $producto,
            'alertas' => $alertas,
            'categorias' => $categorias,
            'empresas' => $empresas,
            'marcas' => $marcas,
            'nombre' => $nombre
        ]);
    }

    public static function eliminar()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $producto = Producto::find($id);
                $resultado = $producto->eliminar();
                if ($resultado) {
                    header('Location: /productos?alerta=3');
                }
            }
        }
    }
}
