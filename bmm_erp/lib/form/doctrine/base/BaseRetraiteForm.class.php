<?php

/**
 * Retraite form base class.
 *
 * @method Retraite getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseRetraiteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'nbreanne' => new sfWidgetFormInputText(),
      'libelle'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nbreanne' => new sfValidatorInteger(array('required' => false)),
      'libelle'  => new sfValidatorString(array('max_length' => 25, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('retraite[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Retraite';
  }

}
