<?php

/**
 * Cuenta form base class.
 *
 * @method Cuenta getObject() Returns the current form's model object
 *
 * @package    mailbot
 * @subpackage form
 * @author     Gustavo Garcia - UDT
 */
abstract class BaseCuentaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'username'   => new sfWidgetFormInputText(),
      'credential' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'Cuenta', 'column' => 'id', 'required' => false)),
      'username'   => new sfValidatorString(array('max_length' => 100)),
      'credential' => new sfValidatorString(array('max_length' => 255)),
    ));

    $this->widgetSchema->setNameFormat('cuenta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cuenta';
  }


}
