<?php

/**
 * MbMailAttachment form base class.
 *
 * @method MbMailAttachment getObject() Returns the current form's model object
 *
 * @package    mailbot
 * @subpackage form
 * @author     Gustavo Garcia - UDT
 */
abstract class BaseMbMailAttachmentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'mail_id' => new sfWidgetFormPropelChoice(array('model' => 'MbMail', 'add_empty' => true)),
      'url'     => new sfWidgetFormInputText(),
      'type'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorPropelChoice(array('model' => 'MbMailAttachment', 'column' => 'id', 'required' => false)),
      'mail_id' => new sfValidatorPropelChoice(array('model' => 'MbMail', 'column' => 'id', 'required' => false)),
      'url'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'type'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mb_mail_attachment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MbMailAttachment';
  }


}
