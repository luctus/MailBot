<?php

/**
 * mb_mailto module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage mb_mailto
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseMb_mailtoGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'mb_mailto' : 'mb_mailto_'.$action;
  }
}
