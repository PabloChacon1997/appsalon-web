<?php


namespace Controllers;

use MVC\Router;

class CitaController {
  public static function index(Router $router) {
    $nombre = $_SESSION['nombre'];
    $router->render('cita/index', [
      'nombre' => $nombre
    ]);
  }
}