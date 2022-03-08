<?php


namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;
use MVC\Router;

class APIController {
  public static function index(Router $router) {
    $servcios = Servicio::all();
    echo json_encode($servcios);

  }

  public static function guardar() {

    // Almacena la cita y devuelve el id
    $cita = new Cita($_POST);
    $resultado = $cita->guardar();

    $id = $resultado['id'];

    // Almacena las citas y servicios
    $idServicios = explode(",", $_POST['servicios']);

    // Almacena los servicios con el id de la cita
    foreach($idServicios as $idServicio) {
      $args = [
        'citaId' => $id,
        'servicioId' => $idServicio
      ];

      $citaServicio = new CitaServicio($args);
      $citaServicio->guardar();
    }

    // Recibimos una respuesta
    echo json_encode(['resultado' => $resultado]);
    

  }

  public static function eliminar() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = $_POST['id'];
      $cita = Cita::find($id);
      $cita->eliminar();
      header('Location: '.$_SERVER['HTTP_REFERER']);
    }
    echo 'Eliminando cita';
  }
}
