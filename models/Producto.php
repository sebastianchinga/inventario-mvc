<?php

namespace Models;

class Producto extends ActiveRecord
{

    protected static $columnasDB = ['id', 'producto', 'modelo', 'serie', 'imagen', 'precio', 'comprador', 'fecha', 'categorias_id', 'empresas_id', 'marcas_id'];
    protected static $tabla = 'productos';

    public $id;
    public $producto;
    public $modelo;
    public $serie;
    public $imagen;
    public $precio;
    public $comprador;
    public $fecha;
    public $categorias_id;
    public $empresas_id;
    public $marcas_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->producto = $args['producto'] ?? '';
        $this->modelo = $args['modelo'] ?? '';
        $this->serie = $args['serie'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->comprador = $args['comprador'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->categorias_id = $args['categorias_id'] ?? '';
        $this->empresas_id = $args['empresas_id'] ?? '';
        $this->marcas_id = $args['marcas_id'] ?? '';
    }

    public function validar()
    {
        if (!$this->producto) {
            self::$alertas['danger'][] = 'Agrega un nombre';
        }

        if (!$this->modelo) {
            self::$alertas['danger'][] = 'Agrega un modelo';
        }

        if (!$this->serie) {
            self::$alertas['danger'][] = 'Agrega una serie';
        }

        if (!$this->imagen) {
            self::$alertas['danger'][] = 'Agrega una imágen';
        }

        if (!$this->precio) {
            self::$alertas['danger'][] = 'Agrega un precio';
        }

        if (!$this->comprador) {
            self::$alertas['danger'][] = 'Agrega un vendedor';
        }

        if (!$this->fecha) {
            self::$alertas['danger'][] = 'Agrega una fecha';
        }

        if (!$this->categorias_id) {
            self::$alertas['danger'][] = 'Selecciona una categoría';
        }

        if (!$this->empresas_id) {
            self::$alertas['danger'][] = 'Selecciona una empresa';
        }

        if (!$this->marcas_id) {
            self::$alertas['danger'][] = 'Selecciona una marca';
        }

        return self::$alertas;
    }
}
