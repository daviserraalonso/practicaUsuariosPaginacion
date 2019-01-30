<?php

    // require '../classes/autoload.php';
    // require '../classes/vendor/autoload.php';
    
    //   use izv\tools\Session;
      
    //   //$sesion = new SeSsion();
      
    //   $origen = "daviserraalonso@gmail.com";
    //   $alias = "Asignatura PHP";
    //   $destino = "daviserraalonso@gmail.com";
    //   $asunto = "Prueba de correo";
    //   $mensaje = "¿Llegará?";
    //   $cliente = new Google_Client();
      
    //   $cliente->setApplicationName('DWES');
    //   $cliente->setClientId('920693881810-qvaljlgeoqgnslhi9gidjke5duvoangq.apps.googleusercontent.com');
    //   $cliente->setClientSecret('qsSlGqP7m0iylYZBaYOIY3Om');
      
    //   $cliente->setAccessToken(file_get_contents('token.conf'));
      
  
    // if ($cliente->getAccessToken()) {
    //     $service = new Google_Service_Gmail($cliente);
    //     try {
    //         $mail = new PHPMailer\PHPMailer\PHPMailer();
    //         $mail->CharSet = "UTF-8";
    //         $mail->From = $origen;
    //         $mail->FromName = $alias;
    //         $mail->AddAddress($destino);
    //         $mail->AddReplyTo($origen, $alias);
    //         $mail->Subject = $asunto;
    //         $mail->Body = $mensaje;
    //         $mail->preSend();
    //         $mime = $mail->getSentMIMEMessage();
    //         $mime = rtrim(strtr(base64_encode($mime), '+/', '-_'), '=');
    //         $mensaje = new Google_Service_Gmail_Message();
    //         $mensaje->setRaw($mime);
    //         $service->users_messages->send('me', $mensaje);
    //         echo "Correo enviado correctamente";
    //         header("Location: https://dwse-scorpions.c9users.io/practicaUsuarios/");
    //     } catch (Exception $e) {
    //         echo ("Error en el envío del correo: " . $e->getMessage());
    //     }
    // } else {
    //     echo "No conectado con gmail";
    // }
    

    namespace izv\tools;
    
    use izv\app\App;
    use izv\tools\Tools;
    use izv\data\Usuario;
    
    class Email {
      
      static function sendMail($to, $subject, $message, $alias='', $from='') {
          $result = false;
          if(trim($to) !== '' && trim($subject) !== '') {
              if ($alias === '') {
                  $alias = APP::ALIAS;
                  $from = APP::EMAIL;
              }
              
              $cliente = new \Google_Client();
  
              $cliente->setApplicationName(App::APPLICATION_NAME);
              $cliente->setClientId(App::CLIENT_ID);
              $cliente->setClientSecret(App::CLIENT_SECRET);
              
              $cliente->setAccessToken(file_get_contents(App::TOKEN_FILE));
              
              if ($cliente->getAccessToken()) {
                  $service = new \Google_Service_Gmail($cliente);
                  try {
                      $mail = new \PHPMailer\PHPMailer\PHPMailer();
                      $mail->CharSet = "UTF-8";
                      $mail->From = $from;
                      $mail->FromName = $alias;
                      $mail->AddAddress($to);
                      $mail->AddReplyTo($from, $alias);
                      $mail->Subject = $subject;
                      $mail->Body = $message;
                      $mail->preSend();
                      $mime = $mail->getSentMIMEMessage();
                      $mime = rtrim(strtr(base64_encode($mime), '+/', '-_'), '=');
                      $mensaje = new \Google_Service_Gmail_Message();
                      $mensaje->setRaw($mime);
                      $service->users_messages->send('me', $mensaje);
                      $result = true;
                  } catch (\Exception $e) {
                      echo ("Error en el envío del correo: " . $e->getMessage());
                  }
                  
              }
          }
          return $result;
      }
      
      static function sendActivation(Usuario $usuario, $url){
          $to = $usuario->getCorreo();
          $subject = 'Correo de Activacion del Sistema Patata';
          //Proccess url
          $url = $url . '?code=';
          $code = Tools::encryptJWT(App::CODE, App::JWT_CODE);
          $id = Tools::encryptJWT($usuario->getId(), App::JWT_CODE);
          $url = $url . $code . $id;
          $message = 'Ha sido registrado en el Sistema Patata. Abra el siguiente link para activar la cuenta: ' . $url;
          echo $url;
          return self::sendMail($to, $subject, $message);
      }
      
      static function sendActivationP(Usuario $usuario) {
          $asunto = 'Correo de activación de la App: DWES IZV';
          $jwt = \Firebase\JWT\JWT::encode($usuario->getCorreo(), App::JWT_KEY);
          $enlace = Util::url() . 'doactivar.php?id='. $usuario->getId() .'&code=' . $jwt;
          $mensaje = "Correo de activación para:  ". $usuario->getNombre();
          $mensaje .= '<br><a href="' . $enlace . '">activar cuenta</a>';
          return self::sendMail($usuario->getCorreo(), $asunto, $mensaje);
      }
      
}
  

    