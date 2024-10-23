<?php

namespace Models;

class Sucursal extends ActiveRecord {

    protected static $columnasDB = ['id', 'provincia', 'direccion', 'empresas_id'];
    protected static $tabla = 'sucursales';

    public $id;
    public $provincia;
    public $direccion;
    public $empresas_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->provincia = $args['provincia'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
        $this->empresas_id = $args['empresas_id'] ?? '';
    }

    public function validar(): array {
        if (!$this->provincia) {
            self::$alertas['danger'][] = 'Agrega una provincia';
        }

        if (!$this->direccion) {
            self::$alertas['danger'][] = 'Agrega una dirección';
        }

        if (!$this->empresas_id) {
            self::$alertas['danger'][] = 'Selecciona una empresa';
        }

        return self::$alertas;
    }
}