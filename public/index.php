<?php

use Controllers\AdminController;
use Controllers\AuthController;
use Controllers\CategoriaController;
use Controllers\ContratoController;
use Controllers\EmpresaController;
use Controllers\MarcaController;
use Controllers\MonedaController;
use Controllers\ProductoController;
use Controllers\ServicioController;
use Controllers\SucursalController;
use MVC\Router;

require __DIR__ . '/../includes/app.php';

$router = new Router;

$router->get('/', [AuthController::class, 'login']); 
$router->post('/', [AuthController::class, 'login']);
$router->get('/cerrar', [AuthController::class, 'cerrar']);

$router->get('/admin', [AdminController::class, 'index']);

// Productos
$router->get('/productos', [ProductoController::class, 'index']);
$router->get('/productos/crear', [ProductoController::class, 'crear']);
$router->post('/productos/crear', [ProductoController::class, 'crear']);
$router->get('/productos/actualizar', [ProductoController::class, 'actualizar']);
$router->post('/productos/actualizar', [ProductoController::class, 'actualizar']);
$router->post('/productos/eliminar', [ProductoController::class, 'eliminar']);
$router->get('/productos/importar', [ProductoController::class, 'importar']);

// Categorias
$router->get('/categorias', [CategoriaController::class, 'index']);
$router->get('/categorias/crear', [CategoriaController::class, 'crear']);
$router->post('/categorias/crear', [CategoriaController::class, 'crear']);
$router->get('/categorias/actualizar', [CategoriaController::class, 'actualizar']);
$router->post('/categorias/actualizar', [CategoriaController::class, 'actualizar']);
$router->post('/categorias/eliminar', [CategoriaController::class, 'eliminar']);
$router->post('/categorias/cargar', [CategoriaController::class, 'cargar']);
$router->get('/categorias/importar', [CategoriaController::class, 'importar']);

// Empresas
$router->get('/empresas', [EmpresaController::class, 'index']);
$router->get('/empresas/crear', [EmpresaController::class, 'crear']);
$router->post('/empresas/crear', [EmpresaController::class, 'crear']);
$router->get('/empresas/actualizar', [EmpresaController::class, 'actualizar']);
$router->post('/empresas/actualizar', [EmpresaController::class, 'actualizar']);
$router->post('/empresas/eliminar', [EmpresaController::class, 'eliminar']);
$router->post('/empresas/cargar', [EmpresaController::class, 'cargar']);
$router->get('/empresas/sucursal', [EmpresaController::class, 'sucursal']);

// Marcas
$router->get('/marcas', [MarcaController::class, 'index']);
$router->get('/marcas/crear', [MarcaController::class, 'crear']);
$router->post('/marcas/crear', [MarcaController::class, 'crear']);
$router->get('/marcas/actualizar', [MarcaController::class, 'actualizar']);
$router->post('/marcas/actualizar', [MarcaController::class, 'actualizar']);
$router->post('/marcas/eliminar', [MarcaController::class, 'eliminar']);
$router->post('/marcas/cargar', [MarcaController::class, 'cargar']);

// Contratos
$router->get('/contratos', [ContratoController::class, 'index']);
$router->get('/contratos/crear', [ContratoController::class, 'crear']);
$router->post('/contratos/crear', [ContratoController::class, 'crear']);
$router->get('/contratos/actualizar', [ContratoController::class, 'actualizar']);
$router->post('/contratos/actualizar', [ContratoController::class, 'actualizar']);
$router->post('/contratos/eliminar', [ContratoController::class, 'eliminar']);
$router->get('/contratos/importar', [ContratoController::class, 'importar']);

// Servicios
$router->get('/servicios', [ServicioController::class, 'index']);
$router->post('/servicios', [ServicioController::class, 'index']);
$router->get('/servicios/crear', [ServicioController::class, 'crear']);
$router->post('/servicios/crear', [ServicioController::class, 'crear']);
$router->get('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/eliminar', [ServicioController::class, 'eliminar']);

// Sucursales
$router->get('/sucursales', [SucursalController::class, 'index']);
$router->get('/sucursal/crear', [SucursalController::class, 'crear']);
$router->post('/sucursal/crear', [SucursalController::class, 'crear']);
$router->get('/sucursal/actualizar', [SucursalController::class, 'actualizar']);
$router->post('/sucursal/actualizar', [SucursalController::class, 'actualizar']);

// Monedas
$router->get('/monedas', [MonedaController::class, 'index']);
$router->get('/monedas/crear', [MonedaController::class, 'crear']);
$router->post('/monedas/crear', [MonedaController::class, 'crear']);
$router->get('/monedas/actualizar', [MonedaController::class, 'actualizar']);
$router->post('/monedas/actualizar', [MonedaController::class, 'actualizar']);
$router->post('/monedas/eliminar', [MonedaController::class, 'eliminar']);

// Perfil
$router->get('/mi-perfil', [AuthController::class, 'perfil']);
$router->post('/mi-perfil', [AuthController::class, 'perfil']);

// Nuevo usuario
$router->get('/nuevo-usuario', [AuthController::class, 'registro']);

// Listar usuarios
$router->get('/usuarios', [AuthController::class, 'usuarios']);

$router->comprobarRutas();