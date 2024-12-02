<?php

namespace Models;

class Usuario extends ActiveRecord
{

    protected static $columnasDB = ['id', 'nombre', 'email', 'password'];
    protected static $tabla = 'usuarios';

    public $id;
    public $nombre;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function setData($nombre, $email, $password) {
        $this->id = null;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
    }

    public function validar()
    {
        if (!$this->email) {
            self::$alertas['danger'][] = 'Agrega un email';
        }

        if (!$this->password) {
            self::$alertas['danger'][] = 'Agrega un password';
        }

        return self::$alertas;
    }

    public function validarPassword($password) {
        $resultado = password_verify($password, $this->password);

        return $resultado;
    }

    public function iniciarSesion() {
        session_start();
        $_SESSION['nombre'] = $this->nombre;
        $_SESSION['email'] = $this->email;
        $_SESSION['login'] = true;
        $_SESSION['id'] = $this->id;

        header('Location: /admin');
    }

    public function hashearPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

}
