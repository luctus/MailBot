<?php

/**
 * mb_mail module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage mb_mail
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseMb_mailGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'mb_mail' : 'mb_mail_'.$action;
  }
}
