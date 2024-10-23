<?php

namespace Controllers;

use Dompdf\Dompdf;
use Models\Categoria;
use MVC\Router;

class CategoriaController
{


    public static function index(Router $router)
    {
        $categorias = Categoria::all();

        $alerta = $_GET['alerta'];
        $alerta = filter_var($alerta, FILTER_VALIDATE_INT);

        session_start();
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];
        $auth = $_SESSION['login'] ?? null;

        if (is_null($auth)) {
            header('Location: /');
        }

        $router->render('categorias/index', [
            'categorias' => $categorias,
            'nombre' => $nombre,
            'alerta' => $alerta
        ]);
    }

    public static function crear(Router $router)
    {
        Autenticar();
        $nombre = $_SESSION['nombre'];

        $categoria = new Categoria();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoria = new Categoria($_POST['categoria']);

            $alertas = $categoria->validar();

            if (empty($alertas)) {
                $resultado = $categoria->guardar();
                if ($resultado) {
                    header('Location: /categorias?alerta=1');
                }
            }
        }

        $alertas = Categoria::getAlertas();

        $router->render('categorias/crear', [
            'nombre' => $nombre,
            'categoria' => $categoria
        ]);
    }

    public static function actualizar(Router $router)
    {
        $alertas = [];

        session_start();
        $nombre = $_SESSION['nombre'];
        $email = $_SESSION['email'];
        $auth = $_SESSION['login'] ?? null;

        if (is_null($auth)) {
            header('Location: /');
        }

        $id = validarID('categorias');
        $categoria = Categoria::find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoria->sincronizar($_POST['categoria']);

            $alertas = $categoria->validar();

            if (empty($alertas)) {
                $resultado = $categoria->guardar();

                if ($resultado) {
                    header('Location: /categorias?alerta=2');
                }
            }
        }

        $router->render('categorias/actualizar', [
            'alertas' => $alertas,
            'nombre' => $nombre,
            'categoria' => $categoria
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $categoria = Categoria::find($id);
                $resultado = $categoria->eliminar();

                if ($resultado) {
                    header('Location: /categorias?alerta=3');
                }
            }
        }
    }

    public static function cargar()
    {


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $size = $_FILES['archivo']['size'];
            $type = $_FILES['archivo']['type'];
            $file_tmp = $_FILES['archivo']['tmp_name'];
        }

        $lineas = file($file_tmp);
        $i = 0;

        foreach ($lineas as $linea) {

            $columnas = count($lineas);
            $columnas_agregadas = ($columnas - 1);

            if ($i != 0) {
                $datos = explode(";", $linea);

                $categoria = !empty($datos[0]) ? ($datos[0]) : '';

                $categ = new Categoria();
                $categ->setData($categoria);
                $res = Categoria::query('categoria', $categoria);

                if ($res->num_rows === 1) {
                    continue;
                }

                $resultado = $categ->guardar();

                if ($resultado) {
                    header('Location: /categorias?alerta=4');
                }
            }

            $i++;
        }
    }

    public static function importar()
    {
        $categorias = Categoria::all();

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
        // $html .= '<img src="' . $src . '" alt="Logo" style="display: block; margin: 0 auto; width: 150px;"/>';

        $html .= "<h1>Categorías disponibles</h1>";
        $html .= "<table>";
        $html .= "<thead>";
        $html .= "<tr>";
        $html .= "<th>ID</th>";
        $html .= "<th>Categoría</th>";
        $html .= "</tr>";
        $html .= "</thead>";
        $html .= "<tbody>";
        foreach ($categorias as $categoria) {
            $html .= "<tr>";
            $html .= "<td>" . $categoria->id . "</td>";
            $html .= "<td>" . $categoria->categoria . "</td>";
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
        $dompdf->stream("categorias.pdf", ["Attachment" => false]);
    }
}
