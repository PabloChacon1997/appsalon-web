<?php


namespace Model;

class Usuario extends ActiveRecord {


  // Base de Datos
  protected static $tabla = 'usuarios';
  protected static $columnasDB = [
    'id',
    'nombre',
    'apellido',
    'email',
    'password',
    'telefono',
    'admin',
    'confirmado',
    'token'
  ];

  public $id;
  public $nombre;
  public $apellido;
  public $email;
  public $password;
  public $telefono;
  public $admin;
  public $confirmado;
  public $token;

  public function __construct($args=[])
  {
    $this->id = $args['id'] ?? null;
    $this->nombre = $args['nombre'] ?? '';
    $this->apellido = $args['apellido'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->password = $args['password'] ?? '';
    $this->telefono = $args['telefono'] ?? '';
    $this->admin = $args['admin'] ?? '0';
    $this->confirmado = $args['confirmado'] ?? '0';
    $this->token = $args['token'] ?? '';
  }

  // Mensajes de validacion para crear cuenta
  public function validar() {

    if (!$this->nombre) {
      self::$alertas['error'][] = 'El nombre es obligatorio';
    }

    if (!$this->apellido) {
      self::$alertas['error'][] = 'El apellido es obligatorio';
    }

    if (!$this->email) {
      self::$alertas['error'][] = 'El email el es obligatorio';
    }

    if (!$this->telefono) {
      self::$alertas['error'][] = 'El telefono el es obligatorio';
    }

    if (!$this->password) {
      self::$alertas['error'][] = 'El password el es obligatorio';
    }

    if (strlen($this->password) < 6) {
      self::$alertas['error'][] = 'El password debe tener minimo 6 caracteres';
    }

    return self::$alertas;
  }

  // Validar el logim
  public function validarLogin() {
    if (!$this->email) {
      self::$alertas['error'][] = 'El email el es obligatorio';
    }

    if (!$this->password) {
      self::$alertas['error'][] = 'El password el es obligatorio';
    }

    return self::$alertas;
  }

  public function validarEmail() {
    if (!$this->email) {
      self::$alertas['error'][] = 'El email el es obligatorio';
    }

    return self::$alertas;
  }

  // Revisa si usuario existe
  public function existeUsuario() {
    $query = "SELECT * FROM ".static::$tabla." WHERE email='".$this->email."' LIMIT 1;";
    $resultado = self::$db->query($query);
    if ($resultado->num_rows) {
      self::$alertas['error'][] = 'El usuario ya esta registrado';
    }
    return $resultado;
  }

  public function hasPassword() {
    $this->password = password_hash($this->password, PASSWORD_BCRYPT);
  }

  public function crearToken() {
    $this->token = uniqid();
  }

  public function validarPassword() {
    if (!$this->password) {
      self::$alertas['error'][] = 'El password el es obligatorio';
    }
    if (strlen($this->password) < 6) {
      self::$alertas['error'][] = 'El password debe tener minimo 6 caracteres';
    }

    return self::$alertas;
  }

  public function comprovarPasswordAndVerificado($password) {
    $resultado = password_verify($password, $this->password);
    if (!$resultado || !$this->confirmado) {
      self::$alertas['error'][] = 'Password incorrecto o cuenta sin confirmar';
    } else {
      return true;
    }
  }
}