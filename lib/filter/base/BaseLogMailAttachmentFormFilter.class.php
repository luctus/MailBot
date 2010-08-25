<?php

/**
 * LogMailAttachment filter form base class.
 *
 * @package    mailbot
 * @subpackage filter
 * @author     Gustavo Garcia - UDT
 */
abstract class BaseLogMailAttachmentFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'mail_id' => new sfWidgetFormPropelChoice(array('model' => 'LogMail', 'add_empty' => true)),
      'url'     => new sfWidgetFormFilterInput(),
      'type'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'mail_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'LogMail', 'column' => 'id')),
      'url'     => new sfValidatorPass(array('required' => false)),
      'type'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('log_mail_attachment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'LogMailAttachment';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'mail_id' => 'ForeignKey',
      'url'     => 'Text',
      'type'    => 'Text',
    );
  }
}
