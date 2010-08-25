<?php

/**
 * LogMailto filter form base class.
 *
 * @package    mailbot
 * @subpackage filter
 * @author     Gustavo Garcia - UDT
 */
abstract class BaseLogMailtoFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'mail_id'    => new sfWidgetFormPropelChoice(array('model' => 'LogMail', 'add_empty' => true)),
      'mailto'     => new sfWidgetFormFilterInput(),
      'state'      => new sfWidgetFormFilterInput(),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'sent_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'tries'      => new sfWidgetFormFilterInput(),
      'error'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'mail_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'LogMail', 'column' => 'id')),
      'mailto'     => new sfValidatorPass(array('required' => false)),
      'state'      => new sfValidatorPass(array('required' => false)),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'sent_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'tries'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'error'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('log_mailto_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'LogMailto';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'mail_id'    => 'ForeignKey',
      'mailto'     => 'Text',
      'state'      => 'Text',
      'created_at' => 'Date',
      'sent_at'    => 'Date',
      'tries'      => 'Number',
      'error'      => 'Text',
    );
  }
}
