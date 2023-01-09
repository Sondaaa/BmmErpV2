<?php

/**
 * Typecourrier form base class.
 *
 * @method Typecourrier getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseTypecourrierForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'     => new sfWidgetFormInputHidden(),
      'type'   => new sfWidgetFormTextarea(),
      'prefix' => new sfWidgetFormInputText(),
      'coul'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'type'   => new sfValidatorString(array('required' => false)),
      'prefix' => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'coul'   => new sfValidatorString(array('max_length' => 254, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('typecourrier[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Typecourrier';
  }

}
