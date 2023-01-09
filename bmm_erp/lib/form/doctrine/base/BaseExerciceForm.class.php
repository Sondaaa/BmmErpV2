<?php

/**
 * Exercice form base class.
 *
 * @method Exercice getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseExerciceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'libelle'    => new sfWidgetFormTextarea(),
      'date_debut' => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'date_fin'   => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'type'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelle'    => new sfValidatorString(),
      'date_debut' => new sfValidatorDate(array('required' => false)),
      'date_fin'   => new sfValidatorDate(array('required' => false)),
      'type'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('exercice[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Exercice';
  }

}
