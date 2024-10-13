<?php

namespace Models;

class Empresa extends ActiveRecord
{

    protected static $columnasDB = ['id', 'empresa', 'ruc'];
    protected static $tabla = 'empresas';

    public $id;
    public $empresa;
    public $ruc;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->empresa = $args['empresa'] ?? '';
        $this->ruc = $args['ruc'] ?? '';
    }

    public function setData($array = []) {
        $this->empresa = $array[0];
        $this->ruc = $array[1];
    }

    public function validar(): array
    {
        if (!$this->empresa) {
            self::$alertas['danger'][] = 'Agrega nombre de la empresa';
        }
        if (!$this->ruc) {
            self::$alertas['danger'][] = 'Agrega un RUC';
        }

        return self::$alertas;
    }
}
