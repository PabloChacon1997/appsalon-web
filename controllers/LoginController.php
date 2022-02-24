<?php


namespace Controllers;

use Classes\Email;

use MVC\Router;
use Model\Usuario;

class LoginController {
  public static function login(Router $router) {
    $router->render('auth/login');
  }

  public static function logout() {
    echo 'Desde logout';
  }

  public static function olvide(Router $router) {
    $router->render('auth/olvide-password', []);
  }

  public static function recuperar() {
    echo 'Desde recuperar';
  }

  public static function crear(Router $router) {
    $usuario = new Usuario;

    $alertas = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Sincronizar con los datos de post
      $usuario->sincronizar($_POST);
      $alertas = $usuario->validar();

      // Revisar que alertas este vacio
      if (empty($alertas)) {
        
        // Verficar que el usuario este registrado
        $resultado = $usuario->existeUsuario();
        if ($resultado->num_rows) {
          $alertas = Usuario::getAlertas();
        } else {

          // Crea la cuenta

          // Hshear password
          $usuario->hasPassword();
          // Generar token unico
          $usuario->crearToken();

          // Enviar email
          
          $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
          $email->enviarConfirmacion();

          // Crear el usuario
          $resultado =  $usuario->guardar();
          if ($resultado) {
            header('Location: /mensaje');
          }          
        }

      }
    }
    $router->render('auth/crear-cuenta', [
      'usuario' => $usuario,
      'alertas' => $alertas,
    ]);
  }

  public static function mensaje(Router $router) {
    $router->render('auth/mensaje');
  }

  public static function confirmar(Router $router) {
    $alertas = [];

    $token = s($_GET['token']);
    $usuario = Usuario::where('token', $token);
    if (empty($usuario)) {
      // Monstrar mensaje de error
      Usuario::setAlerta('error', 'Token no válido');
    } else {
      // Confirmar el usuario
      $usuario->confirmado = "1";
      $usuario->token = null;
      $usuario->guardar();
      Usuario::setAlerta('exito', 'Cuenta comprobada correctamente');
    }

    // Obtener alertas
    $alertas = Usuario::getAlertas();

    // Renderizar la vista
    $router->render('auth/confirmar-cuenta', [
      'alertas' => $alertas,
    ]);
  }
}