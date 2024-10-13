<?php

namespace Models;

class Categoria extends ActiveRecord
{

    protected static $columnasDB = ['id', 'categoria'];
    protected static $tabla = 'categorias';

    public $id;
    public $categoria;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->categoria = $args['categoria'] ?? '';
    }

    public function setData($categoria)
    {
        $this->categoria = $categoria;
    }

    public function validar()
    {
        if (!$this->categoria) {
            self::$alertas['danger'][] = 'Agrega una categoría';
        }

        return self::$alertas;
    }


}
