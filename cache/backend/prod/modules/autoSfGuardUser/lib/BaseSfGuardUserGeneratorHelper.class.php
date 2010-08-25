<?php

/**
 * sfGuardUser module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage sfGuardUser
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseSfGuardUserGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'sf_guard_user' : 'sf_guard_user_'.$action;
  }
}
