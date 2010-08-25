<?php

/**
 * log_mail module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage log_mail
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseLog_mailGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'log_mail' : 'log_mail_'.$action;
  }
}
