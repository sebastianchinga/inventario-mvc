<?php

namespace Models;

use DateTime;

class Contrato extends ActiveRecord
{

    protected static $columnasDB = ['id', 'cliente', 'dni', 'tiempo', 'inicio', 'caducidad', 'servicios_id'];
    protected static $tabla = 'contratos';

    public $id;
    public $cliente;
    public $dni;
    public $tiempo;
    public $inicio;
    public $caducidad;
    public $servicios_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->cliente = $args['cliente'] ?? '';
        $this->dni = $args['dni'] ?? '';
        $this->tiempo = $args['tiempo'] ?? '';
        $this->inicio = $args['inicio'] ?? '';
        $this->caducidad = $args['caducidad'] ?? '';
        $this->servicios_id = $args['servicios_id'] ?? '';
    }

    public function validar(): array
    {
        if (!$this->cliente) {
            self::$alertas['danger'][] = 'Agrega un cliente';
        }

        if (!$this->dni) {
            self::$alertas['danger'][] = 'Agrega un dni';
        }

        if (!$this->inicio) {
            self::$alertas['danger'][] = 'Agrega una fecha de inicio';
        }

        if (!$this->servicios_id) {
            self::$alertas['danger'][] = 'Selecciona un servicio';
        }

        if (!$this->tiempo) {
            self::$alertas['danger'][] = 'Agrega un tiempo';
        }

        return self::$alertas;
    }

    public function setCaducidad()
    {
        $tiempo = $this->tiempo;
        $tiempo = filter_var($tiempo, FILTER_VALIDATE_INT);

        switch ($tiempo) {
            case 1:
                $fecha = new DateTime($this->inicio);
                $fecha->modify('+1 days');
                $cad = $fecha->format('Y-m-d');
                $this->caducidad = $cad;
                break;
            case 2:
                $fecha = new DateTime($this->inicio);
                $fecha->modify('+30 days');
                $cad = $fecha->format('Y-m-d');
                $this->caducidad = $cad;
                break;
            case 3:
                $fecha = new DateTime($this->inicio);
                $fecha->modify('+90 days');
                $cad = $fecha->format('Y-m-d');
                $this->caducidad = $cad;
                break;
            case 4:
                $fecha = new DateTime($this->inicio);
                $fecha->modify('+180 days');
                $cad = $fecha->format('Y-m-d');
                $this->caducidad = $cad;
                break;
            case 5:
                $fecha = new DateTime($this->inicio);
                $fecha->modify('+365 days');
                $cad = $fecha->format('Y-m-d');
                $this->caducidad = $cad;
                break;

            default:
                break;
        }
    }
}
