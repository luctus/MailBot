<?php

/**
 * LogMailAttachment form base class.
 *
 * @method LogMailAttachment getObject() Returns the current form's model object
 *
 * @package    mailbot
 * @subpackage form
 * @author     Gustavo Garcia - UDT
 */
abstract class BaseLogMailAttachmentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'mail_id' => new sfWidgetFormPropelChoice(array('model' => 'LogMail', 'add_empty' => true)),
      'url'     => new sfWidgetFormInputText(),
      'type'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorPropelChoice(array('model' => 'LogMailAttachment', 'column' => 'id', 'required' => false)),
      'mail_id' => new sfValidatorPropelChoice(array('model' => 'LogMail', 'column' => 'id', 'required' => false)),
      'url'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'type'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('log_mail_attachment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'LogMailAttachment';
  }


}
