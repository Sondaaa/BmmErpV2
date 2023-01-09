<?php

/**
 * ProcedureMarche form base class.
 *
 * @method ProcedureMarche getObject() Returns the current form's model object
 *
 * @package    Bmm
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseProcedureMarcheForm extends BaseFormDoctrine
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

    $this->widgetSchema->setNameFormat('procedure_marche[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProcedureMarche';
  }

}
