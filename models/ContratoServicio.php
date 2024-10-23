<?php

namespace Models;

class ContratoServicio extends ActiveRecord {

    protected static $columnasDB = ['id', 'cliente', 'inicio', 'caducidad', 'servicio', 'precio'];
    protected static $tabla = 'contratos';

    public $id;
    public $cliente;
    public $inicio;
    public $caducidad;
    public $servicio;
    public $precio;

    public static function all() {
        $query = "SELECT contratos.id, cliente, inicio, caducidad, servicios.servicio, servicios.precio FROM ". static::$tabla ." LEFT JOIN servicios ON servicios_id = servicios.id";
        $resultado = static::consultarSQL($query);
        return $resultado;
    }
}