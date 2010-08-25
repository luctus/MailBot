<?php

/**
 * LogMail form base class.
 *
 * @method LogMail getObject() Returns the current form's model object
 *
 * @package    mailbot
 * @subpackage form
 * @author     Gustavo Garcia - UDT
 */
abstract class BaseLogMailForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'username'    => new sfWidgetFormInputText(),
      'body_html'   => new sfWidgetFormTextarea(),
      'body_text'   => new sfWidgetFormTextarea(),
      'created_at'  => new sfWidgetFormDateTime(),
      'subject'     => new sfWidgetFormInputText(),
      'strfrom'     => new sfWidgetFormInputText(),
      'reply_to'    => new sfWidgetFormInputText(),
      'notify_to'   => new sfWidgetFormInputText(),
      'platform'    => new sfWidgetFormInputText(),
      'public_path' => new sfWidgetFormInputText(),
      'batch_size'  => new sfWidgetFormInputText(),
      'state'       => new sfWidgetFormInputText(),
      'error'       => new sfWidgetFormInputText(),
      'token'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'LogMail', 'column' => 'id', 'required' => false)),
      'username'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'body_html'   => new sfValidatorString(array('required' => false)),
      'body_text'   => new sfValidatorString(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'subject'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'strfrom'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'reply_to'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'notify_to'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'platform'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'public_path' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'batch_size'  => new sfValidatorInteger(array('min' => -128, 'max' => 127, 'required' => false)),
      'state'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'error'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'token'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('log_mail[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'LogMail';
  }


}
