<?php

namespace Models;

class Servicio extends ActiveRecord {

    protected static $columnasDB = ['id', 'servicio', 'precio'];
    protected static $tabla = 'servicios';

    public $id;
    public $servicio;
    public $precio;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->servicio = $args['servicio'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }

    public function validar() {
        if (!$this->servicio) {
            self::$alertas['danger'][] = 'Agrega un servicio';
        }

        if (!$this->precio) {
            self::$alertas['danger'][] = 'Agrega un precio';
        }

        return self::$alertas;
    }
}