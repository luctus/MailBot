<?php

/**
 * MbMailto form base class.
 *
 * @method MbMailto getObject() Returns the current form's model object
 *
 * @package    mailbot
 * @subpackage form
 * @author     Gustavo Garcia - UDT
 */
abstract class BaseMbMailtoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'mail_id'    => new sfWidgetFormPropelChoice(array('model' => 'MbMail', 'add_empty' => true)),
      'mailto'     => new sfWidgetFormInputText(),
      'state'      => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'sent_at'    => new sfWidgetFormDateTime(),
      'tries'      => new sfWidgetFormInputText(),
      'error'      => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'MbMailto', 'column' => 'id', 'required' => false)),
      'mail_id'    => new sfValidatorPropelChoice(array('model' => 'MbMail', 'column' => 'id', 'required' => false)),
      'mailto'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'state'      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'sent_at'    => new sfValidatorDateTime(array('required' => false)),
      'tries'      => new sfValidatorInteger(array('min' => -128, 'max' => 127, 'required' => false)),
      'error'      => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mb_mailto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MbMailto';
  }


}
