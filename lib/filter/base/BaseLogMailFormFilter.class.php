<?php

/**
 * LogMail filter form base class.
 *
 * @package    mailbot
 * @subpackage filter
 * @author     Gustavo Garcia - UDT
 */
abstract class BaseLogMailFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'username'    => new sfWidgetFormFilterInput(),
      'body_html'   => new sfWidgetFormFilterInput(),
      'body_text'   => new sfWidgetFormFilterInput(),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'subject'     => new sfWidgetFormFilterInput(),
      'strfrom'     => new sfWidgetFormFilterInput(),
      'reply_to'    => new sfWidgetFormFilterInput(),
      'notify_to'   => new sfWidgetFormFilterInput(),
      'platform'    => new sfWidgetFormFilterInput(),
      'public_path' => new sfWidgetFormFilterInput(),
      'batch_size'  => new sfWidgetFormFilterInput(),
      'state'       => new sfWidgetFormFilterInput(),
      'error'       => new sfWidgetFormFilterInput(),
      'token'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'username'    => new sfValidatorPass(array('required' => false)),
      'body_html'   => new sfValidatorPass(array('required' => false)),
      'body_text'   => new sfValidatorPass(array('required' => false)),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'subject'     => new sfValidatorPass(array('required' => false)),
      'strfrom'     => new sfValidatorPass(array('required' => false)),
      'reply_to'    => new sfValidatorPass(array('required' => false)),
      'notify_to'   => new sfValidatorPass(array('required' => false)),
      'platform'    => new sfValidatorPass(array('required' => false)),
      'public_path' => new sfValidatorPass(array('required' => false)),
      'batch_size'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'state'       => new sfValidatorPass(array('required' => false)),
      'error'       => new sfValidatorPass(array('required' => false)),
      'token'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('log_mail_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'LogMail';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'username'    => 'Text',
      'body_html'   => 'Text',
      'body_text'   => 'Text',
      'created_at'  => 'Date',
      'subject'     => 'Text',
      'strfrom'     => 'Text',
      'reply_to'    => 'Text',
      'notify_to'   => 'Text',
      'platform'    => 'Text',
      'public_path' => 'Text',
      'batch_size'  => 'Number',
      'state'       => 'Text',
      'error'       => 'Text',
      'token'       => 'Text',
    );
  }
}
