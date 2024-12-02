<?php

namespace Controllers;

use Models\Usuario;
use MVC\Router;

class AuthController
{

    public static function registro() {
        $nombre = 'Ramses';
        $email = 'jchingapalacios05@gmail.com';
        $password = 'admin';

        $usuario = new Usuario();
        $usuario->setData($nombre, $email, $password);
        $usuario->hashearPassword();

        $resultado = $usuario->guardar();

        if ($resultado) {
            header('Location: /');
        }

    }

    public static function login(Router $router)
    {

        $alertas = [];
        $usuario = new Usuario();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST['usuario']);

            $alertas = $usuario->validar();

            if (empty($alertas)) {
                $auth = Usuario::where('email', $usuario->email);
                if (!$auth) {
                    Usuario::setAlertas('danger', 'Email no registrado');
                } else {
                    $res = $auth->validarPassword($usuario->password);
                    if ($res) {
                        $auth->iniciarSesion();
                    } else {
                        Usuario::setAlertas('danger', 'Password incorrecto');
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/login', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function cerrar()
    {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }

    public static function perfil(Router $router)
    {
        Autenticar();
        $id = $_SESSION['id'];
        $nombre = $_SESSION['nombre'];

        $alerta = $_GET['alerta'];
        $alerta = filter_var($alerta, FILTER_VALIDATE_INT);

        $usuario = Usuario::find($id);
        $password = $usuario->password;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST['usuario']);

            if ($usuario->password === '') {
                $usuario->password = $password;
            }

            $usuario->hashearPassword();
            
            $resultado = $usuario->guardar();

            if ($resultado) {
                header('Location: /mi-perfil?alerta=1');
            }
        }

        $router->render('perfil/index', [
            'usuario' => $usuario,
            'alerta' => $alerta,
            'nombre' => $nombre
        ]);
    }

    public static function usuarios(Router $router) {
        Autenticar();
        $nombre = $_SESSION['nombre'];
        $usuarios = Usuario::all();
        $router->render('auth/usuarios', [
            'usuarios' => $usuarios,
            'nombre' => $nombre
        ]);
    }
}
