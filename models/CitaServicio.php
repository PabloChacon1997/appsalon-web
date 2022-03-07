<?php


namespace Model;


class CitaServicio extends ActiveRecord {
  // Base de datos
  protected static $tabla = "citasServicios";
  protected static $columnasDB = [
    'id',
    'citaId',
    'servicioId'
  ];

  public $id;
  public $citaId;
  public $servicioId;

  public function __construct($args=[])
  {
    $this->id = $args['id'] ?? null;
    $this->citaId = $args['citaId'] ?? null;
    $this->servicioId = $args['servicioId'] ?? null;
  }

}