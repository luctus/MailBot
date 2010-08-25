<?php

class mailbotCleanTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
    ));

    $this->namespace        = 'mailbot';
    $this->name             = 'clean';
    $this->briefDescription = 'Task se mantencion';
    $this->detailedDescription = <<<EOF
[mailbot:process|INFO] es el programa responsable de liberar recursos
para el envio de correos.

  [php symfony mailbot:process|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    if($mb_mail_list = MbMailPeer::getEnviados())
    {
    	foreach($mb_mail_list as $mb_mail)
    	{
    		$mb_mail->delete();
    	}
    }
    
  }
}