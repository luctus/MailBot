<?php

/**
 * Cuenta filter form base class.
 *
 * @package    mailbot
 * @subpackage filter
 * @author     Gustavo Garcia - UDT
 */
abstract class BaseCuentaFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'username'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'credential' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'username'   => new sfValidatorPass(array('required' => false)),
      'credential' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cuenta_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cuenta';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'username'   => 'Text',
      'credential' => 'Text',
    );
  }
}
