<?php

define('CARPETA_PRODUCTOS', __DIR__ . '/../public/productosImagenes/');

function debuguear($codigo)
{
    echo '<pre>';
    var_dump($codigo);
    echo '</pre>';
    exit;
}

function s($html)
{
    $resultado = htmlspecialchars($html);
    return $resultado;
}

function mostrarAlerta($alerta): string
{
    $resultado = '';
    switch ($alerta) {
        case 1:
            $resultado = 'Agregado exitosamente';
            break;
        case 2:
            $resultado = 'Actualizado exitosamente';
            break;
        case 3:
            $resultado = 'Eliminado exitosamente';
            break;
        case 4:
            $resultado = 'Datos importados';
            break;

        default:
            $resultado = '';
            break;
    }

    return $resultado;
}

function validarID($url)
{
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header("Location: /". $url);
    }

    return $id;
}

function Autenticar() {
    session_start();
    $nombre = $_SESSION['nombre'];
    $email = $_SESSION['email'];
    $auth = $_SESSION['login'] ?? null;

    if (is_null($auth)) {
        header('Location: /');
    }
}