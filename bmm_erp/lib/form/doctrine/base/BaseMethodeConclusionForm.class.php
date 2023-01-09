<?php

/**
 * MethodeConclusion form base class.
 *
 * @method MethodeConclusion getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseMethodeConclusionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name' => new sfWidgetFormInputText(),
      'id'   => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'name' => new sfValidatorString(array('required' => false)),
      'id'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('methode_conclusion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MethodeConclusion';
  }

}
