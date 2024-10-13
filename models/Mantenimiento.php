<?php

namespace Models;

class Mantenimiento extends ActiveRecord {

    protected static $columnasDB = ['id', 'fecha_inicio', 'asignado', 'fecha_fin', 'precio', 'descripcion', 'productos_id'];
    protected static $tabla = 'mantenimientos';

    public $id;
    public $fecha_inicio;
    public $asignado;
    public $fecha_fin;
    public $precio;
    public $descripcion;
    public $productos_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->fecha_inicio = $args['fecha_inicio'] ?? '';
        $this->asignado = $args['asignado'] ?? '';
        $this->fecha_fin = $args['fecha_fin'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->productos_id = $args['productos_id'] ?? '';
    }
}