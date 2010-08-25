<?php

/**
 * mb_mailto module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage mb_mailto
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMb_mailtoGeneratorConfiguration extends sfModelGeneratorConfiguration
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
    return array(  'new' => NULL,  'export' =>   array(    'label' => 'Download as xls',  ),  'back' =>   array(    'label' => 'Back to Today\\\'s mails',  ),);
  }

  public function getListBatchActions()
  {
    return array(  '_delete' => NULL,);
  }

  public function getListParams()
  {
    return '%%id%% - %%mail_id%% - %%mailto%% - %%state%% - %%error%% - %%sent_at%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Recipients list';
  }

  public function getEditTitle()
  {
    return 'Edit Mb mailto';
  }

  public function getNewTitle()
  {
    return 'New Mb mailto';
  }

  public function getFilterDisplay()
  {
    return array(  0 => 'mail_id',  1 => 'mailto',  2 => 'state',  3 => 'sent_at',);
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
    return array(  0 => 'id',  1 => 'mail_id',  2 => 'mailto',  3 => 'state',  4 => 'error',  5 => 'sent_at',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'mail_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'mailto' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'state' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'created_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'sent_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'tries' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'error' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id' => array(),
      'mail_id' => array(),
      'mailto' => array(),
      'state' => array(),
      'created_at' => array(),
      'sent_at' => array(),
      'tries' => array(),
      'error' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'mail_id' => array(),
      'mailto' => array(),
      'state' => array(),
      'created_at' => array(),
      'sent_at' => array(),
      'tries' => array(),
      'error' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id' => array(),
      'mail_id' => array(),
      'mailto' => array(),
      'state' => array(),
      'created_at' => array(),
      'sent_at' => array(),
      'tries' => array(),
      'error' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id' => array(),
      'mail_id' => array(),
      'mailto' => array(),
      'state' => array(),
      'created_at' => array(),
      'sent_at' => array(),
      'tries' => array(),
      'error' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id' => array(),
      'mail_id' => array(),
      'mailto' => array(),
      'state' => array(),
      'created_at' => array(),
      'sent_at' => array(),
      'tries' => array(),
      'error' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'MbMailtoForm';
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
    return 'MbMailtoFormFilter';
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
