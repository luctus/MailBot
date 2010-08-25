<?php

/**
 * log_mail module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage log_mail
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseLog_mailGeneratorConfiguration extends sfModelGeneratorConfiguration
{
  public function getActionsDefault()
  {
    return array();
  }

  public function getFormActions()
  {
    return array(  '_delete' => NULL,  '_list' => NULL,  '_save' => NULL,  '_save_and_add' => NULL,);
  }

  public function getNewActions()
  {
    return array();
  }

  public function getEditActions()
  {
    return array();
  }

  public function getListObjectActions()
  {
    return array(  '_edit' => NULL,  '_delete' => NULL,);
  }

  public function getListActions()
  {
    return array(  '_new' => NULL,);
  }

  public function getListBatchActions()
  {
    return array();
  }

  public function getListParams()
  {
    return '%%id%% - %%platform%% - %%subject%% - %%progress%% - %%nb_errors%% - %%batch_size%% - %%state%% - %%error%% - %%created_at%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Past Mails';
  }

  public function getEditTitle()
  {
    return 'Edit Log mail';
  }

  public function getNewTitle()
  {
    return 'New Log mail';
  }

  public function getFilterDisplay()
  {
    return array(  0 => 'subject',  1 => 'platform',  2 => 'state',  3 => 'strfrom',  4 => 'created_at',);
  }

  public function getFormDisplay()
  {
    return array();
  }

  public function getEditDisplay()
  {
    return array();
  }

  public function getNewDisplay()
  {
    return array();
  }

  public function getListDisplay()
  {
    return array(  0 => 'id',  1 => 'platform',  2 => 'subject',  3 => 'progress',  4 => 'nb_errors',  5 => 'batch_size',  6 => 'state',  7 => 'error',  8 => 'created_at',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'username' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'body_html' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'body_text' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'created_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'subject' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'strfrom' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'reply_to' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'notify_to' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'platform' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'public_path' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'batch_size' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'state' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'error' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'token' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id' => array(),
      'username' => array(),
      'body_html' => array(),
      'body_text' => array(),
      'created_at' => array(),
      'subject' => array(),
      'strfrom' => array(),
      'reply_to' => array(),
      'notify_to' => array(),
      'platform' => array(),
      'public_path' => array(),
      'batch_size' => array(),
      'state' => array(),
      'error' => array(),
      'token' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'username' => array(),
      'body_html' => array(),
      'body_text' => array(),
      'created_at' => array(),
      'subject' => array(),
      'strfrom' => array(),
      'reply_to' => array(),
      'notify_to' => array(),
      'platform' => array(),
      'public_path' => array(),
      'batch_size' => array(),
      'state' => array(),
      'error' => array(),
      'token' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id' => array(),
      'username' => array(),
      'body_html' => array(),
      'body_text' => array(),
      'created_at' => array(),
      'subject' => array(),
      'strfrom' => array(),
      'reply_to' => array(),
      'notify_to' => array(),
      'platform' => array(),
      'public_path' => array(),
      'batch_size' => array(),
      'state' => array(),
      'error' => array(),
      'token' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id' => array(),
      'username' => array(),
      'body_html' => array(),
      'body_text' => array(),
      'created_at' => array(),
      'subject' => array(),
      'strfrom' => array(),
      'reply_to' => array(),
      'notify_to' => array(),
      'platform' => array(),
      'public_path' => array(),
      'batch_size' => array(),
      'state' => array(),
      'error' => array(),
      'token' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id' => array(),
      'username' => array(),
      'body_html' => array(),
      'body_text' => array(),
      'created_at' => array(),
      'subject' => array(),
      'strfrom' => array(),
      'reply_to' => array(),
      'notify_to' => array(),
      'platform' => array(),
      'public_path' => array(),
      'batch_size' => array(),
      'state' => array(),
      'error' => array(),
      'token' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'LogMailForm';
  }

  public function hasFilterForm()
  {
    return true;
  }

  /**
   * Gets the filter form class name
   *
   * @return string The filter form class name associated with this generator
   */
  public function getFilterFormClass()
  {
    return 'LogMailFormFilter';
  }

  public function getPaginateMethod()
  {
    return 'paginate';
  }

  public function getPagerMaxPerPage()
  {
    return 20;
  }

  public function getDefaultSort()
  {
    return array(null, null);
  }

  public function getWiths()
  {
    return array();
  }
  
  public function getQueryMethods()
  {
    return array();
  }
}
