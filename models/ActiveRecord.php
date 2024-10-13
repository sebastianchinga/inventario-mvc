<?php

namespace Models;

class ActiveRecord
{

    protected static $alertas = [];
    protected static $columnasDB = [];
    protected static $db;
    protected static $tabla = '';

    public static function setDB($database)
    {
        self::$db = $database;
    }

    public static function setAlertas($tipo, $mensaje)
    {
        static::$alertas[$tipo][] = $mensaje;
    }

    public function setImagen($image)
    {
        if (!is_null($this->id)) {
            $this->eliminarImagen();
        }

        if ($image) {
            $this->imagen = $image;
        }
    }

    public function eliminarImagen()
    {
        $fileExiste = file_exists(CARPETA_PRODUCTOS . $this->imagen);
        if ($fileExiste) {
            unlink(CARPETA_PRODUCTOS . $this->imagen);
        }
    }

    public static function getAlertas()
    {
        return static::$alertas;
    }

    public function guardar()
    {
        $resultado = '';

        if (is_null($this->id)) {
            $resultado = $this->crear();
        } else {
            $resultado = $this->actualizar();
        }

        return $resultado;
    }

    public function atributos()
    {
        $atributos = [];

        foreach (static::$columnasDB as $columna) {
            if ($columna == 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizar()
    {
        $columnas = $this->atributos();

        $sanitizado = [];

        foreach ($columnas as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    public function crear()
    {
        $atributos = $this->sanitizar();

        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(', ', array_keys($atributos));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "')";

        $resultado = self::$db->query($query);
        return $resultado;
    }

    public function actualizar()
    {
        $atributos = $this->sanitizar();

        $formato = [];
        foreach ($atributos as $key => $value) {
            $formato[] = "$key = '$value'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', array_values($formato));
        $query .= " WHERE id = " . $this->id;

        $resultado = self::$db->query($query);
        return $resultado;
    }

    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function consultarSQL($query)
    {
        $resultado = self::$db->query($query);

        $array = [];
        while ($registro = mysqli_fetch_assoc($resultado)) {
            $array[] = static::crearObjeto($registro);
        }

        $resultado->free();
        return $array;
    }

    public static function crearObjeto($registro)
    {
        $objeto = new static;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = " . $id;
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function eliminar()
    {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . $this->id;
        $resultado = self::$db->query($query);

        if ($resultado) {
            $this->eliminarImagen();
            return $resultado;
        }
    }

    public static function where($columna, $key)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE $columna = '" . $key . "'";
        $resultado = static::consultarSQL($query);
        return array_shift($resultado);
    }

    public static function query($columna, $key)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE $columna = '$key'";
        $resultado = self::$db->query($query);
        return $resultado;
    }
}
