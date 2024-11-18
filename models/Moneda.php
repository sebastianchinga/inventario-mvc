<?php

namespace Models;

class Moneda extends ActiveRecord {

    protected static $columnasDB = ['id', 'moneda', 'valor', 'codigo', 'simbolo'];
    protected static $tabla = 'monedas';

    public $id;
    public $moneda;
    public $valor;
    public $codigo;
    public $simbolo;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->moneda = $args['moneda'] ?? '';
        $this->valor = $args['valor'] ?? '';
        $this->codigo = $args['codigo'] ?? '';
        $this->simbolo = $args['simbolo'] ?? '';
    }

    public function validar(): array {
        if (!$this->moneda) {
            self::$alertas['danger'][] = 'Agrega nombre de la moneda';
        }

        if (!$this->valor) {
            self::$alertas['danger'][] = 'Agrega valor de cambio';
        }

        if (!$this->codigo) {
            self::$alertas['danger'][] = 'Agrega un código de moneda';
        }

        if (!$this->simbolo) {
            self::$alertas['danger'][] = 'Agrega un símbolo de moneda';
        }

        return self::$alertas;
    }

}