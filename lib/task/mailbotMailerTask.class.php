<?php

class mailbotMailerTask extends sfBaseTask
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
    $this->name             = 'mailer';
    $this->briefDescription = 'Task lanzado por mailbot:main';
    $this->detailedDescription = <<<EOF
[mailbot:process|INFO] es el programa responsable de distribuir los correos
  [php symfony mailbot:process|INFO]
EOF;
  
  }

    protected function execute($arguments = array(), $options = array())
    {
        // initialize the database connection
        $databaseManager = new sfDatabaseManager($this->configuration);
        $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

        $this->log('mailer on...');
        while(true)
        {
            $this->log('----------------------------------------------------------');

            if($mb_mail_list = MbMailPeer::getPendientes())
            {
                foreach($mb_mail_list as $mb_mail)
                {
                    MbWorker::setActive($mb_mail->getId());

                    $mb_mail->reload();

                    if(!$mb_mail->getToken())
                    {
                        //$token = uniqid(null, true);
                        $mb_mail->setToken(sha1(rand(111111,999999) . $mb_mail->getSubject()));
                        $mb_mail->save();
                    }

                    $this->log('Procesando email: ' . $mb_mail->getSubject() . ' (batch size: ' . $mb_mail->getBatchSize() . ')');

                    if($next_recipients = $mb_mail->getNextRecipients())
                    {
                        foreach($next_recipients as $i => $mb_mailto)
                        {
                            if($i%2 == 0)
                                $mb_mail->reload();

                            MbWorker::setActiveRecipient($mb_mailto->getId());

                            if($mb_mail->getState() == 'stop')
                            {
                                $this->log('-- !!Correo detenido desde aplicacion');
                                break;
                            }

                            $this->log('- Enviando a: ' . $mb_mailto->getMailto());

                            if(!$mb_mail->send($mb_mailto))
                            {
                                $this->log('-- Correo con errores');
                                break;
                            }

                            sleep(1);
                        }
                        MbWorker::setActiveRecipient(0);
                    }

                    if($mb_mail->getState() != 'stop' && !$mb_mail->hasMoreRecipients())
                    {
                        $this->log('-- Termino de envio de ' . $mb_mail->getSubject());

                        $mb_mail->setState('ok');
                        $mb_mail->save();
                        $mb_mail->notifyIfNecessary();
                    }
                    MbWorker::setActive(0);
                }

            }
            else
            {
                $this->log('No hay mails para enviar');
                break;
            }
        }
        $this->log('mailer off...');
    }
}