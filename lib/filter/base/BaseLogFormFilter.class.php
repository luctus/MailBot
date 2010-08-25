<?php

/**
 * Log filter form base class.
 *
 * @package    mailbot
 * @subpackage filter
 * @author     Gustavo Garcia - UDT
 */
abstract class BaseLogFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'cuenta_id'  => new sfWidgetFormPropelChoice(array('model' => 'Cuenta', 'add_empty' => true)),
      'what'       => new sfWidgetFormFilterInput(),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'cuenta_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Cuenta', 'column' => 'id')),
      'what'       => new sfValidatorPass(array('required' => false)),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('log_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Log';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'cuenta_id'  => 'ForeignKey',
      'what'       => 'Text',
      'created_at' => 'Date',
    );
  }
}
