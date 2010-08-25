<?php

/**
 * log_mailto module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage log_mailto
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseLog_mailtoGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'log_mailto' : 'log_mailto_'.$action;
  }
}
