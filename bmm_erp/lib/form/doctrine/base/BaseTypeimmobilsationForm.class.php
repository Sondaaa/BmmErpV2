<?php

/**
 * Typeimmobilsation form base class.
 *
 * @method Typeimmobilsation getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseTypeimmobilsationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'typeimmo' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'typeimmo' => new sfValidatorString(array('max_length' => 300, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('typeimmobilsation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Typeimmobilsation';
  }

}
