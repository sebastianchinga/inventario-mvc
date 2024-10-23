<?php

namespace Controllers;

use DateTime;
use Dompdf\Dompdf;
use Models\Contrato;
use Models\ContratoServicio;
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

    public static function eliminar()
    {
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

    public static function importar()
    {

        $contratos = ContratoServicio::all();
        // debuguear($contratos);

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

        $html .= "<h1>Contratos</h1>";
        $html .= "<table>";
        $html .= "<thead>";
        $html .= "<tr>";
        $html .= "<th>ID</th>";
        $html .= "<th>Cliente</th>";
        $html .= "<th>Inicio</th>";
        $html .= "<th>Finaliza</th>";
        $html .= "<th>Servicio</th>";
        $html .= "<th>Precio</th>";
        $html .= "</tr>";
        $html .= "</thead>";
        $html .= "<tbody>";
        foreach ($contratos as $contrato) {

            $html .= "<tr>";

            $html .= "<td>" . $contrato->id . "</td>";
            $html .= "<td>" . $contrato->cliente . "</td>";
            $html .= '<td>' . $contrato->inicio . '</td>';
            $html .= '<td>' . $contrato->caducidad . '</td>';
            $html .= '<td>' . $contrato->servicio . '</td>';
            $html .= '<td>S/. ' . $contrato->precio . '</td>';

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
        $dompdf->stream("contratos.pdf", ["Attachment" => false]);
    }
}
