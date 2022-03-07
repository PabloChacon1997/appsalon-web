<?php


namespace Controllers;

use Classes\Email;

use MVC\Router;
use Model\Usuario;

class LoginController {
  public static function login(Router $router) {

    $alertas = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $auth = new Usuario($_POST);

      $alertas = $auth->validarLogin();

      if (empty($alertas)) {
        // Comprobar que exista el usuario
        $usuario = Usuario::where('email', $auth->email);
        if ($usuario) {
          // Verificar el password
          if ($usuario->comprovarPasswordAndVerificado($auth->password)) {
            // Autenticar usuario
            // session_start();
            $_SESSION['id'] = $usuario->id;
            $_SESSION['nombre'] = $usuario->nombre." ".$usuario->apellido;
            $_SESSION['email'] = $usuario->email;
            $_SESSION['login'] = true;

            // Redireccionamiento
            if($usuario->admin === "1") {
              header('Location: /admin');
            } else {
              header('Location: /cita');
            }

          }
        } else {
          Usuario::setAlerta('error', 'Usuario no encontrado');
        }
      }
    }

    $alertas = Usuario::getAlertas();
    $router->render('auth/login', [
      'alertas' => $alertas,
    ]);
  }

  public static function logout() {
    $_SESSION = [];
    header('Location: /');
  }

  public static function olvide(Router $router) {
    $alertas = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $auth = new Usuario($_POST);
      $alertas = $auth->validarEmail();

      if (empty($alertas)) {
        $usuario = Usuario::where('email', $auth->email);

        if ($usuario && $usuario->confirmado === "1") {
          // Generar un teken Temporal
          $usuario->crearToken();
          $usuario->guardar();
          
          // Enviar email
          $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
          $email->enviarInstrucciones();

          // Alerta de exito
          Usuario::setAlerta('exito', 'Revisa tu email');
        } else {
          Usuario::setAlerta('error', 'El Usuario no existe o no esta confirmado');
        }
      }
    }

    $alertas = Usuario::getAlertas();

    $router->render('auth/olvide-password', [
      'alertas' => $alertas,
    ]);
  }

  public static function recuperar(Router $router) {
    $alertas = [];
    $error = false;

    $token = s($_GET['token']);
    // dBuscar usuario por el token
    $usuario = Usuario::where('token', $token);

    if (empty($usuario)) {
      Usuario::setAlerta('error', 'Token No Válido');
      $error = true;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Leer el password y guardarlo
      $password = new Usuario($_POST);
      $alertas = $password->validarPassword();

      if (empty($alertas)) {
        $usuario->password = null;
        $usuario->password = $password->password;
        $usuario->hasPassword();
        $usuario->token = null;
        $resultado = $usuario->guardar();
        if ($resultado) {
          header('Location: /');
        }
      }

    }

    $alertas = Usuario::getAlertas();
    $router->render('auth/recuperar-password', [
      'alertas' => $alertas,
      'error' => $error,
    ]);
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