<?php

/**
 * Salaireouvrier form base class.
 *
 * @method Salaireouvrier getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseSalaireouvrierForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'id_contratouvrier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contratouvrier'), 'add_empty' => true)),
      'salaire'           => new sfWidgetFormInputText(),
      'datedebut'         => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'datefin'           => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'title'             => new sfWidgetFormInputText(),
      'jourferier'        => new sfWidgetFormInputText(),
      
      'id_affectation'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_contratouvrier' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Contratouvrier'), 'column' => 'id', 'required' => false)),
      'salaire'           => new sfValidatorString(array('max_length' => 55, 'required' => false)),
      'datedebut'         => new sfValidatorDate(array('required' => false)),
      'datefin'           => new sfValidatorDate(array('required' => false)),
      'title'             => new sfValidatorString(array('required' => false)),
      'jourferier'        => new sfValidatorInteger(array('required' => false)),
      'id_affectation'        => new sfValidatorInteger(array('required' => false)),
      
    ));

    $this->widgetSchema->setNameFormat('salaireouvrier[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Salaireouvrier';
  }

}
