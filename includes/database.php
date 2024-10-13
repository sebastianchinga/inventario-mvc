<?php 

function conectarDB(): mysqli {
    $db = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);
    // $db = new mysqli('localhost', 'root', 'root', 'inventario');

    if (!$db) {
        echo 'Error en la conección';
    }

    return $db;
}