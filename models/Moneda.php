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

}