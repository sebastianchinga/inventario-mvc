<?php

namespace Models;

class Tiempo extends ActiveRecord {

    protected static $columnasDB = ['id', 'nombre', 'dias'];
    protected static $tabla = 'tiempos';
    
    public $id;
    public $nombre;
    public $dias;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->dias = $args['dias'] ?? '';
    }

    
}