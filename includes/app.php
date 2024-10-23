<?php

use Dotenv\Dotenv;
use Models\Producto;

require __DIR__ . '/database.php';
require __DIR__ . '/funciones.php';
require __DIR__ . '/../vendor/autoload.php';
// require __DIR__ . '/../public/build/fpdf/fpdf.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$db = conectarDB();
Producto::setDB($db);