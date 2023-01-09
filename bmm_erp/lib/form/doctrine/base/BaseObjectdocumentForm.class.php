<?php

/**
 * Objectdocument form base class.
 *
 * @method Objectdocument getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseObjectdocumentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'libelle'         => new sfWidgetFormInputText(),
      'numeroobject'    => new sfWidgetFormInputText(),
      'marqueobject'    => new sfWidgetFormInputText(),
      'dateentreeobjet' => new sfWidgetFormInputText(array(), array('type' => 'date')),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'         => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'numeroobject'    => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'marqueobject'    => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'dateentreeobjet' => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('objectdocument[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Objectdocument';
  }

}
