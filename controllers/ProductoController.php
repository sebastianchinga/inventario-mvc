<?php

namespace Controllers;

use Dompdf\Dompdf;
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

    public static function importar()
    {
        $productos = Producto::all();

        // debuguear($src);

        $dompdf = new Dompdf();

        // Crear el HTML
        $html = "<!DOCTYPE html>";
        $html .= "<html>";
        $html .= "<head>";
        $html .= '<title>Descargar PDF</title>';
        $html .= '<style>
                    body { font-family: Arial, sans-serif; }
                    table { width: 100%; border-collapse: collapse; }
                    th, td { border: 1px solid #ddd; padding: 8px; }
                    th { background-color: #f2f2f2; }
                    h1 { text-align: center; }
                  </style>';
        $html .= "</head>";
        $html .= "<body>";

        // Agregar la imagen al PDF
        // $html .= '';

        $html .= "<h1>Categorías disponibles</h1>";
        $html .= "<table>";
        $html .= "<thead>";
        $html .= "<tr>";
        $html .= "<th>ID</th>";
        $html .= "<th>Producto</th>";
        $html .= "<th>Imágen</th>";
        $html .= "<th>Precio</th>";
        $html .= "</tr>";
        $html .= "</thead>";
        $html .= "<tbody>";
        foreach ($productos as $producto) {
            $imagePath = $_SERVER['DOCUMENT_ROOT'] . "/productosImagenes/$producto->imagen";

            $imageData = base64_encode(file_get_contents($imagePath));
            $src = 'data:image/png;base64,' . $imageData;

            $html .= "<tr>";
            $html .= "<td>" . $producto->id . "</td>";
            $html .= "<td>" . $producto->producto . "</td>";
            $html .= '<td><img src="' . $src . '" alt="Logo" style="display: block; margin: 0 auto; width: 150px;"/></td>';
            $html .= '<td>S/. ' . $producto->precio . '</td>';
            $html .= "</tr>";
        }
        $html .= "</tbody>";
        $html .= "</table>";
        $html .= "</body>";
        $html .= "</html>";

        // Cargar el HTML en DomPDF
        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'landscape');

        // Renderizar el PDF
        $dompdf->render();

        // Mostrar el PDF en el navegador sin descargar automáticamente
        $dompdf->stream("productos.pdf", ["Attachment" => false]);
    }
}
