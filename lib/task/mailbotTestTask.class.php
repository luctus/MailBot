<?php

class mailbotTestTask extends sfBaseTask
{
  protected function configure()
  {

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'backend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
    ));

    $this->namespace        = 'mailbot';
    $this->name             = 'test';
    $this->briefDescription = 'Task para hacer pruebas';
    $this->detailedDescription = <<<EOF
[mailbot:process|INFO] es una tarea que pone a prueba el algoritmo de mailbot
  [php symfony mailbot:test|INFO]
EOF;
  
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    $nb_per_test = 1;
    $nb_per_mail = 10;

    $this->log('Eliminando pruebas previas...');
      
    if(sfConfig::get('app_server') == 'devel')
    {
      foreach(MbMailPeer::doSelect(new Criteria()) as $mb_mail)
        $mb_mail->delete();
      foreach(LogMailPeer::doSelect(new Criteria()) as $log_mail)
        $log_mail->delete();
    }
    
    //Enviamos 10 correos con imagenes embebidas
    for($i = 0 ; $i < $nb_per_test ; $i++)
    {
    	$rand = rand(1, $nb_per_mail);

    	$mb_mail = $this->getMbMail('Test (embed) ' . $i);
    	$mb_mail->setBodyHtml('<p>Body test ' . $i . ', with <b>html</b> and an image embedded <img alt="hola!!" title="hola!!" src="test_image_file.jpg"/> oh yeah!</p>');
    	$mb_mail->setBodyText('body test, with no html ' . $i);
        $mb_mail->save();
      
        $this->send($mb_mail, $rand);
    	$this->log('Insertando mail "' . $mb_mail->getSubject() . '" (' . $rand . ' destinatarios)');
    	
    }

    //Enviamos 10 correos con subject con acento
    for($i = 0 ; $i < $nb_per_test ; $i++)
    {
    	$rand = rand(1, $nb_per_mail);

    	$mb_mail = $this->getMbMail('Test (con acéntos) ' . $i);
    	$mb_mail->setBodyHtml('<p>Body test ' . $i . ', with <b>html</b> y acéntos</p>');
    	$mb_mail->setBodyText('body test, with no html y acéntos' . $i);
    	$mb_mail->save();

      $this->send($mb_mail, $rand);
    	$this->log('Insertando mail "' . $mb_mail->getSubject() . '" (' . $rand . ' destinatarios)');

    }

    //Enviamos 10 correos con subject con acento mayuscula
    for($i = 0 ; $i < $nb_per_test ; $i++)
    {
    	$rand = rand(1, $nb_per_mail);

    	$mb_mail = $this->getMbMail('Test (con ACÉNTOS y Ñ) ' . $i);
    	$mb_mail->setBodyHtml('<p>Body test ' . $i . ', with <b>html</b> y acéntos</p>');
    	$mb_mail->setBodyText('body test, with no html y acéntos' . $i);
    	$mb_mail->save();

      $this->send($mb_mail, $rand);
    	$this->log('Insertando mail "' . $mb_mail->getSubject() . '" (' . $rand . ' destinatarios)');

    }

    //Enviamos 10 correos con imagenes adjuntas
    for($i = 0 ; $i < $nb_per_test ; $i++)
    {
    	$rand = rand(1, $nb_per_mail);

    	$mb_mail = $this->getMbMail('Test (attach image) ' . $i);
    	$mb_mail->setBodyHtml('<p>Body test ' . $i . ', with <b>html</b></p>');
    	$mb_mail->setBodyText('body test, with no html ' . $i);
    	$mb_mail->save();

        //Adjuntamos un archivo de imagen
        $this->attach($mb_mail, 'test_image_file.jpg');

        $this->send($mb_mail, $rand);
    	$this->log('Insertando mail "' . $mb_mail->getSubject() . '" (' . $rand . ' destinatarios)');

    }

    //Enviamos 10 correos con archivos adjuntas
    for($i = 0 ; $i < $nb_per_test ; $i++)
    {
    	$rand = rand(1, $nb_per_mail);

    	$mb_mail = $this->getMbMail('Test (attach txt) ' . $i);
    	$mb_mail->setBodyHtml('<p>Body test ' . $i . ', with <b>html</b></p>');
    	$mb_mail->setBodyText('body test, with no html ' . $i);
    	$mb_mail->save();

        //Adjuntamos un archivo de imagen
        $this->attach($mb_mail, 'test_text_file.txt');

        $this->send($mb_mail, $rand);
    	$this->log('Insertando mail "' . $mb_mail->getSubject() . '" (' . $rand . ' destinatarios)');

    }

    //Enviamos 10 correos con archivos adjuntas con nombres en utf-8
    for($i = 0 ; $i < $nb_per_test ; $i++)
    {
    	$rand = rand(1, $nb_per_mail);

    	$mb_mail = $this->getMbMail('Test (attach pdf utf-8) ' . $i);
    	$mb_mail->setBodyHtml('<p>Body test ' . $i . ', with <b>html</b></p>');
    	$mb_mail->setBodyText('body test, with no html ' . $i);
    	$mb_mail->save();

      //Adjuntamos un archivo de imagen
      $this->attach($mb_mail, 'curriculum/1358/CV NataliaLópez.doc');

      $this->send($mb_mail, $rand);
    	$this->log('Insertando mail "' . $mb_mail->getSubject() . '" (' . $rand . ' destinatarios)');

    }

    
    //Enviamos 10 correos sin html
    for($i = 0 ; $i < $nb_per_test ; $i++)
    {
    	$rand = rand(1, $nb_per_mail);

    	$mb_mail = $this->getMbMail('Test (no html) ' . $i);
    	$mb_mail->setBodyText('body test, with no html ' . $i);
    	$mb_mail->save();

        $this->send($mb_mail, $rand);
    	$this->log('Insertando mail "' . $mb_mail->getSubject() . '" (' . $rand . ' destinatarios)');

    }

    //Enviamos 10 correos sin html y un archivo adjunto
    for($i = 0 ; $i < $nb_per_test ; $i++)
    {
    	$rand = rand(1, $nb_per_mail);

    	$mb_mail = $this->getMbMail('Test (no html + attach txt) ' . $i);
    	$mb_mail->setBodyText('body test, with no html ' . $i);
    	$mb_mail->save();

        //Adjuntamos un archivo de imagen
        $this->attach($mb_mail, 'test_text_file.txt');

        $this->send($mb_mail, $rand);
    	$this->log('Insertando mail "' . $mb_mail->getSubject() . '" (' . $rand . ' destinatarios)');

    }

    //Enviamos 10 correos con imagenes embebidas que no existen
    for($i = 0 ; $i < $nb_per_test ; $i++)
    {
    	$rand = rand(1, $nb_per_mail);

    	$mb_mail = $this->getMbMail('Test (embed 404) ' . $i);
    	$mb_mail->setBodyHtml('<p>Body test ' . $i . ', with <b>html</b> and an image embedded <img alt="hola!!" title="hola!!" src="test_image_file_404.jpg"/> oh yeah!</p>');
    	$mb_mail->setBodyText('body test, with no html ' . $i);
    	$mb_mail->save();

        $this->send($mb_mail, $rand);
    	$this->log('Insertando mail "' . $mb_mail->getSubject() . '" (' . $rand . ' destinatarios)');

    }

    //Enviamos 10 correos con archivos adjuntas que no existen
    for($i = 0 ; $i < $nb_per_test ; $i++)
    {
    	$rand = rand(1, $nb_per_mail);

    	$mb_mail = $this->getMbMail('Test (attach txt 404) ' . $i);
    	$mb_mail->setBodyHtml('<p>Body test ' . $i . ', with <b>html</b></p>');
    	$mb_mail->setBodyText('body test, with no html ' . $i);
    	$mb_mail->save();

        //Adjuntamos un archivo de imagen
        $this->attach($mb_mail, 'test_text_file_404.txt');

        $this->send($mb_mail, $rand);
    	$this->log('Insertando mail "' . $mb_mail->getSubject() . '" (' . $rand . ' destinatarios)');

    }

    //Enviamos 10 correos con nombre de imagen embebida con tilde
    for($i = 0 ; $i < $nb_per_test ; $i++)
    {
    	$rand = rand(1, $nb_per_mail);

    	$mb_mail = $this->getMbMail('Test (embed con tilde) ' . $i);
    	$mb_mail->setBodyHtml('<p>Body test ' . $i . ', with <b>html</b> and an image embedded <img alt="hola!!" title="hola!!" src="test_image_á.jpg"/> oh yeah!</p>');
    	$mb_mail->setBodyText('body test, with no html ' . $i);
    	$mb_mail->save();

        $this->send($mb_mail, $rand);
    	$this->log('Insertando mail "' . $mb_mail->getSubject() . '" (' . $rand . ' destinatarios)');

    }

    //Enviamos 10 correos con nombre de imagen embebida con espacio
    for($i = 0 ; $i < $nb_per_test ; $i++)
    {
    	$rand = rand(1, $nb_per_mail);

    	$mb_mail = $this->getMbMail('Test (embed con "espacio") ' . $i);
    	$mb_mail->setBodyHtml('<p>Body test ' . $i . ', with <b>html</b> and an image embedded <img alt="hola!!" title="hola!!" src="test_image -.jpg"/> oh yeah!</p>');
    	$mb_mail->setBodyText('body test, with no html ' . $i);
    	$mb_mail->save();

        $this->send($mb_mail, $rand);
    	$this->log('Insertando mail "' . $mb_mail->getSubject() . '" (' . $rand . ' destinatarios)');

    }

    //Enviamos 10 correos con nombre de imagen embebida con ñ
    for($i = 0 ; $i < $nb_per_test ; $i++)
    {
    	$rand = rand(1, $nb_per_mail);

    	$mb_mail = $this->getMbMail('Test (embed con ñ) ' . $i);
    	$mb_mail->setBodyHtml('<p>Body test ' . $i . ', with <b>html</b> and an image embedded <img alt="hola!!" title="hola!!" src="test_image_ñ.jpg"/> oh yeah!</p>');
    	$mb_mail->setBodyText('body test, with no html ' . $i);
    	$mb_mail->save();

        $this->send($mb_mail, $rand);
    	$this->log('Insertando mail "' . $mb_mail->getSubject() . '" (' . $rand . ' destinatarios)');

    }

    //Enviamos 10 correos con nombre de archivos con tilde
    for($i = 0 ; $i < $nb_per_test ; $i++)
    {
    	$rand = rand(1, $nb_per_mail);

    	$mb_mail = $this->getMbMail('Test (attach txt con tilde) ' . $i);
    	$mb_mail->setBodyHtml('<p>Body test ' . $i . ', with <b>html</b></p>');
    	$mb_mail->setBodyText('body test, with no html ' . $i);
    	$mb_mail->save();

        $this->attach($mb_mail, 'test_text_á.txt');

        $this->send($mb_mail, $rand);
    	$this->log('Insertando mail "' . $mb_mail->getSubject() . '" (' . $rand . ' destinatarios)');

    }

    //Enviamos 10 correos con nombre de archivos con espacio
    for($i = 0 ; $i < $nb_per_test ; $i++)
    {
    	$rand = rand(1, $nb_per_mail);

    	$mb_mail = $this->getMbMail('Test (attach txt con "espacio") ' . $i);
    	$mb_mail->setBodyHtml('<p>Body test ' . $i . ', with <b>html</b></p>');
    	$mb_mail->setBodyText('body test, with no html ' . $i);
    	$mb_mail->save();

        $this->attach($mb_mail, 'test_text -.txt');

        $this->send($mb_mail, $rand);
    	$this->log('Insertando mail "' . $mb_mail->getSubject() . '" (' . $rand . ' destinatarios)');

    }

    //Enviamos 10 correos con nombre de archivos con ñ
    for($i = 0 ; $i < $nb_per_test ; $i++)
    {
    	$rand = rand(1, $nb_per_mail);

    	$mb_mail = $this->getMbMail('Test (attach txt con ñ) ' . $i);
    	$mb_mail->setBodyHtml('<p>Body test ' . $i . ', with <b>html</b></p>');
    	$mb_mail->setBodyText('body test, with no html ' . $i);
    	$mb_mail->save();

        $this->attach($mb_mail, 'test_text_ñ.txt');

        $this->send($mb_mail, $rand);
    	$this->log('Insertando mail "' . $mb_mail->getSubject() . '" (' . $rand . ' destinatarios)');

    }

    //Enviamos 10 correos repetido (con todos los datos iguales)
    for($i = 0 ; $i < $nb_per_test ; $i++)
    {
    	$rand = rand(1, $nb_per_mail);

    	$mb_mail = $this->getMbMail('Test (no html) ' . $i);
    	$mb_mail->setBodyText('body test, with no html ' . $i);
    	$mb_mail->save();

        $this->send($mb_mail, $rand);
    	$this->log('Insertando mail "' . $mb_mail->getSubject() . '" (' . $rand . ' destinatarios)');

    }

    //Enviamos 10 correos sin html con sleep 100
    sleep(100);

    for($i = 0 ; $i < $nb_per_test ; $i++)
    {
    	$rand = rand(1, $nb_per_mail);

    	$mb_mail = $this->getMbMail('Test (sleep 100) ' . $i);
    	$mb_mail->setBodyText('body test, with no html ' . $i);
    	$mb_mail->save();

        $this->send($mb_mail, $rand);
    	$this->log('Insertando mail "' . $mb_mail->getSubject() . '" (' . $rand . ' destinatarios)');

    }

    //Enviamos 10 correos sin html con sleep 30
    sleep(30);
    for($i = 0 ; $i < $nb_per_test ; $i++)
    {
    	$rand = rand(1, $nb_per_mail);

    	$mb_mail = $this->getMbMail('Test (sleep 30) ' . $i);
    	$mb_mail->setBodyText('body test, with no html ' . $i);
    	$mb_mail->save();

        $this->send($mb_mail, $rand);
    	$this->log('Insertando mail "' . $mb_mail->getSubject() . '" (' . $rand . ' destinatarios)');
    }

    //Enviamos 10 correos con un adjunto de gran tamaño
    for($i = 0 ; $i < $nb_per_test ; $i++)
    {
    	$rand = rand(1, $nb_per_mail);

    	$mb_mail = $this->getMbMail('Test (attach 2MB) ' . $i);
    	$mb_mail->setBodyText('body test, with no html ' . $i);
    	$mb_mail->save();

        $this->attach($mb_mail, 'test_2mb.mp3');

        $this->send($mb_mail, $rand);
    	$this->log('Insertando mail "' . $mb_mail->getSubject() . '" (' . $rand . ' destinatarios)');
    }

    //Enviamos 10 correos con varios archivos adjuntos
    for($i = 0 ; $i < $nb_per_test ; $i++)
    {
    	$rand = rand(1, $nb_per_mail);

    	$mb_mail = $this->getMbMail('Test (7 attach) ' . $i);
    	$mb_mail->setBodyText('body test, with no html ' . $i);
    	$mb_mail->save();

        $this->attach($mb_mail, 'test_2mb.mp3');
        $this->attach($mb_mail, 'test_image -.jpg');
        $this->attach($mb_mail, 'test_image_file.jpg');
        $this->attach($mb_mail, 'test_image_ñ.jpg');
        $this->attach($mb_mail, 'test_text -.txt');
        $this->attach($mb_mail, 'test_text_file.txt');
        $this->attach($mb_mail, 'test_text_ñ.txt');

        $this->send($mb_mail, $rand);
    	$this->log('Insertando mail "' . $mb_mail->getSubject() . '" (' . $rand . ' destinatarios)');
    }

    //Enviamos 10 correos con varios archivos embebidos
    for($i = 0 ; $i < $nb_per_test ; $i++)
    {
    	$rand = rand(1, $nb_per_mail);

    	$mb_mail = $this->getMbMail('Test (5 embed) ' . $i);
    	$mb_mail->setBodyHtml('<p>Body test ' . $i . ', with <b>html</b> and an image embedded <img alt="1f" title="hola!1!" src="Colinas azules.jpg"/><img alt="2f" title="hola!2!" src="test_image -.jpg"/><img alt="3f" title="hola!3!" src="test_image_file.jpg"/><img alt="4f" title="hola!4!" src="test_image_á.jpg"/><img alt="5f" title="hola!5!" src="test_image_ñ.jpg"/> oh yeah!</p>');
    	$mb_mail->setBodyText('body test, with no html ' . $i);
    	$mb_mail->save();

        $this->send($mb_mail, $rand);
    	$this->log('Insertando mail "' . $mb_mail->getSubject() . '" (' . $rand . ' destinatarios)');

    }
  }

  public function attach($mb_mail, $url)
  {
    $mb_mail_attachment = new MbMailAttachment();
    $mb_mail_attachment->setMailId($mb_mail->getId());
    $mb_mail_attachment->setUrl($url);
    $mb_mail_attachment->save();
  }

  public function send($mb_mail, $rand)
  {
    for($j = -6 ; $j < $rand ; $j++)
    {
    	$mb_mailto = new MbMailto();
    	$mb_mailto->setMailId($mb_mail->getId());
      if($j == -6)
        continue;//$mb_mailto->setMailto('ggarciag@fen.uchile.cl, gustavo.garcia.garate@ovi.com');
      elseif($j == -5)
        $mb_mailto->setMailto('ggarciag@udt.fen.uchile.cl');
      elseif($j == -4)
        $mb_mailto->setMailto('luctus@gmail.com ;  ggarciag@fen.uchile.cl');
      elseif($j == -3)
        $mb_mailto->setMailto ('gustavo.garcia.garate@ovi.com.');
      elseif($j == -2)
        $mb_mailto->setMailto('correo_mal_definido____');
      elseif($j == -1)
        continue;//$mb_mailto->setMailto('Gustavo Garcia <ggarciag@fen.uchile.cl>');
      else
        $mb_mailto->setMailto('mailbot' . ($j+500) . '@fen.uchile.cl');
      $mb_mailto->save();
    }
  }

  public function getMbMail($subject)
  {
    $mb_mail = new MbMail();
    $mb_mail->setSubject($subject);
    $mb_mail->setStrFrom('Gustavo Garcia <ggarciag@fen.uchile.cl>');
    $mb_mail->setPlatform('Mailbot');
    $mb_mail->setBatchSize(5);
    $mb_mail->setPublicPath('/sitios-web/mailbot2/data');
    $mb_mail->setNotifyTo('ggarciag@fen.uchile.cl');

    return $mb_mail;
  }
}