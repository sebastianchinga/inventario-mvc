<?php

namespace Models;

class Marca extends ActiveRecord {

    protected static $columnasDB = ['id', 'marca'];
    protected static $tabla = 'marcas';

    public $id;
    public $marca;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->marca = $args['marca'] ?? '';
    }

    public function setData($array = []) {
        $this->marca = $array[0];
    }

    public function validar(): array {
        if (!$this->marca) {
            self::$alertas['danger'][] = 'Agrega nombre de marca';
        }

        return self::$alertas;
    }
    
    
}