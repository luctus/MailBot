<?php
class MailbotTools
{
  public static function getAttachErrors($path)
  {
    $errors = array();

    //Checkeamos si existe
    if(!file_exists($path))
      $errors[] = 'No se encontró el archivo en la ruta "' . $path .'"';

    //Checkeamos si pesa mas de 7MB
    elseif(filesize($path) > 7000000)
      $errors[] = 'El archivo de la ruta "' . $path . '" pesa más del límite (7MB)';

    if(sizeof($errors) == 0)
      return false;

    return $errors;
  }

  public static function getFullPath($path, $url, $test = true)
  {
    $path_tmp = $path;
    $url_tmp = $url;

    if(substr($path, -1) == '/')
      $path_tmp = substr($path, 0, -1);

    if(substr($url, 0, 1) == '/')
      $url_tmp = substr($url, 1);

    $full_path = $path_tmp . '/' . $url_tmp;
    
    if($test)
    {
      if(!self::getAttachErrors($full_path))
        return $full_path;
      else
      {
        if(!self::getAttachErrors(iconv("ISO-8859-1", "UTF-8", $full_path)))
          return iconv("ISO-8859-1", "UTF-8", $full_path);
      }  
    }

    return $full_path;
  }

  public static function notifyError($mb_mail)
  {
  	ProjectConfiguration::registerSwift();
    $swift_message = Swift_Message::newInstance();
    $swift_message->setSubject('[MailBot] Error al enviar: "' . $mb_mail->getSubjectClean() . '"');
    $swift_message->setFrom('no-reply@fen.uchile.cl');
    $swift_message->setPriority(1);
    if($mb_mail->getNotifyTo())
    {
      $swift_message->setTo(self::getAutoAddress($mb_mail->getNotifyTo()));
    }
    else
    {
      $swift_message->setTo(self::getAutoAddress($mb_mail->getStrfrom()));
    }

    $swift_message->addTo('devel.errores@fen.uchile.cl');
    $swift_message->setBody('Estimado usuario:<br/>Se ha producido el siguiente error al intentar enviar su correo masivo:<br/><br/>' .
            $mb_mail->getError() . '<br/><br/>Atte,<br/>Equipo de Desarrollo UDT', 'text/html');

    $mb_mail->getSwiftMailer()->send($swift_message);

    return false;
  }

  public static function notifyIfNecessary($mb_mail)
  {
    if(!$mb_mail->getNotifyTo())
      return false;

    if($mb_mail->getError())
      return false;

    ProjectConfiguration::registerSwift();
    $swift_message = Swift_Message::newInstance();
    $swift_message->setSubject('[MailBot] Resumen de envios para "' . $mb_mail->getSubjectClean() . '"');
    $swift_message->setFrom('no-reply@fen.uchile.cl');
    $swift_message->setPriority(1);
    $swift_message->setTo(self::getAutoAddress($mb_mail->getNotifyTo()));



    $swift_message->setBody('Estimado usuario:<br/>Nuestro sistema de envíos masivos (MailBot) acaba de terminar de enviar los correos solicitados.<br/><br/>'.
      'Total de correos enviados exitósamente: ' . $mb_mail->getNbSuccessRecipients() . '<br/>'.
      'Total de correos con error al enviar: ' . $mb_mail->getNbErrorRecipients() . '<br/><br/>'.
      'Para ver un reporte detallado del env&iacute;o, dir&iacute;jase a esta direcci&oacute;n:<br/>'.
      sfConfig::get('app_url').'/log_mail/report?id='.$mb_mail->getId().'&token='.$mb_mail->getToken().'<br/><br/>'.

      'Atte,<br/>Equipo de Desarrollo UDT', 'text/html');

    $mb_mail->getSwiftMailer()->send($swift_message);

    return false;
  }

  public static function getAutoAddress($address, $sanitize = false)
  {
    $partes = split('<', $address);
    if(count($partes) == 2)
    {
      $mail = trim(substr($partes[1], 0 , -1));
      $nombre = trim($partes[0]);
      if($sanitize)
        return $mail;
      return array($mail => $nombre);
    }
    else
    {
      return $address;
    }
  }

  public static function clean($string)
  {
    return $string;
//    $word_decode = utf8_decode($string);
//    $word_decode_latin = iconv("UTF-8", "ISO-8859-1", $word_decode);
//    return $word_decode_latin;
//
//    return iconv("UTF-8", "ISO-8859-1", $string);
//
//    $string = utf8_decode($string_);
//    print ($string_. ': ' . mb_detect_encoding($string_, "auto"));
//    print ($string.': ' . mb_detect_encoding($string, "auto"));
//
//    if(preg_match('%(?:
//        [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte
//        |\xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
//        |[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} # straight 3-byte
//        |\xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
//        |\xF0[\x90-\xBF][\x80-\xBF]{2}     # planes 1-3
//        |[\xF1-\xF3][\x80-\xBF]{3}         # planes 4-15
//        |\xF4[\x80-\x8F][\x80-\xBF]{2}     # plane 16
//        )+%xs',
//    $string))
//    {
//      //Se ha detectado UTF-8
//      //Es realmente utf_8?
//
//      if(mb_detect_encoding($string, "auto") == 'UTF-8')
//        return $string;
//      else
//        return utf8_encode($string);
//    }
//
//    else
//    {
//      return iconv("UTF-8", "ISO-8859-1", $string);
//    }
  }
}

?>
