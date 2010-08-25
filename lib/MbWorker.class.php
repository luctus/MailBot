<?php
class MbWorker
{
	public static function getStatusFile()
	{
		return sfConfig::get('sf_data_dir').'/mailbot_status.txt';
	}
	
	public static function getPidFile()
	{
		return sfConfig::get('sf_data_dir').'/mailbot_pid.txt';
	}

  public static function getActiveFile()
  {
    return sfConfig::get('sf_data_dir').'/mailbot_active.txt';
  }

  public static function getActiveRecipientFile()
  {
    return sfConfig::get('sf_data_dir').'/mailbot_active_recipient.txt';
  }
	
	public static function isRunning()
	{
		$last_pid = false;
    if($mailbot_pid = @fopen(self::getPidFile(),'r'))
    {
    	$last_pid = fread($mailbot_pid, 10);
      fclose($mailbot_pid);
    }
    
    if(!$last_pid)
      return false;
    
    return posix_kill($last_pid, 0);
	}
	
	public static function powerOn($pid = false)
	{
		$mailbot_pid = fopen(self::getPidFile(),'w+');
    fwrite($mailbot_pid, $pid);
    fclose($mailbot_pid);
	}
		
	public static function powerOff()
	{
		
	}

  public static function setActive($id)
  {
    $mb_active_id = fopen(self::getActiveFile(),'w+');
    fwrite($mb_active_id, $id);
    fclose($mb_active_id);
  }

  public static function getActive()
  {
    if($mb_active_id = @fopen(self::getActiveFile(),'r'))
    {
    	$current_id = fread($mb_active_id, 50);
      fclose($mb_active_id);

      return $current_id;
    }
    return false;
  }

  public static function setActiveRecipient($id)
  {
    $mb_active_recipient_id = fopen(self::getActiveRecipientFile(),'w+');
    fwrite($mb_active_recipient_id, $id);
    fclose($mb_active_recipient_id);
  }

  public static function getActiveRecipient()
  {
    if($mb_active_recipient_id = @fopen(self::getActiveRecipientFile(),'r'))
    {
    	$current_id = fread($mb_active_recipient_id, 50);
      fclose($mb_active_recipient_id);

      return $current_id;
    }
    return false;
  }

  
}