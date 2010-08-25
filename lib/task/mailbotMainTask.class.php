<?php

class mailbotMainTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'backend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
    ));

    $this->namespace        = 'mailbot';
    $this->name             = 'main';
    $this->briefDescription = 'Task principal';
    $this->detailedDescription = <<<EOF
[mailbot:process|INFO] es el programa principal de MailBot 2.0. Es el responsable de asignar recursos
para el envio de correos.

  [php symfony mailbot:process|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    //something
    if(!MbWorker::isRunning())
    {
    	$pid = getmypid();
    	MbWorker::powerOn($pid);
 
    	$this->log('Lanzando mailbot:mailer (pid:' . $pid . ')');
    	$this->runTask('mailbot:mailer', array(), array('application' => 'frontend'));   	
    }
    
    else
    {
    	$this->log('Task mailbot:mailer aun activa');
    }
    
  }
}