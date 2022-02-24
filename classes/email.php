<?php 


namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {


  public $email;
  public $nombre;
  public $token;



  public function __construct($email, $nombre, $token)
  {
    $this->email = $email; 
    $this->nombre = $nombre;
    $this->token = $token; 
  }

  public function enviarConfirmacion() {

    

    // Crear el objeto email
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Port = 2525;
    $mail->Username = 'f4aecc9ccd9107';
    $mail->Password = '6b529534b5a3fd';

    $mail->setFrom('cuentas@appsalon.com');
    $mail->addAddress('cuenta@appsalon.com', 'Appsalon.com');
    $mail->Subject = 'Confirma tu cuenta';

    // Set HTML

    $mail->isHTML(TRUE);
    $mail->CharSet = 'UTF-8';

    $contenido = "<html>";
    $contenido .= "<p><strong>Hola ".$this->nombre."</strong> has creado tu cuenta en AppSalon, solo debes confirmarla presionando el siguiente enlace</p>";
    // debuguear($this->token);
    $contenido .= "<p>Presiona aquí <a href='http://localhost:3000/confirmar-cuenta?token=".$this->token."'>Confirmar cuenta</a></p>";
    $contenido .= "Si tu no solicitaste esta cuenta puedes ignorar este mensaje";
    $contenido .= "</html>";

    $mail->Body = $contenido;

    // Enviar email
    $mail->send();
  }
}